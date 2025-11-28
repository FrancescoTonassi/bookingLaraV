<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminHotelController extends Controller
{
    // Lista hotel
    public function index()
    {
        $hotels = Hotel::orderBy('name')->get();

        return view('admin.hotels.index', compact('hotels'));
    }

    // Form nuovo hotel
    public function create()
    {
        return view('admin.hotels.create');
    }

    // Salvataggio nuovo hotel
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'address'     => ['required', 'string', 'max:255'],
            'city'        => ['required', 'string', 'max:255'],
            'phone'       => ['nullable', 'string', 'max:50'],
            'email'       => ['nullable', 'email', 'max:255'],
        ]);

        Hotel::create($data);

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel creato con successo');
    }

    // Form modifica hotel
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    // Aggiorna hotel
    public function update(Hotel $hotel, Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'address'     => ['required', 'string', 'max:255'],
            'city'        => ['required', 'string', 'max:255'],
            'phone'       => ['nullable', 'string', 'max:50'],
            'email'       => ['nullable', 'email', 'max:255'],
        ]);

        $hotel->update($data);

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel aggiornato con successo');
    }

    // Elimina hotel
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel eliminato con successo');
    }

    // Prenotazioni di un hotel
    public function bookings(Hotel $hotel)
    {
        $bookings = Booking::with('user')
            ->where('hotel_id', $hotel->id)
            ->orderBy('check_in', 'desc')
            ->get();

        return view('admin.hotels.bookings', compact('hotel', 'bookings'));
    }
}
