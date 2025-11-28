<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $hotels = Hotel::where('name', 'LIKE', "%{$search}%")
            ->orderBy('name')
            ->get();

        return view('home', compact('hotels', 'search'));
    }
}
