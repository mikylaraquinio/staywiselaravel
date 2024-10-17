<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\PetSocial;
use App\Models\Report;
use App\Models\ReportedPetSocialPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        //number of current users
        $userCount = User::count();

        //number of rooms that available for renting
        $roomCount = room::whereDoesntHave('bookingRequests', function ($query) {
            $query->whereIn('status', ['accepted', 'done']);
        })->count();

        //number of overall leased room
        $leasedRoomCount = Pet::whereHas('bookingRequests', function ($query) {
            $query->where('status', 'done');
        })->count();

        $reports = Report::whereHas('user', function ($quer) {
            $quer->where('is_admin', '0');
        })->whereHas('room', function ($quer) {
            $quer->whereHas('user', function ($quer) {
                $quer->where('is_admin', '0');
            });
        })->get();
        $reportsPetSocial = ReportedPetSocialPost::whereHas('user', function ($query) {
            $query->where('is_admin', '0');
        })->whereHas('petSocial', function ($query) {
            $query->whereHas('user', function ($query) {
                $query->where('is_admin', '0');
            });
        })->get();

        $banned = User::where('is_banned', '1')->count();

        return view('admin.index', [
            'availablePetsCount' => $petCount,
            'userCount' => $userCount,
            'adoptedPetCount' => $adoptedPetCount,
            'reports' => $reports,
            'banned' => $banned,
            'reportsPetSocial' => $reportsPetSocial
        ]);
    }


    public function users()
    {
        $users = User::where('is_banned', '0')->where('is_admin', '0')->get();
        return view('admin.current-users', ['users' => $users]);
    }
    public function bannedusers()
    {
        $users = User::where('is_banned', '1')->where('is_admin', '0')->get();
        return view('admin.banned-users', ['users' => $users]);
    }
    public function pets()
    {
        $pets = Pet::whereDoesntHave('adoptionRequests', function ($query) {
            $query->whereIn('status', ['accepted', 'done']);
        })->get();

        return view('admin.pets', ['pets' => $pets]);
    }
    public function Adoptedpets()
    {
        $pets = Pet::with('adoptionRequests')->whereHas('adoptionRequests', function ($query) {
            $query->where('status', 'done');
        })->get();
        return view('admin.adopted-pets', ['pets' => $pets]);
    }


    public function show(User $id)
    {
        $pets = $id->pets()->paginate(10); // Fix: Call paginate() before get()

        return view('admin.user', [
            'user' => $id,
            'pets' => $pets
        ]);
    }

    public function showPost(Pet $id)
    {
        $id = Pet::with('user')->find($id->id);
        return view('admin.post', [
            'pet' => $id
        ]);
    }
    public function unban(User $id)
    {

        $id->update(['is_banned' => false]);
        notify()->success('', 'User successfully unban');
        return redirect()->back();
    }
    public function ban(User $id)
    {
        // Log a message to check if the function is reached
        Log::info('Ban user function reached for user ID: ' . $id->id);

        // Delete associated pets and adoption requests
        $id->pets->each(function ($pet) {
            // Log a message for each pet to check if this part is reached
            Log::info('Deleting pet ID: ' . $pet->id);

            // Delete associated adoption requests
            $pet->adoptionRequests->each(function ($request) {
                Log::info('Deleting adoption request ID: ' . $request->id);
                $request->delete();
            });

            // Delete pet image from storage
            if (File::exists($pet->img)) {
                File::delete($pet->img);
            }

            // Delete the pet
            $pet->delete();
        });
        $id->PetSocials->each(function ($post) {
            // Log a message for each pet to check if this part is reached
            Log::info('Deleting post ID: ' . $post->id);

            // Delete associated adoption requests
            $post->report->each(function ($report) {
                Log::info('Deleting report ID: ' . $report->id);
                $report->delete();
            });

            // Delete pet image from storage
            if (File::exists($post->img)) {
                File::delete($post->img);
            }

            // Delete the pet
            $post->delete();
        });

        // Log a message to check if the user's is_banned status is updated
        Log::info('Updating user is_banned status for user ID: ' . $id->id);
        $id->update(['is_banned' => true]);
        notify()->success('', 'User successfully banned');
        return response()->json('success');
    }

    public function showUserSocial(User $id)
    {
        $posts = $id->PetSocials;

        return view('admin.user-social', [
            'user' => $id,
            'posts' => $posts
        ]);
    }
    public function petSocialDelete(PetSocial $id)
    {
        Log::info('hello');
        // Delete pet image from storage
        if (File::exists($id->img)) {
            File::delete($id->img);
        }
        $id->delete();
        Log::info('successfully deleted');
        return response()->json('success');
    }
}
