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

        <div id="content-wrapper" class="flex-grow-1 d-flex flex-column">
            <div id="content" class="container-fluid">
                <h1 class="h3 mb-0 text-gray-800">My Rooms</h1>

                @if ($rooms->isEmpty())
                    <p>No approved rooms available.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Room Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $room->room_title }}</td>
                                    <td>{{ $room->description }}</td>
                                    <td>{{ number_format($room->price, 2) }}</td>
                                    <td>
                                        <img src="{{ asset($room->image) }}" alt="{{ $room->room_title }}" style="width: 50px; height: auto;">
                                    </td>
                                    <td>
                                        <a href="{{ route('editRoom', ['id' => $room->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('deleteRoom', ['id' => $room->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this room?');">Delete</button>
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
