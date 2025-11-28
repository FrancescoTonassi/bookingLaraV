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

        // valida i dati del form
        $data = $request->validate([
            'check_in'  => ['required', 'date'],
            'check_out' => ['required', 'date', 'after_or_equal:check_in'],
            'guests'    => ['required', 'integer', 'min:1'],
            'notes'     => ['nullable', 'string'],
        ]);

        Booking::create([
            'user_id'   => Auth::id(),
            'hotel_id'  => $hotel->id,
            'check_in'  => $data['check_in'],
            'check_out' => $data['check_out'],
            'guests'    => $data['guests'],
            'notes'     => $data['notes'] ?? null,
        ]);

    return redirect()->back()->with('success', 'Prenotazione effettuata con successo!');
}

// Mostra le prenotazioni dell'utente autenticato
/*public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('hotel')->get();
        return view('bookings.index', compact('bookings'));
    }*/
}   