@extends('tlap::layouts.admin')

@section('content-header')
    <div class="row">
        <div class="col-md-3">
            <h1>Media Library</h1>
        </div>
        <div class="col-md-9 d-flex justify-content-end ">
            <a class="" href="/{{ config('tlap.path') }}/" title="create"><i class="bi bi-plus"></i></a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @foreach(config('tlap.medialibrary') as $name => $model)
                <span>{{ $name }}</span>
            @endforeach
        </div>
        <div class="col-md-12">
            @foreach($images as $image)
                <div class="col-md-2">
                    <img class="img-fluid" src="{{ $image->getUrl() }}" />
                    <span>{{ $image->file_name }} {{ $image->human_readable_size }} {{ $image->mime_type }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')

@endsection
