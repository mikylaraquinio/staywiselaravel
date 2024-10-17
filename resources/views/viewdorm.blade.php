<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <main>
    <header class="bg-primary text-white text-center py-5">
        <h1>Room Name / Apartment Name</h1>
        <p>Located in Dagupan, Pangasinan</p>
    </header>

    <div class="container my-5">
        <div class="text-center">
        <img src="d1.jpeg" class="img-fluid" alt="Room Image">
        </div>
        <div class="row mt-5">
        <div class="col-md-8">
            <h2>Room Description</h2>
            <p>This spacious room is perfect for students or working professionals. The room is fully furnished and includes a comfortable bed, study table, and ample storage space. It’s located in a quiet neighborhood, just a short walk from public transport and local amenities.</p>
        </div>
        <div class="col-md-4">
            <div class="border p-3">
            <h3>Price: ₱7,500/month</h3>
            <p><strong>Available:</strong> Immediately</p>
            <a href="#" class="btn btn-primary w-100">Book Now</a>
            </div>
        </div>
        </div>
        <div class="row mt-5">
        <h2>Amenities</h2>
        <div class="col-md-3">
            <ul class="list-group">
            <li class="list-group-item">Air Conditioning</li>
            <li class="list-group-item">Free Wi-Fi</li>
            <li class="list-group-item">Study Desk</li>
            <li class="list-group-item">Wardrobe</li>
            </ul>
        </div>
        <div class="col-md-3">
            <ul class="list-group">
            <li class="list-group-item">Private Bathroom</li>
            <li class="list-group-item">Kitchen Access</li>
            <li class="list-group-item">Laundry Facilities</li>
            <li class="list-group-item">Parking Space</li>
            </ul>
        </div>
        <div class="col-md-3">
            <ul class="list-group">
            <li class="list-group-item">24/7 Security</li>
            <li class="list-group-item">Nearby Public Transport</li>
            <li class="list-group-item">CCTV Cameras</li>
            <li class="list-group-item">Water Heater</li>
            </ul>
        </div>
        </div>
        <div class="row mt-5">
        <h2>Contact Details</h2>
        <div class="col-md-12">
            <p>If you're interested in booking the room or have any inquiries, feel free to contact the landlord:</p>
            <ul class="list-group">
            <li class="list-group-item"><strong>Name:</strong> Juan Dela Cruz</li>
            <li class="list-group-item"><strong>Phone:</strong> +63 912 345 6789</li>
            <li class="list-group-item"><strong>Email:</strong> juandelacruz@example.com</li>
            <li class="list-group-item"><strong>Address:</strong> Room Name, Dagupan, Pangasinan, Philippines</li>
            </ul>
        </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </main>

  
</x-app-layout>
