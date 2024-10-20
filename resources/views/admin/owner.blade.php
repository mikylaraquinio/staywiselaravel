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
                    <span>User Management</span>
                </a>
                <div id="collapseComponents" class="collapse" aria-labelledby="headingComponents" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">User Management:</h6>
                        <a class="collapse-item" href="{{ route('admin.owner') }}">New Owner</a>
                        <a class="collapse-item" href="{{ route('admin.postRequest') }}">Owner Post Request</a>
                        <a class="collapse-item" href="{{ route('admin.unapprovedRooms') }}">Unapproved Rooms</a>
                    </div>
                </div>
            </li>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="flex-grow-1 d-flex flex-column">
            <!-- Main Content -->
            <div id="content" class="container-fluid">
                <h1 class="h3 mb-0 text-gray-800">New Owner Request</h1>

                <!-- New Owner Requests Table -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        New Owner Requests
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newOwners as $owner)
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
                                            <td>
                                                <form action="{{ route('admin.approve', $owner->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.reject', $owner->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
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
