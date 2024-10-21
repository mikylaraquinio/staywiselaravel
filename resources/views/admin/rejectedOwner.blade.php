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

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading text-white" style="font-size: 14px;">Interface</div>

            <!-- Nav Item - Owner -->
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

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseComponents" aria-expanded="false" aria-controls="collapseComponents">
                    <i class="bi bi-gear"></i>
                    <span>Room Management</span>
                </a>
                <div id="collapseComponents" class="collapse" aria-labelledby="headingComponents" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Room Management:</h6>
                        <a class="collapse-item" href="{{ route('admin.unapprovedRooms') }}">Post Request</a>
                        <a class="collapse-item" href="{{ route('admin.approvedRooms') }}">Approved Rooms</a>
                    </div>
                </div>
            </li>  
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="flex-grow-1 d-flex flex-column">
            <!-- Main Content -->
            <div id="content" class="container-fluid">
                <h1 class="h3 mb-0 text-gray-800">Rejected Owner Requests</h1>

                <!-- Rejected Owner Requests Table -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Rejected Owner Requests
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>ID</th>
                                        <th>ID Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rejectedOwners as $owner)
                                        <tr>
                                            <td>{{ $owner->name }}</td>
                                            <td>{{ $owner->number }}</td>
                                            <td>{{ $owner->email }}</td>
                                            <td>{{ $owner->identification }}</td>
                                            <td>
                                                @if ($owner->image)
                                                    <img src="{{ asset('storage/' . $owner->image) }}" alt="ID Image" style="width: 100px; height: auto;">
                                                @else
                                                    No Image Available
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
</x-admin-layout>
