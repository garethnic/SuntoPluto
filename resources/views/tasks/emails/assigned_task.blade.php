<h3>Hello, {{ $user->first_name }}</h3>

<p>A task has been assigned to you.</p>

<p>Please click the following <a href="{{ route('tasks.index', ['identifier' => $task->board_identifier]) }}">link</a> to see tasks</p>

<p>Thank you</p>