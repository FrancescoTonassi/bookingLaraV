<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminHotelController as AdminHotelController;
use App\Http\Controllers\Admin\AdminUserController as AdminUserController;
use App\Http\Controllers\Admin\AdminDashboardController as AdminDashboardController;


//rotte senza login
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');

Route::get('/search', [HotelController::class, 'search'])->name('hotels.search');


//rotte con login
Route::middleware(['auth'])->group(function () {

    // PRENOTAZIONI (solo utenti loggati)
    Route::post('/book/{hotel_id}', [BookingController::class, 'store'])->name('book.store');

    // PROFILO UTENTE
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // LOGOUT (se serve)
    // Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ROTTE ADMIN (login + admin)
Route::middleware(['auth', 'admin'])->group(function () {

    // DASHBOARD ADMIN
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // LISTA HOTEL ADMIN
    Route::get('/admin/hotels', [AdminHotelController::class, 'hotels'])->name('admin.hotels');

    // AGGIUNTA HOTEL
    Route::get('/admin/hotels/create', [AdminHotelController::class, 'createHotel'])->name('admin.hotels.create');
    Route::post('/admin/hotels/store', [AdminHotelController::class, 'storeHotel'])->name('admin.hotels.store');

    // MODIFICA HOTEL
    Route::get('/admin/hotels/{id}/edit', [AdminHotelController::class, 'editHotel'])->name('admin.hotels.edit');
    Route::post('/admin/hotels/{id}/update', [AdminHotelController::class, 'updateHotel'])->name('admin.hotels.update');

    // ELIMINA HOTEL
    Route::delete('/admin/hotels/{id}', [AdminHotelController::class, 'deleteHotel'])->name('admin.hotels.delete');

    // VISUALIZZA PRENOTAZIONI DI UN HOTEL
    Route::get('/admin/hotels/{id}/bookings', [AdminHotelController::class, 'hotelBookings'])->name('admin.hotels.bookings');

    // LISTA UTENTI
    Route::get('/admin/users', [AdminUserController::class, 'users'])->name('admin.users');
});

require __DIR__.'/auth.php';
