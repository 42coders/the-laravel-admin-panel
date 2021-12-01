@extends('tlap::layouts.admin')

@section('content-header')
    <div class="row">
        <div class="col-md-3">
            <h1>{{ $TLAPModel::getModelName() }}</h1>
        </div>
        <div class="col-md-9 d-flex justify-content-end ">
            <a class="" href="/{{ config('tlap.path') }}/{{ $TLAPModel->getModelPluralName() }}/{{ $model->id }}/edit/" title="edit"><i class="bi bi-pencil-square"></i></a>
        </div>
    </div>
@endsection

@section('content')
    <table class="table">
        @foreach($model->getTLAPTableStructure() as $fieldName => $fieldValue)
            <tr>
                <td>{{ $fieldName }}</td>
                <td>{{ $model->$fieldName }}</td>
            </tr>
        @endforeach
    </table>
    <div class="col-md-12">
        @foreach($model->withRelations() as $relation)
            <h4>{{ $relation }}</h4>
            @if(empty($model->$relation) || $model->$relation->count() <= 0)
                <p>No relatated Models found</p>
            @else
                <table id="datatable-{{$relation}}" class="table display responsive nowrap" width="100%">
                </table>
                @include('tlap::datatable.datatable', ['tableName' => 'datatable-'.$relation, 'TLAPModel' => $model->$relation()->first(), 'relation'=> $relation])
            @endif
        @endforeach
    </div>

    <a class="btn btn-light" href="/{{ config('tlap.path') }}/{{ $model->getModelPluralName() }}/">Zurück</a>
@endsection
