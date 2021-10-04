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
    <div class="col-md-12">
        @foreach($model::withRelations() as $relation)
            <h3>{{ $relation }}</h3>
            @if(empty($model->$relation) || $model->$relation->count() <= 0)
                <p>No relatated Models found</p>
            @else
                <table id="datatable-{{$relation}}" class="table display responsive nowrap" width="100%">
                </table>

                @include('tlap::datatable.datatable', ['tableName' => 'datatable-'.$relation, 'TLAPModel' => $model->$relation()->first(), 'relation'=> $relation])


            @endif
        @endforeach
    </div>
@endsection
