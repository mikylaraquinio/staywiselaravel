<x-admin-layout>
    <x-slot name="header"></x-slot>

    <div id="wrapper" class="d-flex" style="margin-top: 60px;">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3 text-white">ADMIN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading text-white" style="font-size: 14px;">Interface</div>

            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseComponents" aria-expanded="false" aria-controls="collapseComponents">
                    <i class="bi bi-gear"></i>
                    <span>Owner</span>
                </a>
                <div id="collapseComponents" class="collapse" aria-labelledby="headingComponents" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Owner Management:</h6>
                        <a class="collapse-item" href="{{ route('admin.owner') }}">New Owner</a>
                        <a class="collapse-item" href="{{ route('admin.approvedOwner') }}">Approved Owners</a>
                        <a class="collapse-item" href="{{ route('admin.rejectedOwner') }}">Rejected Owners</a>
                    </div>
                </div>
            </li>   

            <!-- Room Management -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRoom" aria-expanded="false" aria-controls="collapseRoom">
                    <i class="bi bi-gear"></i>
                    <span>Room Management</span>
                </a>
                <div id="collapseRoom" class="collapse" aria-labelledby="headingRoom" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Room Management:</h6>
                        <a class="collapse-item" href="{{ route('admin.unapprovedRooms') }}">Post Request</a>
                        <a class="collapse-item" href="{{ route('admin.approvedRooms') }}">Approved Rooms</a>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Owners</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ownersCount }}</div>
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
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Renters</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rentersCount }}</div>
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
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending User Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingUserRequestsCount }}</div>
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
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pending Post Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingPostRequestsCount }}</div>
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
        <!-- End of Content Wrapper -->
    </div>
</x-admin-layout>
