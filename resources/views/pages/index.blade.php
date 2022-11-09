@extends('tlap::layouts.admin')

@section('content-header')
    <div class="row">
        <div class="col-md-3">
            <h1>{{ $TLAPModel::getModelName() }}</h1>
        </div>
        <div class="col-md-9 d-flex justify-content-end ">
            <a class="" href="/{{ config('tlap.path') }}/{{ $TLAPModel->getModelPluralName() }}/create" title="create"><i class="bi bi-plus"></i></a>
        </div>
    </div>
@endsection

@section('content')
    {{ $dataTable->table() }}
@endsection

@section('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endsection
