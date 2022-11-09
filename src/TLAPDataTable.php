<?php

namespace the42coders\TLAP;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;

class TLAPDataTable extends DataTable
{

    public $DtModel = null;

    public function __construct($model)
    {
        parent::__construct();
        $this->DtModel = $model;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        $dataTable = (new EloquentDataTable($query))->setRowId('id')
            ->addColumn('action', function($data){
                return  '<a href="/admin/' . $data->getModelPluralName() .'/'. $data->id . '/show" class="show"><i class="bi bi-eye"></i></a>
                    <a href="/admin/' . $data->getModelPluralName() . '/'. $data->id . '/edit" class="show"><i class="bi bi-pencil-square"></i></a>
                    <a href="/admin/' . $data->getModelPluralName() . '/'. $data->id . '/delete" class="show"><i class="bi bi-trash"></i></a>';
            });

        $columnStructure = $this->DtModel->getTLAPTableStructure();

        foreach($columnStructure as $columnKey => $columnValue){
            $filterName = config('tlap.datatableFilter.type.' . $columnValue['type']);
            if (class_exists($filterName)) {
                $dataTable->editColumn($columnKey, function ($value) use ($filterName, $columnKey){
                    $filter = app($filterName);
                    return $filter->filter($value->{$columnKey});
                });
            }
        }

        return $dataTable;
    }

    public function query(): QueryBuilder
    {
        return $this->DtModel->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleMultiShift()
            ->buttons([
                Button::make('add'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        $columns = $this->DtModel->getDatatableFields();

        $DataTableColumns = [];

        $DataTableColumns[] = Column::checkbox('');

        foreach($columns as $column){
            $DataTableColumns[] = Column::make($column);
        }

        $DataTableColumns[] = Column::computed('action');

        return $DataTableColumns;
    }

    protected function filename(): string
    {
        return $this->DtModel->getModelName() . '_' . date('YmdHis');
    }
}
