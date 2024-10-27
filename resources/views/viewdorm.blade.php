<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ $room->room_title }}
        </h2>
    </x-slot>

    <main class="py-5 d-flex justify-content-center"> <!-- Center the main container -->
        <div class="v-container mt-5">
            <!-- Back Button at Top Left -->
            <div class="mb-4 text-start">
                <a href="{{ route('dorm') }}" class="btn btn-outline-secondary">Back to Dorms</a>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12"> <!-- Increased the col size for a larger card -->
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="row g-0">
                            <!-- Room Image Section -->
                            <div class="col-lg-6 col-md-12">
                                <img src="{{ asset($room->image) }}" class="img-fluid w-100 h-100 object-cover rounded-start" alt="{{ $room->room_title }}" style="max-height: 500px;">
                            </div>
                            <!-- Room Details Section -->
                            <div class="col-lg-6 col-md-12 p-4">
                                <h3 class="fw-bold text-primary mb-3">{{ $room->room_title }}</h3>
                                <p class="mb-2"><strong>Description:</strong> {{ $room->description }}</p>
                                <p class="mb-2"><strong>Price:</strong> ₱{{ number_format($room->price, 2) }}</p>
                                <p class="mb-2"><strong>Amenities:</strong> {{ $room->amenities }}</p>
                                <p class="mb-2"><strong>Type:</strong> {{ $room->room_type }}</p>
                                
                                <!-- Book Now Button -->
                                <a href="{{ route('renter.book.create', ['room_id' => $room->id]) }}" class="btn btn-primary btn-lg mt-4 w-100">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Custom styles */
        .v-container {
            max-width: 1100px; /* Increased the container width for a bigger layout */
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card img {
            object-fit: cover;
            border-radius: 15px 0 0 15px; /* Rounded corners on the image side */
        }

        h3 {
            font-size: 1.85rem;
            color: #0d6efd;
        }

        .btn-primary {
            transition: background-color 0.3s, transform 0.3s;
            font-size: 1rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            background-color: #0056b3;
        }

        .btn-outline-secondary {
            transition: color 0.3s, border-color 0.3s;
        }

        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        main {
            padding-top: 80px; /* Additional spacing from the top */
            display: flex;
            justify-content: center;
        }
    </style>
</x-app-layout>
