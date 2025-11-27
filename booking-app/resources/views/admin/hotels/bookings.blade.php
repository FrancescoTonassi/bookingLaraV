@extends('layouts.admin')

@section('title', 'Prenotazioni - '.$hotel->name)

@section('content')
<h1>Prenotazioni per {{ $hotel->name }}</h1>

<table>
    <thead>
        <tr>
            <th>Utente</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Ospiti</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
    @forelse($bookings as $booking)
        <tr>
            <td>{{ $booking->user->name }} ({{ $booking->user->email }})</td>
            <td>{{ $booking->check_in }}</td>
            <td>{{ $booking->check_out }}</td>
            <td>{{ $booking->guests }}</td>
            <td>{{ $booking->notes }}</td>
        </tr>
    @empty
        <tr><td colspan="5">Nessuna prenotazione.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection
