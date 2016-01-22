@can('isOwner', $board)
    <li class="dropdown">
    <a href="#" class="dropdown-toggle" id="dropdownMenu1" role="button" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="true" aria-expanded="false">
        Reports
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
        <li><a href="{{ route('reports.all_tasks', ['identifier' => $board->identifier]) }}">All Tasks</a></li>
        <li><a href="{{ route('reports.completed_tasks', ['identifier' => $board->identifier]) }}">Completed Tasks</a></li>
        <li><a href="{{ route('reports.deleted_tasks', ['identifier' => $board->identifier]) }}">Deleted Tasks</a></li>
    </ul>
    </li>
@endcan