<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Incoming Booking Requests
        </h2>
    </x-slot>

    <main style="margin-top: 80px;">
        <div class="container">
            <h3>Your Incoming Requests</h3>
            @if($request->isEmpty())
                <p>No incoming requests at the moment.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room Title</th>
                            <th>User</th>
                            <th>Move In Date</th>
                            <th>Move Out Date</th>
                            <th>Number of Occupants</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($request as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->room->room_title }}</td>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->move_in_date }}</td>
                                <td>{{ $request->move_out_date }}</td>
                                <td>{{ $request->number_of_occupants }}</td>
                                <td>
                                    <!-- Add action buttons here (e.g., approve or reject) -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div class="mt-4">
                <a href="{{ route('owner.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </main>
</x-app-layout>
