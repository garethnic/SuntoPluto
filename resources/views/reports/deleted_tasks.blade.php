@extends('layouts.master')

@section('content')
    <div id="app">
        <div class="row center-block">
            <div class="col-md-12">
                <h4>Reports</h4>
                <h5>Deleted Tasks</h5>

                @include('partials.reports_nav')

                <div class="container">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <th>Task</th>
                        <th>Created</th>
                        <th>Deleted On</th>
                        </thead>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>
                                    {{ str_limit($task->content, 30) }}
                                </td>
                                <td>
                                    {{ \Camroncade\Timezone\Facades\Timezone::convertFromUTC($task->created_at, $user->timezone, 'dS M, g:ia') }}
                                </td>
                                <td>
                                    {{ \Camroncade\Timezone\Facades\Timezone::convertFromUTC($task->deleted_at, $user->timezone, 'dS M, g:ia') }}
                                </td>
                                <td>
                                    {{ $task->first_name }} {{ $task->last_name }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                {!! $tasks->links() !!}
            </div>
        </div>
    </div>
@stop