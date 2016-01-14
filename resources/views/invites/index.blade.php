@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row col-md-6">
            <h4>All invites</h4>

            <ul>
                @foreach($invites as $invite)
                    <li>{{ $invite->board->name }}
                        <a href="{{ route('accept.invite', [$invite->board->identifier]) }}">Accept</a>
                        <a href="{{ route('decline.invite', [$invite->board->identifier]) }}">Decline</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop