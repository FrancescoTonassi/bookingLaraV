@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<h1>Dashboard Admin</h1>

<ul>
    <li>Numero hotel: {{ $hotelCount }}</li>
    <li>Numero utenti: {{ $userCount }}</li>
    <li>Numero prenotazioni: {{ $bookingCount }}</li>
</ul>
@endsection
