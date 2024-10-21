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
                <a class="nav-link" href="{{ route('post') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Rooms -->
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

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column flex-grow-1">
            <div id="content" class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Bookings Room</h1>

                @if(isset($bookings) && $bookings->isEmpty())
                    <p>No new booking requests.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Room Title</th>
                                <th>Requested By</th>
                                <th>Move In</th>
                                <th>Move Out</th>
                                <th>Occupants</th>
                                <th>Duration</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->room->room_title }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->move_in_date }}</td>
                                <td>{{ $booking->move_out_date }}</td>
                                <td>{{ $booking->number_of_occupants }}</td>
                                <td>{{ $booking->duration }}</td>
                                <td>{{ $booking->message }}</td>
                                <td>
                                    <form action="{{ route('owner.bookings.accept', $booking->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Accept</button>
                                    </form>
                                    <form action="{{ route('owner.bookings.reject', $booking->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
