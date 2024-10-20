<?php
namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function owners()
    {
        // Fetch owners or handle your logic here
        return view('admin.owner'); // Adjust according to your view
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'amenities' => 'required|string',
            'room_type' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create the room entry, setting approved to false
        $room = Room::create([
            'room_title' => $request->room_title,
            'description' => $request->description,
            'price' => $request->price,
            'amenities' => $request->amenities,
            'room_type' => $request->room_type,
            'image' => $imagePath,
            'status' => false, // Mark as unapproved initially
        ]);

        // Now you can access the room ID
        $roomId = $room->id;

        return redirect()->back()->with('success', 'Room added successfully and awaiting approval. Room ID: ' . $roomId);
    }

    public function approve($id)
    {
        $room = Room::findOrFail($id);
        $room->status = true; // Change status to approved
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
        $rooms = Room::where('status', true)->get(); // Corrected variable name here
        return view('dorm', compact('rooms')); // This will work now
    }

    public function postRequest()
    {
        // Logic to fetch post requests from the database
        $postRequests = Room::where('status', 'pending')->get(); // Adjust the condition based on your logic

        // Pass the data to the view
        return view('admin.postRequest', compact('postRequests')); // Ensure this view exists
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
