<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>SuntoPluto</title>
    <meta name="description" content="Tasker">
    <meta name="SuntoPluto" content="Tasks">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/bootstrap-3.3.6/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet" />

    @yield('head')
    @yield('css')

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-3">
            @yield('content')
        </div>
    </div>
</div>

@yield('scripts')

</body>
</html>