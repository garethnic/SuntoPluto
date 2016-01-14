@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row col-md-6">
            <h4>All boards</h4>
            @if ($boards)
                @foreach($boards as $board)
                    <a href="{{ route('tasks.index', ['identifier' => $board->identifier]) }}">{{ $board->name }}</a>
                @endforeach
            @else
                <p>You don't have any boards.</p>
            @endif
            @if (count($invites) >= 1)
                <a href="/invites">Invites</a>
            @endif
            <p><a href="{{ url('boards/new-board') }}">Create a new board</a></p>
        </div>
    </div>
@stop