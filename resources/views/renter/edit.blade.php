<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Booking') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <form method="POST" action="{{ route('renter.bookings.update', $booking->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="move_in_date" class="form-label">Move In Date</label>
                <input type="date" class="form-control" id="move_in_date" name="move_in_date" value="{{ $booking->move_in_date }}" required>
            </div>

            <div class="mb-3">
                <label for="move_out_date" class="form-label">Move Out Date</label>
                <input type="date" class="form-control" id="move_out_date" name="move_out_date" value="{{ $booking->move_out_date }}" required>
            </div>

            <div class="mb-3">
                <label for="number_of_occupants" class="form-label">Number of Occupants</label>
                <input type="number" class="form-control" id="number_of_occupants" name="number_of_occupants" value="{{ $booking->number_of_occupants }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Booking</button>
        </form>
    </div>
</x-app-layout>
