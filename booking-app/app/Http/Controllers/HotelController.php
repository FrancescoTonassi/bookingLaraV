<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    public function book(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1',
            'notes'     => 'nullable|string',
        ]);

        Booking::create([
            'user_id'   => Auth::id(),
            'hotel_id'  => $hotel->id,
            'check_in'  => $data['check_in'],
            'check_out' => $data['check_out'],
            'guests'    => $data['guests'],
            'notes'     => $data['notes'] ?? null,
        ]);

        return redirect()->route('profile.index')
            ->with('success', 'Prenotazione effettuata con successo.');
    }
}
