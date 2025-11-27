<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class AdminHotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::orderBy('name')->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'address'     => 'required|string',
            'city'        => 'required|string',
            'phone'       => 'nullable|string',
            'email'       => 'nullable|email',
        ]);

        Hotel::create($data);

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel creato.');
    }

    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'address'     => 'required|string',
            'city'        => 'required|string',
            'phone'       => 'nullable|string',
            'email'       => 'nullable|email',
        ]);

        $hotel->update($data);

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel aggiornato.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel eliminato.');
    }

    public function bookings(Hotel $hotel)
    {
        $bookings = $hotel->bookings()
            ->with('user')
            ->orderBy('check_in', 'desc')
            ->get();

        return view('admin.hotels.bookings', compact('hotel', 'bookings'));
    }
}
