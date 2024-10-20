<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class OwnerController extends Controller
{

    public function IncomingRequest()
    {
        $incomingRequest = Booking::where('status', 'pending')->get();
        Route::get('/user/{id}', function ($id) {
            $controller = new UserController();
            $method = 'show'; // or determine this dynamically
            return $controller->{$method}($id);
        });
    }

    public function showIncomingRequest()
    {
        // Fetch the incoming requests, e.g.:
        $request = Booking::with(['room', 'user'])->where('owner_id', auth()->id())->get();

        return view('owner.incomingRequest', compact('request'));
    }

    public function storeBooking(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'owner_id' => 'required|exists:users,id', // Assuming owners are also in the users table
            'move_in_date' => 'required|date',
            'move_out_date' => 'required|date',
            'number_of_occupants' => 'required|integer|min:1',
            'duration' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Create a new booking record
        Booking::create($validatedData);

        // Redirect or return response
        return redirect()->route('dorm')->with('success', 'Booking has been submitted successfully.');
    }
}
