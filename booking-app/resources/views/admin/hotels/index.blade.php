@extends('layouts.app')

@section('title', 'Profilo')

@section('content')
<h1>Profilo utente</h1>

<p>Nome: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>

<h2>Prenotazioni effettuate</h2>

<ul>
@forelse($bookings as $booking)
    <li>
        <a href="{{ route('hotels.show', $booking->hotel) }}">
            {{ $booking->hotel->name }}
        </a>
        <span>
            ({{ $booking->check_in }} → {{ $booking->check_out }},
            ospiti: {{ $booking->guests }})
        </span>
    </li>
@empty
    <li>Nessuna prenotazione.</li>
@endforelse
</ul>
@endsection
