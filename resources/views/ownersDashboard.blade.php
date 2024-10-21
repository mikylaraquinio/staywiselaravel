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
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('post') }}">
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
                        <a class="collapse-item" href="{{ route('owner.bookings') }}">Bookings</a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="flex-grow-1 d-flex flex-column"> <!-- Adjust margin here -->
            <!-- Main Content -->
            <div id="content" class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Owners Dashboard</h1>
                    </a>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="page-content">
                        <div class="page-header">
                            <div class="container-fluid">
                                <div class="text-center mb-4">
                                    <h1 class="h3">Add Room</h1>
                                </div>

                                <!-- Display Success Message -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- Display Validation Errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ url('add_room') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="room_title" class="form-label">Room Title</label>
                                        <input type="text" name="room_title" id="room_title" class="form-control" placeholder="Enter room title" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Room Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter room description" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="price" id="price" class="form-control" placeholder="Enter room price" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="amenities" class="form-label">Amenities</label>
                                        <input type="text" name="amenities" id="amenities" class="form-control" placeholder="Enter amenities (e.g., WiFi, TV)" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="room_type" class="form-label">Room Type</label>
                                        <select name="room_type" id="room_type" class="form-select" required>
                                            <option value="" disabled selected>Select room type</option>
                                            <option value="studio">Studio</option>
                                            <option value="apartment">Apartment</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Upload Image</label>
                                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary" type="submit">Add Room</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; StayWise 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
    </div>
</x-app-layout>
