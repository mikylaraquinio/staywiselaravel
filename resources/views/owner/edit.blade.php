<x-app-layout>
    <x-slot name="header"></x-slot>

    <div id="wrapper" class="d-flex" style="margin-top: 60px;">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3 text-white">OWNER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ownersDashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseComponents" aria-expanded="false" aria-controls="collapseComponents">
                    <i class="bi bi-gear"></i>
                    <span>Rooms</span>
                </a>
                <div id="collapseComponents" class="collapse" aria-labelledby="headingComponents" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Owner:</h6>
                        <a class="collapse-item" href="{{ route('post') }}">Post</a>
                        <a class="collapse-item" href="{{ route('owner.bookings') }}">Incoming Request</a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="flex-grow-1 d-flex flex-column">
            <div id="content" class="container-fluid">
                <h1 class="h3 mb-0 text-gray-800">Edit Room</h1>

                <form action="{{ route('updateRoom', ['id' => $room->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="room_title">Room Title</label>
                        <input type="text" name="room_title" id="room_title" class="form-control" value="{{ old('room_title', $room->room_title) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $room->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $room->price) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="amenities">Amenities</label>
                        <input type="text" name="amenities" id="amenities" class="form-control" value="{{ old('amenities', $room->amenities) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="room_type">Room Type</label>
                        <input type="text" name="room_type" id="room_type" class="form-control" value="{{ old('room_type', $room->room_type) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <small class="form-text text-muted">Leave empty if you don't want to change the image.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Room</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
