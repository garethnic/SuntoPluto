@can('isOwner', $board)
<span class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        Reports
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
        <li><a href="{{ route('reports.all_tasks', ['identifier' => $board->identifier]) }}">All Tasks</a></li>
        <li><a href="{{ route('reports.completed_tasks', ['identifier' => $board->identifier]) }}">Completed Tasks</a></li>
        <li><a href="{{ route('reports.deleted_tasks', ['identifier' => $board->identifier]) }}">Deleted Tasks</a></li>
    </ul>
</span>
@endcan