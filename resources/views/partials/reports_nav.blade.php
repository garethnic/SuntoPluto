<a href="{{ route('tasks.index', ['identifier' => $board->identifier]) }}">{{ $board->name }}</a>
@include('partials.reports_dropdown')
