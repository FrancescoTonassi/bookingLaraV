<nav>
    <a href="{{ route('home') }}">Home</a>

    @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Registrati</a>
    @endguest

    @auth
        <a href="{{ route('profile.index') }}">Profilo</a>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}">Admin</a>
        @endif
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth
</nav>
