<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <main style="margin-top: 80px;">
        <div id="content-wrapper" class="flex-grow-1 d-flex flex-column">
            <div id="content" class="container-fluid">
                <h1 class="h3 mb-0 text-gray-800">My Bookings</h1>

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-table me-1"></i>My Bookings</span>
                            
                        <a href="{{ route('renter.bookings.exportExcel') }}" class="btn btn-primary">Export to Excel</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                @if($bookings->isEmpty())
                                    <p>No bookings found.</p>
                                @else
                                    <thead> 
                                        <tr>
                                            <th>Room Title</th>
                                            <th>Name</th>   
                                            <th>Move In Date</th>
                                            <th>Move Out Date</th>
                                            <th>Number of Occupants</th>
                                            <th>Status</th>
                                            <th>Actions</th> <!-- New Actions Column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings as $booking)
                                            <tr>
                                                <td>{{ $booking->room ? $booking->room->room_title : 'No Room Assigned' }}</td>
                                                <td>{{ $booking->name }}</td>
                                                <td>{{ $booking->move_in_date }}</td>
                                                <td>{{ $booking->move_out_date }}</td>
                                                <td>{{ $booking->number_of_occupants }}</td>
                                                <td>
                                                    @if ($booking->approved == 1)
                                                        Approved
                                                    @elseif ($booking->approved == 2)
                                                        Rejected
                                                    @else
                                                        Pending
                                                    @endif
                                                </td>
                                                <td>
                                                @if (!$booking->approved && !$booking->rejected)
                                                    <a href="{{ route('renter.status.edit', $booking->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="{{ route('renter.status.cancel', $booking->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this booking?');">Cancel</button>
                                                    </form>
                                                @else
                                                    <span>No actions available</span>
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
