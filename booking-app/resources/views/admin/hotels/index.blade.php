@extends('layouts.admin')

@section('title', 'Gestione Hotel')

@section('content')
<h1>Gestione Hotel</h1>

<a href="{{ route('admin.hotels.create') }}">Aggiungi nuovo hotel</a>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Città</th>
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
    @foreach($hotels as $hotel)
        <tr>
            <td>{{ $hotel->name }}</td>
            <td>{{ $hotel->city }}</td>
            <td>
                <a href="{{ route('admin.hotels.edit', $hotel) }}">Modifica</a>
                <a href="{{ route('admin.hotels.bookings', $hotel) }}">Prenotazioni</a>
                <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" style="display:inline" onsubmit="return confirm('Eliminare questo hotel?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Elimina</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
