<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
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

Route::get('/renter.status', function () {
    return view('renter.status');
})->middleware(['auth', 'verified'])->name('renter.status');

Route::get('/renter.edit', function () {
    return view('renter.edit');
})->middleware(['auth', 'verified'])->name('renter.edit');

Route::get('/ownersDashboard', function () {
    return view('ownersDashboard');
})->middleware(['auth', 'verified'])->name('ownersDashboard');

Route::get('/owner.bookings', function () {
    return view('owner.bookings');
})->middleware(['auth', 'verified'])->name('owner.bookings');

Route::get('/owner.create', function () {
    return view('owner.create');
})->middleware(['auth', 'verified'])->name('owner.create');

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
Route::get('/dashboard', [RoomController::class, 'showDashboard'])->name('dashboard');


//Owner Post
Route::get('/owner/edit/{id}', [OwnerController::class, 'edit'])->name('editRoom');
Route::delete('/owner/delete/{id}', [OwnerController::class, 'destroy'])->name('deleteRoom');
Route::put('owner/edit/{id}', [OwnerController::class, 'updateRoom'])->name('updateRoom');

Route::get('/owner/dashboard', [OwnerController::class, 'ownerDashboard'])->name('ownersDashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/rooms/approved', [RoomController::class, 'showApprovedRooms'])->name('rooms.showApproved');
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
Route::middleware(['auth'])->group(function () {
    Route::get('/owner/bookings', [OwnerController::class, 'index'])->name('owner.bookings');
});


//Renter Cotroller
Route::middleware(['auth'])->group(function () {
    Route::get('/renter/bookings/create', [RenterController::class, 'create'])->name('renter.bookings.create');
    Route::post('/renter/bookings', [RenterController::class, 'store'])->name('renter.bookings.store');
    Route::get('/renters/book/{room_id}', [RenterController::class, 'create'])->name('renter.book.create');
    Route::get('/renter/bookings', [RenterController::class, 'index'])->name('renter.bookings');


    Route::get('/renter/status', [RenterController::class, 'index'])->name('renter.status.index');
    Route::get('/renter/status/edit/{id}', [RenterController::class, 'edit'])->name('renter.status.edit');
    Route::put('/renter/status/{id}', [RenterController::class, 'update'])->name('renter.status.update');
    Route::delete('/renter/status/{id}', [RenterController::class, 'destroy'])->name('renter.status.cancel');
    Route::get('/bookings', [RenterController::class, 'showBookings'])->middleware('auth');

    Route::get('/renter/status', [RenterController::class, 'show'])->name('renter.status');

});

//Booking
Route::post('/owner/bookings/accept/{id}', [OwnerController::class, 'accept'])->name('owner.bookings.accept');
Route::post('/owner/bookings/reject/{id}', [OwnerController::class, 'reject'])->name('owner.bookings.reject');
Route::get('/owner/approved-bookings', [OwnerController::class, 'approvedBookings'])->name('owner.approvedBookings');
Route::get('/owner/rejected-bookings', [OwnerController::class, 'rejectedBookings'])->name('owner.rejectedBookings');

//Notifications
Route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');

//Exports
Route::get('/renter/bookings/export-excel', [RenterController::class, 'exportExcel'])->name('renter.bookings.exportExcel');
Route::get('/admin/export-approved-owners', [AdminController::class, 'exportApprovedOwners'])->name('admin.exportApprovedOwners');
Route::get('/owner/bookings/export', [OwnerController::class, 'export'])->name('owner.bookings.export');
Route::get('/owner/approved/export', [BookingController::class, 'exportAcceptedBookings'])->name('owner.exportAcceptedBookings');
Route::get('/admin/rooms/export', [RoomController::class, 'exportApprovedRooms'])->name('admin.rooms.export');

