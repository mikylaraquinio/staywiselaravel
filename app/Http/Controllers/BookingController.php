<?php

namespace App\Http\Controllers;

use App\Models\Room; // Import your Room model
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create($id)
    {
        $room = Room::findOrFail($id); // Retrieve the room by ID
        return view('bookings.create', compact('room'));
    }

    // Store the booking
    public function store(Request $request)
{
    $request->validate([
        'room_id' => 'required|exists:room,id',
        'user_id' => 'required|exists:users,id',
        'move_in_date' => 'required|date',
        'move_out_date' => 'required|date',
        'number_of_occupants' => 'required|integer|min:1',
        'duration' => 'required|string',
        'message' => 'nullable|string',
    ]);

    Booking::create([
        'room_id' => $request->room_id,
        'user_id' => $request->user_id,
        'move_in_date' => $request->move_in_date,
        'move_out_date' => $request->move_out_date,
        'number_of_occupants' => $request->number_of_occupants,
        'duration' => $request->duration,
        'message' => $request->message,
        'status' => 'pending', // Set initial status to pending
    ]);

    return redirect()->route('dorm')->with('success', 'Booking request submitted successfully!');
}

}
