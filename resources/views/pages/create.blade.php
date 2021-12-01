@extends('tlap::layouts.admin')

@section('content-header')
    <h1>{{ $TLAPModel::getModelName() }}</h1>
@endsection

@section('content')
    <form action="/{{ config('tlap.path') }}/{{ $TLAPModel->getModelPluralName() }}/" enctype="multipart/form-data" method="post" class="table">
        @csrf
        {!! $TLAPModel->getForm() !!}
        <div class="col-md-12">&nbsp;</div>
        <a class="btn btn-light" href="/{{ config('tlap.path') }}/{{ $TLAPModel->getModelPluralName() }}/">Zurück</a>
        <button class="btn btn-success" type="submit">Speichern</button>
    </form>
@endsection
