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

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'room_id' => 'required|exists:room,id',
            'name' => 'required|string|max:255', // Validate the name field
            'move_in_date' => 'required|date',
            'move_out_date' => 'required|date|after:move_in_date',
            'number_of_occupants' => 'required|integer|min:1',
            'message' => 'nullable|string|max:500',
            'duration' => 'required|string', // Validate duration if needed
        ]);

        // Create a new booking and include the 'name'
        Booking::create([
            'room_id' => $request->room_id,
            'name' => $request->name,  // Include the name in the insertion
            'move_in_date' => $request->move_in_date,
            'move_out_date' => $request->move_out_date,
            'number_of_occupants' => $request->number_of_occupants,
            'duration' => $request->duration,
            'message' => $request->message,
            'approved' => 0, // Set default value
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Booking request submitted successfully.');
    }


    public function showBookings($ownerId)
    {
        $bookings = Booking::where('owner_id', $ownerId)->get();
        return view('owner.bookings', compact('bookings'));
    }

    public function index()
    {
        // Fetch bookings for the logged-in renter
        $bookings = Booking::where('user_id', Auth::id())->get();
        return view('renter.bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);

        // Validate the request
        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        // Update the booking status
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }
    
}
