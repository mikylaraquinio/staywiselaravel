<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function storeBooking(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'room_id' => 'required|exists:room,id',
            'user_id' => 'required|exists:users,id',
            'owner_id' => 'required|exists:owners,id',
            'move_in_date' => 'required|date',
            'move_out_date' => 'required|date',
            'number_of_occupants' => 'required|integer|min:1',
            'duration' => 'required|string',
            'message' => 'nullable|string|max:255',
        ]);

        // Create a new booking
        $booking = Booking::create($validatedData);

        // Optionally, redirect back or show a success message
        return redirect()->route('dorm')->with('success', 'Booking submitted successfully!');
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Update the booking status
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Booking request updated successfully!');
    }

    public function showIncomingRequest()
    {
        $ownerId = auth()->user()->id;  // Assuming the currently logged-in user is the owner
        $bookings = Booking::where('owner_id', $ownerId)->where('status', 'pending')->get();

        return view('owner.incomingRequest', compact('bookings'));
        dd(view()->exists('owner.incomingRequest'));
    }
    


    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();

        return redirect()->route('owner.incomingRequest')->with('success', 'Booking approved successfully.');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        return redirect()->route('owner.incomingRequest')->with('success', 'Booking rejected successfully.');
    }


}
