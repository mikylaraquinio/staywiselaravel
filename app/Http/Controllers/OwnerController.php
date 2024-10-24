<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    // Method to show rooms created by the authenticated owner
    public function index()
    {
        // Get the authenticated user's rooms
        $rooms = auth()->user()->rooms;

        // Get the bookings related to those rooms
        $bookings = Booking::whereIn('room_id', $rooms->pluck('id'))->get(); // Assuming 'room_id' in bookings

        return view('owner.bookings', compact('rooms', 'bookings')); // Pass rooms and bookings to the view
    }

    // Method to edit a specific room
    public function edit($id)
    {
        $room = Room::where('id', $id)->where('user_id', auth()->id())->firstOrFail(); // Ensure the owner owns the room
        return view('owner.edit', compact('room'));
    }

    // Method to delete a room
    public function destroy($id)
    {
        $room = Room::where('id', $id)->where('user_id', auth()->id())->firstOrFail(); // Ensure the owner owns the room
        $room->delete();

        return redirect()->back()->with('success', 'Room deleted successfully.');
    }

    // Method to show the edit form for a specific room
    public function editRoom($id)
    {
        $room = Room::where('id', $id)->where('user_id', auth()->id())->firstOrFail(); // Ensure the owner owns the room
        return view('owner.editRoom', compact('room')); // Pass room to edit view
    }

    // Method to update a specific room
    public function updateRoom(Request $request, $id)
    {
        $request->validate([
            'room_title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the room and ensure it's owned by the authenticated user
        $room = Room::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $room->room_title = $request->room_title;
        $room->description = $request->description;
        $room->price = $request->price;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Optionally delete old image here if needed
            $room->image = $request->file('image')->store('images', 'public');
        }

        $room->save();

        return redirect()->route('post')->with('success', 'Room updated successfully.');
    }

    // Method to approve a booking
    public function accept($id)
    {
        $booking = Booking::findOrFail($id); // Find booking by ID
        $booking->approved = true; // Set approved to true
        $booking->save(); // Save the booking

        $room = Room::findOrFail($booking->room_id); 
        $room->available = false; // Set room as unavailable
        $room->save();

        return redirect()->route('owner.approvedBookings')->with('success', 'Booking accepted successfully!'); // Redirect back with success message
    }

    // Method to reject a booking request
    public function reject($id)
    {
        $booking = Booking::findOrFail($id); // Find booking by ID
        $booking->delete(); // Delete the booking

        return redirect()->route('owner.bookings')->with('success', 'Booking rejected successfully!'); // Redirect back with success message
    }

    // Method to show approved bookings
    public function approvedBookings()
    {

        $rooms = auth()->user()->rooms;

        if ($rooms->isEmpty()) {
            return redirect()->back()->with('error', 'No rooms found for this user.');
        }

        // Get approved bookings for rooms owned by the authenticated user
        $approvedBookings = Booking::where('approved', true)
            ->whereIn('room_id', auth()->user()->rooms()->pluck('id'))
            ->paginate(10); // You can adjust the pagination as needed

        return view('owner.approvedBookings', compact('approvedBookings'));
    }

    // Method to show rejected bookings
    public function rejectedBookings()
    {

        $rooms = auth()->user()->rooms;

        // Check if the user has rooms before proceeding to avoid the error
        if ($rooms->isEmpty()) {
            return redirect()->back()->with('error', 'No rooms found for this user.');
        }

        // Get rejected bookings for rooms owned by the authenticated user
        $rejectedBookings = Booking::where('approved', false)
            ->whereIn('room_id', auth()->user()->rooms()->pluck('id'))
            ->paginate(10); // You can adjust the pagination as needed

        return view('owner.rejectedBookings', compact('rejectedBookings'));
    }
}
