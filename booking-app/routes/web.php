<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminHotelController;
use App\Http\Controllers\Admin\AdminUserController;

// ======================
// ROTTE PUBBLICHE
// ======================

// Home con lista hotel
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dettaglio singolo hotel
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

// Ricerca hotel
Route::get('/search', [HotelController::class, 'search'])->name('hotels.search');

// ======================
// ROTTE CON LOGIN (UTENTE NORMALE)
// ======================

Route::middleware('auth')->group(function () {

    // Effettua una prenotazione per un hotel
    Route::post('/hotels/{hotel}/book', [BookingController::class, 'store'])
        ->name('book.store');

    // Pagina PROFILO personalizzata (info + prenotazioni)
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    // Rotte generate da Breeze per modificare il profilo
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Dashboard standard di Breeze (puoi lasciarla o ignorarla)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ======================
// ROTTE ADMIN (auth + admin)
// ======================

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard admin
    Route::get('/admin', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Lista hotel
    Route::get('/admin/hotels', [AdminHotelController::class, 'index'])
        ->name('admin.hotels.index');

    // Crea hotel
    Route::get('/admin/hotels/create', [AdminHotelController::class, 'create'])
        ->name('admin.hotels.create');
    Route::post('/admin/hotels', [AdminHotelController::class, 'store'])
        ->name('admin.hotels.store');

    // Modifica hotel
    Route::get('/admin/hotels/{hotel}/edit', [AdminHotelController::class, 'edit'])
        ->name('admin.hotels.edit');
    Route::put('/admin/hotels/{hotel}', [AdminHotelController::class, 'update'])
        ->name('admin.hotels.update');

    // Elimina hotel
    Route::delete('/admin/hotels/{hotel}', [AdminHotelController::class, 'destroy'])
        ->name('admin.hotels.delete');

    // Prenotazioni di un hotel
    Route::get('/admin/hotels/{hotel}/bookings', [AdminHotelController::class, 'bookings'])
        ->name('admin.hotels.bookings');

    // Lista utenti
    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');

        // ✨ MODIFICA UTENTE (form)
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])
        ->name('admin.users.edit');

    // ✨ SALVA MODIFICA UTENTE
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])
        ->name('admin.users.delete');
});

require __DIR__.'/auth.php';
