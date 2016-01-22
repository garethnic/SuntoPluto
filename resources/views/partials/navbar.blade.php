<nav class="navbar navbar-default">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navi" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">SuntoPluto</a>
        </div>

        <div class = "collapse navbar-collapse" id="navi">

            <ul class="nav navbar-nav navbar-right">
                @if (auth()->check())
                    <li><a href="/boards">Boards</a></li>
                    @if (count($invites) >= 1)
                        <li><a href="/invites">Invites</a></li>
                    @endif
                    @if (Request::path() === 'boards' or Request::path() === 'invites') @else
                        <li><a href="{{ route('tasks.index', ['identifier' => $board->identifier]) }}">{{ $board->name }}</a></li>
                        @include('partials.reports_dropdown')
                    @endif
                    <li><a href="/logout">logout</a></li>
                @else
                    <li><a href="/login">login</a></li>
                @endif
            </ul>

        </div>
    </div>
</nav>