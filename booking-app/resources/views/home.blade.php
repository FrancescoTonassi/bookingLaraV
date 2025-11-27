@extends('layouts.app')

@section('title', 'Home')

@section('content')
<h1>Lista Hotel</h1>

<form method="GET" action="{{ route('home') }}">
    <input type="text" name="search" placeholder="Cerca hotel per nome" value="{{ $search }}">
    <button type="submit">Cerca</button>
</form>

<ul>
@forelse($hotels as $hotel)
    <li>
        <h3><a href="{{ route('hotels.show', $hotel) }}">{{ $hotel->name }}</a></h3>
        <p>{{ $hotel->city }} - {{ $hotel->address }}</p>
        <p>{{ \Illuminate\Support\Str::limit($hotel->description, 100) }}</p>
    </li>
@empty
    <li>Nessun hotel trovato.</li>
@endforelse
</ul>
@endsection
