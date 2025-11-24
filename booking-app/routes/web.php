<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// pagina login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// submit login (solo esempio)
Route::post('/login', function () {
    // Qui metti la logica di autenticazione
})->name('login.submit');