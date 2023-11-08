<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            
            @auth
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.history') }}">History</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.notification') }}">All Notification</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.returnRequest') }}">Return Request</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('book.storeform') }}">Add Book</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('book.index') }}">All Book</a>
                </li>
                <li class="nav-item active">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link active">Logout</button>
                    </form>
                </li>
            @else
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Log in</a>
                </li>
            @endauth
            
        </ul>
    </div>
</nav>