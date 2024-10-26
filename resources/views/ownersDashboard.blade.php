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
        <div id="content-wrapper" class="flex-grow-1 d-flex flex-column">
            <!-- Main Content -->
            <div id="content" class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Owners Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <i class="bi bi-person-fill-check" style="font-size: 4rem;"></i>
                                    </div>
                                    <div class="col text-right">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Rooms</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$roomCount}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Renters Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <i class="bi bi-person-fill" style="font-size: 4rem;"></i>
                                    </div>
                                    <div class="col text-right">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Available Rooms</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$availableRoomCount}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending User Requests Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <i class="bi bi-person-add" style="font-size: 4rem;"></i>
                                    </div>
                                    <div class="col text-right">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Booking Request</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingBookingCount  }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Post Requests Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <i class="bi bi-house-add-fill" style="font-size: 4rem;"></i>
                                    </div>
                                    <div class="col text-right">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Accepted Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $acceptedBookingCount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <i class="bi bi-house-add-fill" style="font-size: 4rem;"></i>
                                    </div>
                                    <div class="col text-right">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Rejected Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rejectedBookingCount }}</div>
                                    </div>
                                </div>
                            </div>
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
