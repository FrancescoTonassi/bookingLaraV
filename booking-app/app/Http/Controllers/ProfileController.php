<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Pagina profilo (info + prenotazioni)
    public function index()
    {
        $user = Auth::user();

        $bookings = Booking::with('hotel')
            ->where('user_id', $user->id)
            ->orderBy('check_in', 'desc')
            ->get();

        return view('profile.index', compact('user', 'bookings'));
    }

    // Metodi Breeze (se vuoi tenere la pagina di edit separata)

    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $user->update($data);

        return redirect()->route('profile')->with('status', 'Profilo aggiornato!');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
