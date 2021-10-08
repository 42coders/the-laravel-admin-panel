<?php

namespace the42coders\TLAP\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ReflectionClass;
use the42coders\TLAP\Contracts\Fields\Field;
use the42coders\TLAP\TLAP;

trait TLAPAdminTrait
{

    public static $fields;

    public static function fields()
    {
        return self::$fields;
    }

    public static function getTLAPStaticColumnStructure($tableName): array
    {
        $structure = [];

        $tableInfoColumns = DB::select(DB::raw('SHOW COLUMNS FROM ' . $tableName));

        foreach ($tableInfoColumns as $column) {
            $structure[$column->Field] = [
                'type' => $column->Type,
                'nullable' => $column->Null,
                'key' => $column->Key,
                'default' => $column->Default,
                'extra' => $column->Extra,
            ];
        }

        return $structure;
    }

    public static function withRelations(): array
    {
        return Arr::pluck(self::getEloquentRelations(), 'name');
    }

    public static function getEloquentRelations(): array
    {
        $reflector = new ReflectionClass(self::class);

        $relations = [];
        foreach ($reflector->getMethods() as $reflectionMethod) {
            $returnType = $reflectionMethod->getReturnType();
            if ($returnType) {
                if (in_array(class_basename($returnType->getName()), config('tlap.relations'))) {
                    $relations[] = $reflectionMethod;
                }
            }
        }

        return $relations;
    }

    public static function getModelName(): string
    {
        return class_basename(__CLASS__);
    }

    public static function getModelPluralName(): string
    {
        return Str::lower(Str::plural(self::getModelName()));
    }

    public static function getTLAPStaticTableName()
    {
        return (new static)->getTable();
    }

    public static function getTLAPTableStructure(): array
    {
        $tableName = self::getTLAPStaticTableName();

        return self::getTLAPStaticColumnStructure($tableName);
    }

    public static function getForm($model = null): string
    {
        if(empty(self::fields())) {

            $tableStructure = self::getTLAPTableStructure();
            $form = '';
            foreach ($tableStructure as $columnName => $column) {
                $form .= TLAP::getForm($columnName, $column, $model);
            }
            return $form;
        }

        $form = '';

        /** @var Field $field */
        foreach(self::fields() as $field) {
            $form .= $field->render($model);
        }

        return $form;
    }

    public static function getColumnNames(): array
    {
        return array_keys(self::getTLAPTableStructure());
    }

    public static function getDatatableFields(): array
    {
        if (empty(self::fields())){
            return array_keys(self::cleanData(self::getTLAPTableStructure()));
        }

        $columns = [];

        foreach(self::fields() as $field){
            if($field->dataTable){
                $columns[] = $field;
            }
        }

        return $columns;
    }

    public static function cleanData($array): array
    {
        unset($array['password'], $array['remember_token']);

        return $array;
    }

    public static function validation():array
    {
        $validation = [];


        $columns = self::getTLAPTableStructure();

        foreach($columns as $columnName => $column){
            if($column['nullable'] === 'NO'){
                $validation[$columnName] = 'required';
            }
        }


        if(!empty(self::fields())) {
            foreach (self::fields() as $field) {
                if (!empty($field->validation)) {
                    $validation[$field->name] = $field->validation;
                }
            }
        }

        return $validation;
    }



    public static function getDatatable(Request $request, $ids = null): \Illuminate\Http\JsonResponse
    {
        $totalData = self::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = self::getColumnNames()[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $columns = self::getColumnNames();

        if ($columns[0] !== 'id'){
            array_unshift($columns, 'id');
        }

        if (empty($request->input('search.value')))
        {
            $data = self::select($columns)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input ('search.value');

            $data = self::query()->select($columns);
            foreach(self::getColumnNames() as $column){
                $data = $data->orWhere($column, 'LIKE', "%{$search}%");
            }
            $data = $data
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = self::where('id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->count();
        }

        $columnStructure = self::getTLAPTableStructure();
        $data = self::applyDataFilter($data->toArray(), $columnStructure);

        return response()->json([
            'draw' => intval($request->input('draw')),
            "recordsTotal"=> intval($totalData),
            "recordsFiltered"=> intval($totalFiltered),
            'data' => $data
        ]);
    }

    public static function applyDataFilter(array $data, array $columnsStructure): array
    {
        $columnStructure = self::getTLAPTableStructure();

        foreach($data as $dataKey => $dataValue){
            foreach($columnStructure as $columnKey => $columnValue){
                $filterName = config('tlap.datatableFilter.type.' . $columnValue['type']);
                if (class_exists($filterName)) {
                    $filter = app($filterName);
                    $data[$dataKey][$columnKey] = $filter->filter($dataValue[$columnKey]);
                }
            }
        }

        return $data;
    }

    public static function getDatatableIdFiltered(Request $request, $ids = null): \Illuminate\Http\JsonResponse
    {
        $totalData = self::whereIn('id', $ids)->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = self::getColumnNames()[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $columns = self::getColumnNames();

        if($columns[0] !== 'id'){
            array_unshift($columns, 'id');
        }

        if(empty($request->input('search.value')))
        {
            $data = self::select($columns)
                ->whereIn('id', $ids)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input ('search.value');

            $data = self::query()->select($columns);
            $data = $data->where(function ($q) use ($ids) {
                $q->whereIn('id', $ids);
            });

            $data = $data->where(function ($q) use ($search){
                foreach(self::getColumnNames() as $column){
                    $q->orWhere($column, 'LIKE', "%{$search}%");
                }
            });


            $data = $data
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = self::
                whereIn('id', $ids)
                ->where(function ($q) use ($search) {
                    foreach(self::getColumnNames() as $column){
                        $q->orWhere($column, 'LIKE', "%{$search}%");
                    }
                })
                ->count();
        }

        $columnStructure = self::getTLAPTableStructure();
        $data = self::applyDataFilter($data->toArray(), $columnStructure);

        return response()->json([
            'draw' => intval($request->input('draw')),
            "recordsTotal"=> intval($totalData),
            "recordsFiltered"=> intval($totalFiltered),
            'data' => $data
        ]);
    }

}
