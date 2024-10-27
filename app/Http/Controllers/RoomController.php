<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Exports\ApprovedRoomsExport;
use Maatwebsite\Excel\Facades\Excel;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'room_title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'amenities' => 'array',
            'room_type' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5000', 
        ]);
    
        // Handle image upload
        $filename = null; // Initialize filename
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
    
            $path = 'uploads/rooms/';
            $file->move($path, $filename);
            $filename = $path . $filename; // Update filename to include the path
        }
    
        $ownerId = auth()->id();
    
        // Create the room entry, setting approved to false
        $room = Room::create([
            'room_title' => $request->room_title,
            'location' => $request->location,
            'description' => $request->description,
            'price' => $request->price,
            'room_type' => $request->room_type,
            'image' => $filename,
            'approved' => false,
            'available' => true,
            'owner_id' => $ownerId,
            'amenities' => json_encode($request->amenities), // Store amenities as JSON
        ]);

        // Now you can access the room ID
        $roomId = $room->id;

        return redirect()->back()->with('success', 'Room added successfully and awaiting approval. Room ID: ' . $roomId);
    }

    public function approve($id)
    {
        $room = Room::findOrFail($id);
        $room->approved = true; // Change approved status to true
        $room->save();

        // Redirect to a specific route or back with a success message
        return redirect()->route('admin.unapprovedRooms')->with('success', 'Room approved successfully.');
    }

    public function show($id)
    {
        // Fetch the room details by ID
        $room = Room::findOrFail($id);

        // Pass the room details to the view
        return view('viewdorm', compact('room'));
    }
    

    public function showDorms()
    {
        // Fetch approved rooms for display
        $rooms = Room::where('approved', true)
                 ->where('available', true)
                 ->get();
                 
        return view('dorm', compact('rooms'));
    }

    public function showDashboard()
    {
        // Fetch approved rooms for display
        $rooms = Room::where('approved', true)
                    ->where('available', true)
                    ->get();
                    
        return view('dashboard', compact('rooms'));
    }

    public function postRequest()
    {
        // Logic to fetch post requests from the database
        $postRequests = Room::where('approved', false)->get(); // Fetching unapproved rooms

        // Pass the data to the view
        return view('admin.postRequest', compact('postRequests')); // Ensure this view exists
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function post()
    {
        // Fetch approved rooms for the owner
        $rooms = Room::where('approved', 1)->get(); // Adjust this based on your actual approved column name
    
        // Return the view with the rooms data
        return view('post', compact('rooms'));
    }

    public function exportApprovedRooms()
    {
        return Excel::download(new ApprovedRoomsExport, 'approved_rooms.xlsx');
    }
    
}
