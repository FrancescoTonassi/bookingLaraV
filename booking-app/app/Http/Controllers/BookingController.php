<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Hotel $hotel, Request $request)
    {
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

        return back()->with('success', 'Prenotazione effettuata con successo!');
    }
}
