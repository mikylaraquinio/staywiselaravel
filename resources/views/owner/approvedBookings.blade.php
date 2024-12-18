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

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column flex-grow-1">
            <div id="content" class="container-fluid">

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i> Accepted Booking Requests
                        <a href="{{ route('owner.exportAcceptedBookings') }}" class="btn btn-primary btn-sm">Export</a>
                    </div>

                    @if ($approvedBookings->isEmpty())
                        <p>No accepted bookings available.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Room Title</th>
                                    <th>Guest Name</th>
                                    <th>Move-In Date</th>
                                    <th>Move-Out Date</th>
                                    <th>Occupants</th>
                                    <th>Request</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approvedBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->room ? $booking->room->room_title : 'Room not found' }}</td>
                                        <td>{{ $booking->name }}</td>
                                        <td>{{ $booking->move_in_date }}</td>
                                        <td>{{ $booking->move_out_date }}</td>
                                        <td>{{ $booking->number_of_occupants}}</td>
                                        <td>{{ $booking->message}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
