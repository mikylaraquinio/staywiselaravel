<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dorm', function () {
    return view('dorm');
})->middleware(['auth', 'verified'])->name('dorm');

Route::get('/viewdorm', function () {
    return view('viewdorm');
})->middleware(['auth', 'verified'])->name('viewdorm');

Route::get('/post', function () {
    return view('post');
})->middleware(['auth', 'verified'])->name('post');

Route::get('/book.book', function () {
    return view('book.book');
})->middleware(['auth', 'verified'])->name('book.book');

Route::get('/owner.incomingRequest', function () {
    return view('owner.incomingRequest');
})->middleware(['auth', 'verified'])->name('owner.incomingRequest');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Route::get('admin/dashboard', [HomeController::class, 'index']);
Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);


//Rooms
Route::get('/admin/owner', [RoomController::class, 'owners'])->name('admin.owner');
Route::get('/admin/postRequest', [RoomController::class, 'postRequest'])->name('admin.postRequest');
Route::get('/admin/unapprovedRooms', [RoomController::class, 'unapprovedRooms'])->name('admin.unapprovedRooms');
Route::post('add_room', [RoomController::class, 'store'])->name('add.room');
Route::put('/room/approve/{id}', [RoomController::class, 'approve'])->name('approve.room');
Route::delete('/room/reject/{id}', [RoomController::class, 'reject'])->name('reject.room');
Route::get('/dorm', [RoomController::class, 'showDorms'])->middleware(['auth', 'verified'])->name('dorm');
Route::get('/viewdorm', [RoomController::class, 'showDorms'])->middleware(['auth', 'verified'])->name('viewdorm');
Route::get('/dorm/{id}', [RoomController::class, 'show'])->name('viewdorm');



// Admin - Unapproved Rooms
Route::get('/admin/unapprovedRooms', [AdminController::class, 'unapprovedRooms'])->name('admin.unapprovedRooms');
Route::put('/admin/approve-room/{id}', [AdminController::class, 'approveRoom'])->name('approve.room');
Route::delete('/admin/reject-room/{id}', [AdminController::class, 'rejectRoom'])->name('reject.room');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

//Admin - New Owner Request
Route::get('/admin/owner', [AdminController::class, 'showNewOwners'])->name('admin.owner');
Route::post('/admin/owner/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
Route::post('/admin/owner/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');

//RoomController


//Owner Controller
Route::get('/incomingRequest', [OwnerController::class, 'showIncomingRequest'])->name('owner.incomingRequest');
Route::post('/incomingRequest', [OwnerController::class, 'storeBooking'])->name('owner.incomingRequest');
Route::get('/owner/incomingRequest', [OwnerController::class, 'incomingRequest'])->name('owner.incomingRequest');

//Booking Controller
Route::get('/owner/dashboard', [BookingController::class, 'index'])->name('owner.dashboard');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
Route::get('/incomingRequest', [BookingController::class, 'showIncomingRequest'])->middleware(['auth', 'verified'])->name('owner.incomingRequest');
Route::put('/booking/approve/{id}', [BookingController::class, 'approve'])->name('booking.approve');
Route::delete('/booking/reject/{id}', [BookingController::class, 'reject'])->name('booking.reject');
Route::get('/owner/incomingRequest', [BookingController::class, 'showIncomingRequest'])->name('owner.incomingRequest');
Route::post('/owner/incomingRequest', [BookingController::class, 'storeBooking'])->name('owner.incomingRequest');
