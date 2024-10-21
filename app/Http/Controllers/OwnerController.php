<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class OwnerController extends Controller
{


    public function dashboard()
    {
        $ownerId = auth()->user()->id; // Get the currently authenticated owner's ID

        // Fetch bookings for the owner
        $bookings = Booking::where('owner_id', $ownerId)
            ->where('status', 'pending')
            ->with('room', 'user') // Eager load relationships for better performance
            ->get();

        if ($bookings->isEmpty()) {
            return redirect()->route('owner.bookings')->with('info', 'No pending bookings found.'); // Redirect instead of dd
        }

        return view('owner.bookings', compact('bookings')); // Pass bookings to the view
    }


    // In RenterController or appropriate controller
    public function incomingRequests()
    {
        $incomingBookings = Booking::where('status', 'pending')->get();
        $ownerId = auth()->user()->id; // Get the logged-in owner's ID
        $ownerRooms = Room::where('owner_id', $ownerId)->pluck('id'); 
        
        $incomingRequests = Booking::whereIn('room_id', $ownerRooms)
            ->where('status', 'pending')
            ->get();

        return view('owner.bookings', compact('incomingBookings'));
    }



    // Method to accept a booking
    public function acceptBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'accepted'; // Update status or any other relevant data
        $booking->save();

        return redirect()->route('owner.bookings')->with('success', 'Booking accepted successfully.');
    }

    // Method to reject a booking
    public function rejectBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected'; // Update status or any other relevant data
        $booking->save();

        return redirect()->route('owner.bookings')->with('success', 'Booking rejected successfully.');
    }

    //edit button
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('owner.edit', compact('room'));
    }

    //delete button
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->back()->with('success', 'Room deleted successfully.');
    }

    public function editRoom($id)
    {
        $room = Room::findOrFail($id);
        return view('owner.editRoom', compact('room')); // Pass room to edit view
    }

    public function updateRoom(Request $request, $id)
    {
        $request->validate([
            'room_title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the room and update it
        $room = Room::findOrFail($id);
        $room->room_title = $request->room_title;
        $room->description = $request->description;
        $room->price = $request->price;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Optionally delete old image here if needed
            $room->image = $request->file('image')->store('images', 'public');
        }

        $room->save();

        // Redirect to the room list with a success message
        return redirect()->route('post')->with('success', 'Room updated successfully.');
        echo $amenitiesHTML;

    }
    
}
