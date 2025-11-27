//dettagli hotel + form prenotazione se loggato

@extends('layouts.app')

@section('title', $hotel->name)

@section('content')
<h1>{{ $hotel->name }}</h1>
<p>{{ $hotel->city }} - {{ $hotel->address }}</p>
<p>{{ $hotel->description }}</p>

@auth
    <h2>Effettua una prenotazione</h2>
    <form method="POST" action="{{ route('hotels.book', $hotel) }}">
        @csrf
        <label>Check-in:
            <input type="date" name="check_in" required>
        </label>
        @error('check_in')<div>{{ $message }}</div>@enderror

        <label>Check-out:
            <input type="date" name="check_out" required>
        </label>
        @error('check_out')<div>{{ $message }}</div>@enderror

        <label>Ospiti:
            <input type="number" name="guests" min="1" required>
        </label>
        @error('guests')<div>{{ $message }}</div>@enderror

        <label>Note:
            <textarea name="notes"></textarea>
        </label>
        @error('notes')<div>{{ $message }}</div>@enderror

        <button type="submit">Prenota</button>
    </form>
@else
    <p>Per prenotare devi <a href="{{ route('login') }}">effettuare il login</a>.</p>
@endauth
@endsection
