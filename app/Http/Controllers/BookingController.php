<?php

namespace App\Http\Controllers;

use App\Models\Room; // Import your Room model
use App\Models\Booking;
use App\Exports\OBookingsExport;
use App\Exports\AcceptedBookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::all();
        return view('owner.bookings', compact('bookings'));
    } 

    public function create($id)
    {
        $room = Room::findOrFail($id); // Retrieve the room by ID
        return view('bookings.create', compact('room'));
    }

    // Store the booking
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
        ]);

        // Create a new booking and include the 'name'
        Booking::create([
            'room_id' => $request->room_id,
            'name' => $request->name,  // Include the name in the insertion
            'move_in_date' => $request->move_in_date,
            'move_out_date' => $request->move_out_date,
            'number_of_occupants' => $request->number_of_occupants,
            'message' => $request->message,
            'approved' => 0, // Set default value
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Booking request submitted successfully.');
    }

    public function export()
    {
        // Use the OBookingsExport class to create and download the Excel file
        return Excel::download(new OBookingsExport, 'bookings_' . date('Ymd') . '.xlsx');
    }

    public function exportAcceptedBookings()
    {
        return Excel::download(new AcceptedBookingsExport, 'accepted_bookings_' . date('Ymd') . '.xlsx');
    }

}
