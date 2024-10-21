<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $room->room_title }}
        </h2>
    </x-slot>

    <main style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset($room->image) }}" class="img-fluid rounded shadow" alt="{{ $room->room_title }}">
                </div>
                <div class="col-md-6">
                    <h3 class="fw-bold">Room Details</h3>
                    <p><strong>Description:</strong> {{ $room->description }}</p>
                    <p><strong>Price:</strong> {{ number_format($room->price, 2) }}</p>
                    <p><strong>Amenities:</strong> {{ $room->amenities }}</p>
                    <p><strong>Type:</strong> {{ $room->room_type }}</p>

                    <!-- Trigger Modal Button -->
                    <a href="{{ route('renter.book.create', ['room_id' => $room->id]) }}" class="btn btn-primary mt-3">Book Now</a>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('dorm') }}" class="btn btn-secondary">Back to Dorms</a>
            </div>
        </div>
    </main>

    <style>
        /* Custom styles for room details */
        img {
            max-height: 400px; /* Set a max height for images */
            object-fit: cover; /* Maintain aspect ratio */
        }

        h3 {
            margin-top: 20px; /* Space above the heading */
        }

        .btn {
            transition: background-color 0.3s, transform 0.3s; /* Smooth transitions */
        }

        .btn:hover {
            transform: scale(1.05); /* Scale effect on hover */
        }

        .shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Optional: Add a listener to check form submission
            $('#bookingForm').on('submit', function(event) {
                // Perform any validation if necessary
                console.log('Form is being submitted');
                // You can add more checks here if needed
            });
        });
    </script>
</x-app-layout>
