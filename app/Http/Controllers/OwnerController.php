<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingAcceptedNotification;
use App\Notifications\BookingAccepted;
use App\Notifications\BookingRejected;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    // Method to show rooms created by the authenticated owner
    public function index()
    {
        // Get the authenticated user's rooms
        $rooms = auth()->user()->rooms;

        $bookings = collect();
        if ($rooms->isNotEmpty()) {
            $bookings = Booking::whereIn('room_id', $rooms->pluck('id'))->get();
        }

        // Get the bookings related to those rooms
        $bookings = Booking::whereIn('room_id', $rooms->pluck('id'))->get(); // Assuming 'room_id' in bookings

        return view('owner.bookings', compact('rooms', 'bookings')); // Pass rooms and bookings to the view
    }

    // Method to edit a specific room
    public function edit($id)
    {
        $room = Room::where('id', $id)->where('owner_id', auth()->id())->firstOrFail(); // Ensure the owner owns the room
        return view('owner.edit', compact('room'));
    }

    // Method to delete a room
    public function destroy($id)
    {
        $room = Room::where('id', $id)->where('owner_id', auth()->id())->firstOrFail(); // Ensure the owner owns the room
        $room->delete();

        return redirect()->back()->with('success', 'Room deleted successfully.');
    }

    // Method to show the edit form for a specific room
    public function editRoom($id)
    {
        $room = Room::where('id', $id)->where('owner_id', auth()->id())->firstOrFail(); // Ensure the owner owns the room
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
        $room = Room::where('id', $id)->where('owner_id', auth()->id())->firstOrFail();
        $room->room_title = $request->room_title;
        $room->description = $request->description;
        $room->price = $request->price;

        $room->save();

        return redirect()->route('post')->with('success', 'Room updated successfully.');
    }

    // Method to approve a booking
    public function accept($id)
    {
        $booking = Booking::findOrFail($id); // Find booking by ID
        $booking->approved = 1; // Set approved to true
        $booking->save(); // Save the booking

        $room = Room::findOrFail($booking->room_id); 
        $room->available = false; // Set room as unavailable
        $room->save();

        $renter = User::find($booking->renter_id);

        // Notify the renter
        $renter->notify(new BookingAcceptedNotification($booking));

        return redirect()->route('owner.approvedBookings')->with('success', 'Booking accepted successfully!'); // Redirect back with success message
    }

    // Method to reject a booking request
    public function reject($id)
{
    $booking = Booking::findOrFail($id); // Find booking by ID
    $booking->approved = 2; // Assuming you use this to indicate rejection
    $booking->save();

    // Notify the renter
    $renter = $booking->user; // Get the user associated with the booking
    if ($renter) { // Check if renter exists
        $renter->notify(new BookingRejected($booking));
    } else {
        // Handle the case where the renter is not found
        return redirect()->route('owner.bookings')->with('error', 'Renter not found.');
    }

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

    public function ownerDashboard()
    {
        $ownerId = auth()->user()->id;

        // Count of all rooms owned by this owner
        $roomCount = Room::where('owner_id')->count();

        // Count of approved rooms owned by this owner
        $availableRoomCount = Room::where('owner_id', $ownerId)->where('approved', 1)->count();

        // Get all room IDs owned by the owner
        $roomIds = Room::where('owner_id', $ownerId)->pluck('id');

        // Count bookings based on the rooms owned by this owner
        $pendingBookingCount = Booking::whereIn('room_id', $roomIds)->where('approved', 0)->count();
        $acceptedBookingCount = Booking::whereIn('room_id', $roomIds)->where('approved', 1)->count();
        $rejectedBookingCount = Booking::whereIn('room_id', $roomIds)->where('approved', 2)->count();

        return view('ownersDashboard', compact(
            'roomCount',
            'availableRoomCount',
            'pendingBookingCount',
            'acceptedBookingCount',
            'rejectedBookingCount'
        ));
    }

}
