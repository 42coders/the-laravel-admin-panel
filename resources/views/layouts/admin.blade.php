<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} - Admin</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('vendor/tlap/js/tlap.js') }}"></script>


    <!-- Styles -->
    <link href="{{ asset('vendor/tlap/css/tlap.css') }}" rel="stylesheet">

</head>
<body>
<div class="container-fluid">
    @include('tlap::layouts.navbar')
    <div class="row">
        @include('tlap::layouts.sidebar')
        <div class="col-md-10">
            <div class="card" style="padding: 20px; margin-top: 12px; margin-bottom: 12px;">
                <h1>@yield('content-header')</h1>
                <div class="card-body">@yield('content')</div>
            </div>
        </div>
    </div>
</div>
<script>
    var base_url = '{{ url('').'/'.config('tlap.path').'/' }}';
</script>
@yield('scripts')
</body>
</html>
