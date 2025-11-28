<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Salva una prenotazione
    public function store($hotel_id, Request $request)
    {
        // Verifica che l'hotel esista
        $hotel = Hotel::findOrFail($hotel_id);

        // Crea la prenotazione
        Booking::create([
            'user_id' => Auth::id(),
            'hotel_id' => $hotel_id,
            'date' => now(),
        ]);

    return redirect()->back()->with('success', 'Prenotazione effettuata con successo!');
}

// Mostra le prenotazioni dell'utente autenticato
public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('hotel')->get();
        return view('bookings.index', compact('bookings'));
    }
}   