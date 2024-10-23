<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking for {{ $room->room_title }}
        </h2>
    </x-slot>

    <main class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mb-4">Room Details</h3>
                    <div class="card mb-4">
                        <div class="card-body">
                            <p><strong>Description:</strong> {{ $room->description }}</p>
                            <p><strong>Price:</strong> {{ number_format($room->price, 2) }}</p>
                            <p><strong>Amenities:</strong> {{ $room->amenities }}</p>
                            <p><strong>Type:</strong> {{ $room->room_type }}</p>
                        </div>
                    </div>

                    <form action="{{ route('renter.bookings.store') }}" method="POST" class="shadow p-4 bg-white rounded">
                        @csrf <!-- CSRF token for security -->
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        
                        <div class="form-group mb-3">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="move-in-date">Preferred Move-In Date:</label>
                            <input type="date" class="form-control" id="move-in-date" name="move_in_date" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="move-out-date">Preferred Move-Out Date:</label>
                            <input type="date" class="form-control" id="move-out-date" name="move_out_date" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="number-of-occupants">Number of Occupants:</label>
                            <input type="number" class="form-control" id="number-of-occupants" name="number_of_occupants" min="1" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="duration">Duration of Stay (Weeks/Months/Semester):</label>
                            <input type="text" class="form-control" id="duration" name="duration" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">Submit Booking</button>
                        <a href="{{ route('dorm') }}" class="btn btn-secondary btn-lg">Back to Dorms</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
