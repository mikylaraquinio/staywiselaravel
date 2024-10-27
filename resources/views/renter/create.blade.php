<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Booking for {{ $room->room_title }}
        </h2>
    </x-slot>

    <main class="py-5 d-flex justify-content-center main-bg" >
        <div class="b-container mt-5">
            <div class="row justify-content-center">
                <!-- Room Details Column -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow border-0 rounded-3">
                        <div class="card-body">
                            <h3 class="fw-bold text-primary mb-4">Room Details</h3>
                            <p><strong>Description:</strong> {{ $room->description }}</p>
                            <p><strong>Price:</strong> ₱{{ number_format($room->price, 2) }} /per month</p>
                            <p><strong>Type:</strong> {{ $room->room_type }}</p>
                            <p><strong>Amenities:</strong></p>
                                <ul>
                                    @foreach (json_decode($room->amenities, true) as $amenity)
                                        <li> - {{ ucfirst($amenity) }}</li> <!-- Use ucfirst to capitalize the first letter -->
                                    @endforeach
                                </ul>
                        </div>
                    </div>
                </div>

                <!-- Booking Form Column -->
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-3 p-4">
                        <div class="card-body">
                            <form action="{{ route('renter.bookings.store') }}" method="POST">
                                @csrf <!-- CSRF token for security -->
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                <h3 class="fw-bold text-center text-primary mb-4">Booking Details</h3>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control border-secondary input-demure" id="name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number-of-occupants" class="form-label">Number of Occupants</label>
                                            <input type="number" class="form-control border-secondary input-demure" id="number-of-occupants" name="number_of_occupants" min="1" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="move-in-date" class="form-label">Preferred Move-In <br>Date</label>
                                            <input type="date" class="form-control border-secondary input-demure" id="move-in-date" name="move_in_date" required min="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="move-out-date" class="form-label">Expected Move-Out Date</label>
                                            <input type="date" class="form-control border-secondary input-demure" id="move-out-date" name="move_out_date" required min="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-5">
                                    <label for="message" class="form-label">Request</label>
                                    <textarea class="form-control border-secondary input-demure" id="message" name="message" rows="4"></textarea>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Submit Booking</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Custom styling for a more elegant look */
        .b-container {
            max-width: 1000px;
        }

        h3 {
            color: #0d6efd;
        }

        .card, .form-control, .btn-outline-secondary, .btn-primary {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card {
            border-radius: 10px;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            padding: 10px;
            font-size: 1rem;
        }

        .form-control.input-demure {
            background-color: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 5px;
        }

        .form-control.input-demure:focus {
            background-color: #ffffff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            font-weight: 600;
            font-size: 0.875rem;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            background-color: #0056b3;
        }

        .btn-outline-secondary {
            font-size: 0.875rem;
            font-weight: 600;
        }

        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
            transform: scale(1.05);
        }

        .form-group label {
            font-weight: bold;
            color: #495057;
        }

        .main-bg {
            background-image: url('/images/bg.jpeg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
            background-blend-mode: overlay; /* Blend the overlay with the background image */
        }

        
    </style>
</x-app-layout>
