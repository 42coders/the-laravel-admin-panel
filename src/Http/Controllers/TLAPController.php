<?php

namespace the42coders\TLAP\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use the42coders\TLAP\TLAPModel;

class TLAPController extends Controller
{
    public function start()
    {
        return view('tlap::pages.start');
    }

    public function index($models)
    {

        $TLAPModel = TLAPModel::getModel($models);

        $models = $TLAPModel::all();

        return view('tlap::pages.index', [
            'models' => $models,
            'TLAPModel' => $TLAPModel,
        ]);
    }

    public function show($models, $id)
    {
        $TLAPModel = TLAPModel::getModel($models);

        $model = $TLAPModel::where('id', $id)->with($TLAPModel::withRelations())->first();

        return view('tlap::pages.show', [
            'model' => $model,
            'TLAPModel' => $TLAPModel,
        ]);
    }

    public function edit($models, $id)
    {
        $TLAPModel = TLAPModel::getModel($models);

        $model = $TLAPModel::find($id);

        return view('tlap::pages.edit', [
            'model' => $model,
            'TLAPModel' => $TLAPModel,
        ]);
    }

    public function update($models, $id, Request $request)
    {
        $TLAPModel = TLAPModel::getModel($models);

        $model = $TLAPModel::find($id);

        $validated = $request->validate($TLAPModel::validation());

        $input = $request->all();

        if(empty($input['pw'])){
            unset($input['pw']);
        }else {
            $input['pw'] = Hash::make($input['pw']);
        }

        if(empty($input['password'])){
            unset($input['password']);
        }else {
            $input['password'] = Hash::make($input['password']);
        }

        $model->update($input);

        return redirect()->route('tlap.show', ['models' => $model::getModelPluralName(), 'id' => $model->id]);
    }

    public function create($models)
    {
        $TLAPModel = TLAPModel::getModel($models);

        return view('tlap::pages.create', [
            'TLAPModel' => $TLAPModel,
        ]);
    }

    public function store($models, Request $request)
    {
        $TLAPModel = TLAPModel::getModel($models);

        $validated = $request->validate($TLAPModel::validation());

        $input = $request->all();

        if(isset($input['pw'])){
            $input['pw'] = Hash::make($input['pw']);
        }

        if(isset($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }

        $createdModel = $TLAPModel::create($input);

        return redirect()->route('tlap.show', ['models' => $createdModel::getModelPluralName(), 'id' => $createdModel->id]);
    }

    public function datatable($models, Request $request)
    {
        $TLAPModel = TLAPModel::getModel($models);

        if(empty($request->ids)){
            return $TLAPModel::getDataTable($request);
        }

        return $TLAPModel::getDatatableIdFiltered($request, $request->ids);
    }

    public function delete($models, $id)
    {
        $TLAPModel = TLAPModel::getModel($models);

        $model = $TLAPModel::find($id);

        if(empty($model)){
            return redirect()->route('tlap.index', ['models' => $TLAPModel::getModelPluralName()]);
        }

        $model->delete();

        return redirect()->route('tlap.index', ['models' => $model::getModelPluralName()]);
    }
}
