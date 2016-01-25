@extends('layouts.master')

@section('content')
    <div id="app">
        <div class="row col-md-offset-3">
            <div class="col-md-12">
                <h4>{{ $board->name }}</h4>

                <a v-link="{ path: '/tasks' }">Tasks</a>
                <a v-link="{ path: '/members' }">Members</a>
            </div>
        </div>
        <router-view></router-view>
    </div>
@stop

@section('scripts')
    <script src="{{ elixir('js/app.js') }}"></script>
@stop