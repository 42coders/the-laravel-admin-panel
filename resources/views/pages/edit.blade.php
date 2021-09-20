@extends('tlap::layouts.admin')

@section('content-header')
    <h1>{{ $model::getModelName() }}</h1>
@endsection

@section('content')
    <form action="/{{ config('tlap.path') }}/{{ $model::getModelPluralName() }}/{{ $model->id }}" method="post" class="table">
        @csrf
        {!! $model::getForm($model) !!}
        <div class="col-md-12">&nbsp;</div>
        <a class="btn btn-light" href="/{{ config('tlap.path') }}/{{ $model::getModelPluralName() }}/">Zurück</a>
        <button class="btn btn-success" type="submit">Speichern</button>
    </form>
@endsection
