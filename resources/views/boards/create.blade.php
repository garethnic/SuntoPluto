@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row col-md-6">
            <h4>Create a new board</h4>

            <form action="/boards/create" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name"/>
                </div>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="submit" name="submit" value="Create" class="btn btn-primary" />
            </form>

        </div>
    </div>
@stop