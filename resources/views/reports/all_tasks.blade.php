@extends('layouts.reports_layout')

@section('content')
    <div id="app">
        <div class="row center-block">
            <div class="col-md-12">
                <h4>Reports</h4>
                <h5>All Tasks</h5>

                <div class="container">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <th>Task</th>
                        <th>Created On</th>
                        <th>Created By</th>
                        <th>Completed On</th>
                        <th>Completed By</th>
                        <th>Deleted On</th>
                        <th>Assigned To</th>
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
                                    {{ $task->createdBy }}
                                </td>
                                <td>
                                    @if (!is_null($task->completed_on))
                                        {{ \Camroncade\Timezone\Facades\Timezone::convertFromUTC($task->completed_on, $user->timezone, 'dS M, g:ia') }}
                                    @else
                                    @endif
                                </td>
                                <td>
                                    {{ $task->completedBy }}
                                </td>
                                <td>
                                    @if (!is_null($task->deleted_at))
                                        {{ \Camroncade\Timezone\Facades\Timezone::convertFromUTC($task->deleted_at, $user->timezone, 'dS M, g:ia') }}
                                    @else
                                    @endif
                                </td>
                                <td>
                                    {{ $task->assignee }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                {!! $tasks->setPath('')->links() !!}
            </div>
        </div>
    </div>
@stop