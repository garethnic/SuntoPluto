<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>SuntoPluto</title>
    <meta name="description" content="Tasker">
    <meta name="SuntoPluto" content="Tasks">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ elixir('css/app.css') }}" rel="stylesheet" />

    @yield('head')
    @yield('css')

</head>

<body>
@include('partials.navbar')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
</div>

@yield('scripts')

<script src="{{ elixir('js/site.js') }}"></script>

</body>
</html>