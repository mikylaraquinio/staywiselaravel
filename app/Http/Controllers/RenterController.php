<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;
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
        $validated = $request->validate([
            'room_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'move_in_date' => 'required|date',
            'move_out_date' => 'required|date|after:move_in_date',
            'number_of_occupants' => 'required|integer',
            'duration' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Create a new booking and include the 'name'
        $booking = new Booking();
        $booking->room_id = $validated['room_id'];
        $booking->renter_id = auth()->id(); // Fetch the authenticated renter's ID
        $booking->name = $validated['name'];
        $booking->move_in_date = $validated['move_in_date'];
        $booking->move_out_date = $validated['move_out_date'];
        $booking->number_of_occupants = $validated['number_of_occupants'];
        $booking->duration = $validated['duration'];
        $booking->message = $validated['message'];
        $booking->approved = 0; // Default to 0 for pending approval

        // Save the booking to the database
        $booking->save();

        // Redirect with a success message
        return redirect()->back()->with('success', 'Booking request submitted successfully.');
    }


    public function showBookings($ownerId)
    {
        $booking = Booking::findOrFail($id);
        $booking->approved = true;
        $booking->save();
        $bookings = Booking::where('renter_id', auth()->id())->get();

        // Notify the renter
        $renter = $booking->user; // Assuming you have a relationship to get the renter
        $renter->notify(new BookingApproved($booking));

        return redirect()->route('owner.bookings')->with('success', 'Booking accepted and renter notified.');
    }

    public function show()
    {
        // Retrieve bookings for the authenticated user
        $bookings = Booking::where('renter_id', auth()->id())->with('room')->get();

        // Return the view with bookings
        return view('renter.status', compact('bookings'));
    }


    public function index()
    {
        $bookings = Booking::where('renter_id', Auth::id())->with('room')->get();
        
        return view('renter.status', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = Booking::where('id', $id)->where('renter_id', auth()->id())->firstOrFail();
        return view('renter.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'move_in_date' => 'required|date',
            'move_out_date' => 'required|date|after_or_equal:move_in_date',
            'number_of_occupants' => 'required|integer|min:1',
            'message' => 'nullable|string|max:500',
            
        ]);

        // Update the booking details
        $booking = Booking::where('id', $id)->where('renter_id', auth()->id())->firstOrFail();
        $booking->move_in_date = $request->move_in_date;
        $booking->move_out_date = $request->move_out_date;
        $booking->number_of_occupants = $request->number_of_occupants;
        $booking->save();

        return redirect()->route('renter.bookings')->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::where('id', $id)->where('renter_id', auth()->id())->firstOrFail();
        $booking->delete();

        return redirect()->route('renter.status')->with('success', 'Booking canceled successfully.');
    }
    
    public function exportExcel()
    {
        return Excel::download(new BookingsExport, 'bookings.xlsx');
    }
}
