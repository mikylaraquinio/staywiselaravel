<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RenterController;
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

Route::get('/ownersDashboard', function () {
    return view('ownersDashboard');
})->middleware(['auth', 'verified'])->name('ownersDashboard');

Route::get('/book.book', function () {
    return view('book.book');
})->middleware(['auth', 'verified'])->name('book.book');

Route::get('/owner.bookings', function () {
    return view('owner.bookings');
})->middleware(['auth', 'verified'])->name('owner.bookings');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/post', [RoomController::class, 'post'])->name('post');


require __DIR__.'/auth.php';

//Route::get('admin/dashboard', [HomeController::class, 'index']);
Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);


//Rooms
Route::get('/admin/owner', [RoomController::class, 'owner'])->name('admin.owner');
Route::get('/admin/postRequest', [RoomController::class, 'postRequest'])->name('admin.postRequest');
Route::get('/admin/unapprovedRooms', [RoomController::class, 'unapprovedRooms'])->name('admin.unapprovedRooms');
Route::post('add_room', [RoomController::class, 'store'])->name('add.room');
Route::put('/room/approve/{id}', [RoomController::class, 'approve'])->name('approve.room');
Route::delete('/room/reject/{id}', [RoomController::class, 'reject'])->name('reject.room');
Route::get('/dorm', [RoomController::class, 'showDorms'])->middleware(['auth', 'verified'])->name('dorm');
Route::get('/viewdorm', [RoomController::class, 'showDorms'])->middleware(['auth', 'verified'])->name('viewdorm');
Route::get('/dorm/{id}', [RoomController::class, 'show'])->name('viewdorm');

//Owner Post
Route::get('/owner/edit/{id}', [OwnerController::class, 'edit'])->name('editRoom');
Route::delete('/owner/delete/{id}', [OwnerController::class, 'destroy'])->name('deleteRoom');
Route::put('owner/edit/{id}', [OwnerController::class, 'updateRoom'])->name('updateRoom');

Route::middleware(['auth'])->group(function () {
    Route::get('/rooms/approved', [RoomController::class, 'showApprovedRooms'])->name('rooms.showApproved');
});

//Owner Bookings
Route::middleware(['auth'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'ownerdashboard'])->name('owner.dashboard');
    Route::get('/owner/bookings', [OwnerController::class, 'showBookings'])->name('owner.bookings');
    Route::post('/owner/bookings/{id}/accept', [OwnerController::class, 'acceptBooking'])->name('owner.acceptBooking');
    Route::post('/owner/bookings/{id}/reject', [OwnerController::class, 'rejectBooking'])->name('owner.rejectBooking');
    Route::get('/owner/incoming-requests', [OwnerController::class, 'showIncomingRequest'])->name('owner.incomingRequests');
});




// Admin - Unapproved Rooms
Route::get('/admin/unapprovedRooms', [AdminController::class, 'unapprovedRooms'])->name('admin.unapprovedRooms');
Route::put('/admin/approve-room/{id}', [AdminController::class, 'approveRoom'])->name('approve.room');
Route::delete('/admin/reject-room/{id}', [AdminController::class, 'rejectRoom'])->name('reject.room');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

//Admin - Approved Rooms
Route::get('/admin/approvedRooms', [AdminController::class, 'approvedRooms'])->name('admin.approvedRooms');


//Admin - New Owner Request
Route::get('/admin/owner', [AdminController::class, 'showNewOwners'])->name('admin.owner');
Route::post('/admin/owner/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
Route::post('/admin/owner/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');

//Admin - Approved Owner
Route::get('/admin/approvedOwner', [AdminController::class, 'approvedOwner'])->name('admin.approvedOwner');
//Admin - Approved Owner
Route::get('/admin/rejectedOwner', [AdminController::class, 'rejectedOwner'])->name('admin.rejectedOwner');

//Admin - dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//RoomController


//Owner Controller
Route::post('/bookings', [OwnerController::class, 'store'])->name('owner.bookings');
Route::get('/owner/bookings', [OwnerController::class, 'incomingRequest'])->name('owner.bookings');
Route::get('/owner/bookings', [OwnerController::class, 'showBookings'])->name('owner.bookings.index');  
Route::get('/owner/incoming-requests', [OwnerController::class, 'incomingRequest'])->name('owner.bookings');
Route::post('/owner/bookings/{booking}/accept', [OwnerController::class, 'acceptBooking'])->name('owner.bookings.accept');
Route::post('/owner/bookings/{booking}/reject', [OwnerController::class, 'rejectBooking'])->name('owner.bookings.reject');
Route::middleware(['auth'])->group(function () {
    Route::get('/owner/bookings', [OwnerController::class, 'dashboard'])->name('owner.bookings');
});


//Renter Cotroller
Route::prefix('renters')->group(function () {
    Route::get('/book/{room_id}', [RenterController::class, 'create'])->name('renter.book.create');
    Route::post('/bookings', [RenterController::class, 'store'])->name('renter.bookings.store');
    Route::get('/bookings', [RenterController::class, 'index'])->name('renter.bookings.index');
});

Route::post('/renter/bookings/store', [RenterController::class, 'store'])->name('renter.bookings.store');
Route::get('/renters/book/{id}', [RenterController::class, 'showBookingForm'])->name('renters.book');



//Booking
Route::get('/booking/{id}', [BookingController::class, 'create'])->name('renter.bookings.create');
Route::post('/booking/store', [BookingController::class, 'store'])->name('renter.bookings.store');