<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RenterController extends Controller
{
    public function create($room_id)
    {
        // Fetch the specific room by its ID
        $room = Room::findOrFail($room_id);

        // Pass the room to the view
        return view('renter.create', compact('room'));
    }

    public function index()
    {
        // Fetch bookings for the logged-in renter
        $bookings = Booking::where('user_id', Auth::id())->get();
        return view('renter.bookings', compact('bookings'));
    }

    
}
