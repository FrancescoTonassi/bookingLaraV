@extends('layouts.admin')

@section('title', 'Modifica Utente')

@section('content')
<h1>Modifica utente</h1>

<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')
    <label>Nome:
        <input type="text" name="name" value="{{ $user->name }}" required>
    </label>
    <label>Email:
        <input type="email" name="email" value="{{ $user->email }}" required>
    </label>
    <label>Ruolo:
        <select name="role">
            <option value="user" @if($user->role === 'user') selected @endif>User</option>
            <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
        </select>
    </label>
    <button type="submit">Salva</button>
</form>
@endsection
