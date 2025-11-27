@extends('layouts.admin')

@section('title', 'Modifica Hotel')

@section('content')
<h1>Modifica Hotel</h1>

<form method="POST" action="{{ route('admin.hotels.update', $hotel) }}">
    @csrf
    @method('PUT')
    <label>Nome:
        <input type="text" name="name" value="{{ $hotel->name }}" required>
    </label>
    <label>Descrizione:
        <textarea name="description">{{ $hotel->description }}</textarea>
    </label>
    <label>Indirizzo:
        <input type="text" name="address" value="{{ $hotel->address }}" required>
    </label>
    <label>Città:
        <input type="text" name="city" value="{{ $hotel->city }}" required>
    </label>
    <label>Telefono:
        <input type="text" name="phone" value="{{ $hotel->phone }}">
    </label>
    <label>Email:
        <input type="email" name="email" value="{{ $hotel->email }}">
    </label>
    <button type="submit">Aggiorna</button>
</form>
@endsection
