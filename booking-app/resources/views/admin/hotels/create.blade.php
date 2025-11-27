@extends('layouts.admin')

@section('title', 'Nuovo Hotel')

@section('content')
<h1>Nuovo Hotel</h1>

<form method="POST" action="{{ route('admin.hotels.store') }}">
    @csrf
    <label>Nome:
        <input type="text" name="name" required>
    </label>
    <label>Descrizione:
        <textarea name="description"></textarea>
    </label>
    <label>Indirizzo:
        <input type="text" name="address" required>
    </label>
    <label>Città:
        <input type="text" name="city" required>
    </label>
    <label>Telefono:
        <input type="text" name="phone">
    </label>
    <label>Email:
        <input type="email" name="email">
    </label>
    <button type="submit">Salva</button>
</form>
@endsection
