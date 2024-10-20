<x-app-layout>
    <x-slot name="header">
        <!-- Optional header content -->
    </x-slot>

    <main style="margin-top: 80px;">
        <section id="hero" class="bg-primary text-white text-center py-5">
            <div class="container">
                <h1>Available Dorms</h1>
                <p>Find the perfect dorm for your stay in the city!</p>
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
                    @foreach($rooms as $room) <!-- Change $room to $rooms -->
                        @if($room->status) <!-- Only display approved rooms -->
                            <div class="col-md-12 mb-4">
                                <div class="card h-100 d-flex flex-row">
                                    <img src="{{ asset($room->image) }}" class="img-fluid" style="max-width: 300px;" alt="{{ $room->room_title }} Image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $room->room_title }}</h5>
                                        <p class="card-text"><strong>Price:</strong> {{ number_format($room->price, 2) }}</p>
                                        <p class="card-text"><strong>Type:</strong> {{ $room->room_type }}</p>
                                        <p class="card-text">{{ $room->description }}</p>
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
</x-app-layout>
