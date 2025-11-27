<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AdminHotelController as AdminHotelController;
use App\Http\Controllers\Admin\AdminUserController as AdminUserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Dettaglio hotel (visibile a tutti)
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])
    ->name('hotels.show');

// Rotte auth generate da Breeze/Jetstream
require __DIR__.'/auth.php';

// Rotte riservate all'utente loggato
Route::middleware('auth')->group(function () {

    // Effettua una prenotazione per un hotel
    Route::post('/hotels/{hotel}/book', [HotelController::class, 'book'])
        ->name('hotels.book');

    // Pagina profilo + prenotazioni
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');
});

// AREA ADMIN
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // gestione hotel
        Route::get('/hotels', [AdminHotelController::class, 'index'])->name('hotels.index');
        Route::get('/hotels/create', [AdminHotelController::class, 'create'])->name('hotels.create');
        Route::post('/hotels', [AdminHotelController::class, 'store'])->name('hotels.store');
        Route::get('/hotels/{hotel}/edit', [AdminHotelController::class, 'edit'])->name('hotels.edit');
        Route::put('/hotels/{hotel}', [AdminHotelController::class, 'update'])->name('hotels.update');
        Route::delete('/hotels/{hotel}', [AdminHotelController::class, 'destroy'])->name('hotels.destroy');

        // visualizzazione prenotazioni di un hotel
        Route::get('/hotels/{hotel}/bookings', [AdminHotelController::class, 'bookings'])
            ->name('hotels.bookings');

        // gestione utenti
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    });
