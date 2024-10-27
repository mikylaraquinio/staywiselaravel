<x-app-layout>
    <x-slot name="header">
        <!-- Optional header content -->
    </x-slot>

    <main style="margin-top: 80px;">
        <section id="dorm" class="py-5">
            <div class="container">

                <!-- Header Section -->
                <div class="row mb-4 text-center">
                    <div class="col">
                        <h2 class="fw-bold text-secondary">Our Dormitories</h2>
                        <p class="text-muted">Explore our dormitories designed to provide comfort and convenience for every student.</p>
                    </div>
                </div>

            <section>    
                <div class="container filter-area">
    <div class="row justify-content-center dropdown-container">
        <div class="col-6 col-md-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-plus-circle me-2" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="priceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Price Range
                </button>
                <ul class="dropdown-menu" aria-labelledby="priceDropdown">
                    <li><a class="dropdown-item" href="?price_range=0-5000">0 - 5,000</a></li>
                    <li><a class="dropdown-item" href="?price_range=5000-10000">5,000 - 10,000</a></li>
                    <li><a class="dropdown-item" href="?price_range=10000-15000">10,000 - 15,000</a></li>
                    <li><a class="dropdown-item" href="?price_range=15000+">15,000+</a></li>
                </ul>
            </div>
        </div>

        <div class="col-6 col-md-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-plus-circle me-2" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="amenitiesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Amenities
                </button>
                <ul class="dropdown-menu" aria-labelledby="amenitiesDropdown">
                    <li><a class="dropdown-item" href="?amenities=wifi">Wi-Fi</a></li>
                    <li><a class="dropdown-item" href="?amenities=ac">Air Conditioning</a></li>
                    <li><a class="dropdown-item" href="?amenities=laundry">Laundry</a></li>
                    <li><a class="dropdown-item" href="?amenities=kitchen">Kitchen</a></li>
                </ul>
            </div>
        </div>

        <div class="col-6 col-md-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-plus-circle me-2" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="bedTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Bed Type
                </button>
                <ul class="dropdown-menu" aria-labelledby="bedTypeDropdown">
                    <li><a class="dropdown-item" href="?bed_type=single">Single</a></li>
                    <li><a class="dropdown-item" href="?bed_type=double">Double</a></li>
                    <li><a class="dropdown-item" href="?bed_type=bunk">Bunk Bed</a></li>
                </ul>
            </div>
        </div>

        <div class="col-6 col-md-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-plus-circle me-2" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="petFriendlyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Pet Friendly
                </button>
                <ul class="dropdown-menu" aria-labelledby="petFriendlyDropdown">
                    <li><a class="dropdown-item" href="?pet_friendly=yes">Yes</a></li>
                    <li><a class="dropdown-item" href="?pet_friendly=no">No</a></li>
                </ul>
            </div>
        </div>

        <div class="col-6 col-md-2 d-flex align-items-center justify-content-center">
            <button type="submit" class="btn btn-outline-primary w-100">Apply Filters</button>
        </div>
    </div>
</div>

            </section>

                
            <section>
                <!-- Dorm Cards -->
                <div class="row">
                    @foreach($rooms as $room)
                        @if($room->approved && $room->available)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm border-0 rounded-3">
                                    <img src="{{ asset($room->image) }}" class="card-img-top img-fluid rounded-top" style="height: 200px; object-fit: cover;" alt="{{ $room->room_title }} Image">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">{{ $room->room_title }}</h5>
                                        <p class="card-text mb-1"><strong>Price:</strong> ₱{{ number_format($room->price, 2) }}</p>
                                        <p class="card-text mb-1"><strong>Type:</strong> {{ $room->room_type }}</p>
                                        <p class="card-text text-muted">{{ Str::limit($room->description, 100, '...') }}</p>
                                        <a href="{{ route('viewdorm', ['id' => $room->id]) }}" class="btn btn-primary mt-3 w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>  
        </section>
    </main>

    <style>
    /* Custom styles */
    #dorm h2 {
        font-size: 1.75rem;
        color: #333; /* Darker, neutral color for heading */
        font-weight: 600;
        text-align: center; /* Centering the heading */
        margin-bottom: 1.5rem;
    }

    /* Styling the dropdown button and icon */
    .dropdown .btn-outline-secondary {
        width: auto;
        padding: 0.5rem 1rem; /* Compact padding */
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: background-color 0.2s ease, color 0.2s ease;
        margin-right: 0.75rem; /* Space between dropdowns */
    }

    /* Dropdown menu container styling */
    .dropdown-menu {
        background-color: #f8f9fa; /* Custom background color */
        border-color: #007bff; /* Optional border color */
    }

    /* Dropdown item styling */
    .dropdown-menu .dropdown-item {
        color: #333; /* Text color for items */
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #007bff; /* Blue on hover */
        color: #fff; /* White text on hover */
    }

    /* Plus icon styling */
    .fas {
        font-size: 1.3rem; /* Adjust size of plus icon */
        color: #007bff;
        margin-right: 0.5rem; /* Space between icon and text */
        cursor: pointer;
    }

    .btn-outline-secondary:hover {
        background-color: #f8f9fa; /* Light background on hover */
        color: #007bff;
    }

    /* Apply Filters button */
    .btn-outline-primary {
        border-color: #007bff;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: background-color 0.2s ease, color 0.2s ease;
        margin-top: 0.75rem; /* Align with dropdowns */
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Card styling */
    .card {
        transition: transform 0.2s;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 500;
    }

    .card-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    /* Layout adjustments for dropdowns and Apply Filters button */
    .dropdown-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem; /* Space between elements */
        justify-content: center;
    }

    /* Overall spacing for form area */
    .filter-area {
        padding: 1rem 0;
        border-bottom: 1px solid #ddd;
        margin-bottom: 1.5rem;
    }
</style>



</x-app-layout>
