<x-app-layout>
    <x-slot name="header">
        <!-- Optional header content -->
    </x-slot>

    <main style="margin-top: 80px;">
        <section id="hero" class="bg-primary text-white text-center py-5">
            <div class="container">
                <h1 class="display-4">Available Dorms</h1>
                <p class="lead">Find the perfect dorm for your stay in the city!</p>
            </div>
        </section>

        <section id="dorms" class="py-5">
            <div class="container">
                <div class="row text-center mb-4">
                    <div class="col">
                        <h2 class="fw-bold">Our Dormitories</h2>
                        <p class="text-muted">Browse through our available dormitories with comfortable amenities.</p>
                    </div>
                </div>
                <div class="row">
                @foreach($rooms as $room)
                    @if($room->approved && $room->available)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset($room->image) }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="{{ $room->room_title }} Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $room->room_title }}</h5>
                                    <p class="card-text"><strong>Price:</strong> {{ number_format($room->price, 2) }}</p>
                                    <p class="card-text"><strong>Type:</strong> {{ $room->room_type }}</p>
                                    <p class="card-text">{{ Str::limit($room->description, 100, '...') }}</p>
                                    <a href="{{ route('viewdorm', ['id' => $room->id]) }}" class="btn btn-primary">View More</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
        </section>  
    </main>

    <style>
        /* Custom styles */
        #hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-title {
            font-size: 1.25rem; /* Adjust title size */
        }

        .card-text {
            font-size: 0.9rem; /* Adjust text size */
        }

        .btn {
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue for hover effect */
        }
    </style>
</x-app-layout>
