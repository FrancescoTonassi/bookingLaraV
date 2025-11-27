<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\User;
use App\Models\Booking;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $hotelCount = Hotel::count();
        $userCount  = User::count();
        $bookingCount = Booking::count();

        return view('admin.dashboard', compact('hotelCount', 'userCount', 'bookingCount'));
    }
}
