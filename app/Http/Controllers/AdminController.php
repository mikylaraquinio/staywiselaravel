<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    public function index()
    {
        // Your logic here, e.g., fetching data
        return view('admin.dashboard'); // Replace with your view
    }

    public function unapprovedRooms()
    {
        // Retrieve all rooms that are unapproved
        $unapprovedRooms = Room::where('status', false)->get();
        
        return view('admin.unapprovedRooms', compact('unapprovedRooms'));
    }  

    public function approveRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->status = true; // Mark as approved
        $room->save();

        return redirect()->back()->with('success', 'Room approved successfully.');
    }

    public function rejectRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->delete(); // Remove the room post or set status to rejected

        return view('admin.dashboard');
    }

    public function showNewOwners()
    {
        // Fetch new owner users who are not approved
        $newOwners = User::where('role', 'owner')->where('approved', 0)->get();

        return view('admin.owner', compact('newOwners'));
    }

    public function approve($id)
    {
        $owner = User::findOrFail($id);
        $owner->approved = 1; // Mark as approved
        $owner->save();
    
        return redirect()->route('admin.owner')->with('success', 'Owner approved successfully.');
    }
    
    public function reject($id)
    {
        $owner = User::findOrFail($id);
        $owner->delete(); // Or any other logic for rejection
    
        return redirect()->route('admin.owner')->with('success', 'Owner rejected successfully.');
    }

}
