<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Booking') }}
        </h2>
    </x-slot>

    <main style="margin-top: 80px;">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Edit Booking
                </div>
                <div class="card-body">
                    <form action="{{ route('renter.status.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="move_in_date">Move-In Date</label>
                            <input type="date" name="move_in_date" class="form-control" value="{{ $booking->move_in_date }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="move_out_date">Move-Out Date</label>
                            <input type="date" name="move_out_date" class="form-control" value="{{ $booking->move_out_date }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="number_of_occupants">Number of Occupants</label>
                            <input type="number" name="number_of_occupants" class="form-control" value="{{ $booking->number_of_occupants }}" required min="1">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Booking</button>
                        <a href="{{ route('renter.bookings') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
