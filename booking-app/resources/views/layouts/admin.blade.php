// layout admin area

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin - Hotel Booking')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.hotels') }}">Hotel</a>
    <a href="{{ route('admin.users') }}">Utenti</a>
    <a href="{{ route('home') }}">Torna al sito</a>
</nav>

<main class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
