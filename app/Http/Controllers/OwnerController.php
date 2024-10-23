<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    //POST
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

    public function index()
    {
        $bookings = Booking::where('approved', false)->get();

        return view('owner.bookings',compact('bookings')); // Replace with your view
    } 


    //bookings

    public function accept($id)
    {
        $booking = Booking::findOrFail($id); // Find booking by ID
        $booking->approved = true; // Set approved to true
        $booking->save(); // Save the booking

        $room = Room::findOrFail($booking->room_id); // Assuming room_id is in the bookings table
        $room->is_available = false; // Mark room as unavailable
        $room->save();

        return redirect()->route('owner.approvedBookings')->with('success', 'Booking accepted successfully!'); // Redirect back with success message
    }

    // Method to reject a booking request
    public function reject($id)
    {
        $booking = Booking::findOrFail($id); // Find booking by ID
        $booking->approved = false; // Set approved to false
        $booking->delete();

        return redirect()->route('owner.bookings')->with('success', 'Booking rejected successfully!'); // Redirect back with success message
    }

    public function approvedBookings()
    {
        // Retrieve all approved bookings
        $approvedBookings = Booking::where('approved', true)->paginate(10); // You can adjust the pagination as needed

        // Return the view with the approved bookings
        return view('owner.approvedBookings', compact('approvedBookings'));
    }
    public function rejectedBookings()
    {
        // Retrieve all rejected bookings
        $rejectedBookings = Booking::where('approved', false)->paginate(10); // You can adjust the pagination as needed

        // Return the view with the rejected bookings
        return view('owner.rejectedBookings', compact('rejectedBookings'));
    }
}
