@extends('layouts.admin')

@section('title', 'Utenti registrati')

@section('content')
<h1>Utenti registrati</h1>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Ruolo</th>
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <a href="{{ route('admin.users.edit', $user) }}">Modifica</a>
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline" onsubmit="return confirm('Eliminare questo utente?');">
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
