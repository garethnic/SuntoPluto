@extends('layouts.master')

@section('content')
    <div id="app">
        <div class="row center-block">
            <div class="col-md-12">
                <h4>Welcome</h4>

                <a v-link="{ path: '/tasks' }">Tasks</a>
                <a v-link="{ path: '/members' }">Members</a>
                @include('partials.reports_nav')
            </div>
        </div>
        <router-view></router-view>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('js/plugins/jquery-1.12.0.min.js') }}"></script>
    <script src="{{ asset('js/plugins/parsley.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@stop