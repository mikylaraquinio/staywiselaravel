<x-app-layout>
    <x-slot name="header"></x-slot>

    <div id="wrapper" class="d-flex" style="margin-top: 60px;">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('ownersDashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3 text-white">OWNER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('ownersDashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('owner.create') }}">
                    <i class="bi bi-gear"></i>
                    <span>Create Room</span>
                </a>
            </li>
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
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseComponents" aria-expanded="false" aria-controls="collapseComponents">
                    <i class="bi bi-gear"></i>
                    <span>Requests</span>
                </a>
                <div id="collapseComponents" class="collapse" aria-labelledby="headingComponents" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Bookings Requests:</h6>
                        <a class="collapse-item" href="{{ route('owner.approvedBookings') }}">Accepted</a>
                        <a class="collapse-item" href="{{ route('owner.rejectedBookings') }}">Rejected</a>
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
                                        <label for="location" class="form-label">Location</label>
                                        <select name="location" id="location" class="form-select" required>
                                            <option value="" disabled selected>Select room location</option>
                                            <option value="Tondaligan Beach">Tondaligan Beach</option>
                                            <option value="Arellano St.">Arellano St.</option>
                                            <option value="Magsaysay Avenue">Magsaysay Avenue</option>
                                            <option value="Dagupeña Heights">Dagupeña Heights</option>
                                            <option value="Barangay Pugaro">Barangay Pugaro</option>
                                            <option value="Salinap">Salinap</option>
                                            <option value="Malued">Malued</option>
                                            <option value="Bonuan">Bonuan</option>
                                            <option value="San Vicente">San Vicente</option>
                                            <option value="Mangin">Mangin</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Room Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter room description(include full address)" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="price" id="price" class="form-control" placeholder="Enter room price" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Amenities</label><br>
                                        <div>
                                            <input type="checkbox" name="amenities[]" id="aircon" value="Aircon">
                                            <label for="aircon">Aircon</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="amenities[]" id="meeting_room" value="Meeting Room">
                                            <label for="meeting_room">Meeting Room</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="amenities[]" id="study_hub" value="Study Hub">
                                            <label for="study_hub">Study Hub</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="amenities[]" id="swimming_pool" value="Swimming Pool">
                                            <label for="swimming_pool">Swimming Pool</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="amenities[]" id="parking" value="Parking">
                                            <label for="parking">Parking</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="amenities[]" id="commercial_spaces" value="Commercial Spaces">
                                            <label for="commercial_spaces">Commercial Spaces</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="amenities[]" id="community_area" value="Community Area">
                                            <label for="community_area">Community Area</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="amenities[]" id="elevator" value="Elevator">
                                            <label for="elevator">Elevator</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="amenities[]" id="fitness_gym" value="Fitness Gym">
                                            <label for="fitness_gym">Fitness Gym</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="room_type" class="form-label">Room Type</label>
                                        <select name="room_type" id="room_type" class="form-select" required>
                                            <option value="" disabled selected>Select room type</option>
                                            <option value="single">Single</option>
                                            <option value="double">Double</option>
                                            <option value="bunk_bed">Bunk Bed</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Upload Image</label>
                                        <input type="file" name="image" id="image" class="form-control"/>
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
