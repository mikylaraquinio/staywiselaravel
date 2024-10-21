<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    public function dashboard()
    {
        // Count the number of owners (assuming role 'owner' is stored in the 'role' column)
        $ownersCount = User::where('role', 'owner')->count();

        // Count the number of renters (assuming role 'renter' is stored in the 'role' column)
        $rentersCount = User::where('role', 'renter')->count();

        // Count the number of pending user requests (assuming pending user requests have a 'status' field)
        $pendingUserRequestsCount = User::where('approved', 0)->count();

        // Count the number of pending post requests (assuming pending posts are in the 'room' table and have an 'approved' column)
        $pendingPostRequestsCount = Room::where('approved', 0)->count();

        return view('admin.dashboard', compact('ownersCount', 'rentersCount', 'pendingUserRequestsCount', 'pendingPostRequestsCount'));
    }

    public function index()
    {
        return view('admin.dashboard'); // Replace with your view
    }

    public function unapprovedRooms()
    {
        // Retrieve all rooms that are unapproved
        $unapprovedRooms = Room::where('approved', 0)->get(); // Change from 'status' to 'approved'
        
        return view('admin.unapprovedRooms', compact('unapprovedRooms'));
    }  

    public function approveRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->approved = 1; // Mark as approved
        $room->save();

        return redirect()->back()->with('success', 'Room approved successfully.');
    }

    public function rejectRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->delete(); // Remove the room post or you could set a rejected status if needed

        return redirect()->back()->with('success', 'Room rejected successfully.'); // Redirect back with success message
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

    public function approvedOwner()
    {
        // Fetch all approved owners
        $approvedOwners = Owner::where('approved', 1)->get();
        return view('admin.approvedOwner', compact('approvedOwners'));
    }

    public function rejectedOwner()
    {
        // Fetch all owners who have been rejected
        $rejectedOwners = User::where('role', 'owner')->where('approved', 0)->get();
    
        // Log the rejected owners for debugging
        Log::info('Rejected Owners:', $rejectedOwners->toArray());
    
        return view('admin.rejectedOwner', compact('rejectedOwners'));
    }

    public function approvedRooms()
    {
        // Fetch all approved rooms
        $approvedRooms = Room::where('approved', 1)->get();

        return view('admin.approvedRooms', compact('approvedRooms'));
    }
}
