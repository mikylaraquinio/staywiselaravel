<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <main>
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
        <div class="col-md-12 mb-4">
          <div class="card h-100 d-flex flex-row">
            <img src="{{ asset('images/image1.jpg') }}" class="img-fluid" style="max-width: 300px;" alt="Dorm 1 Image">
            <div class="card-body">
              <h5 class="card-title">Dorm A</h5>
              <p class="card-text"><strong>Location:</strong> Dagupan, Pangasinan</p>
              <p class="card-text">A cozy dorm located near public transport and universities, ideal for students.</p>
              <a href="{{ route('viewdorm') }}" class="btn btn-primary">View More</a>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-4">
          <div class="card h-100 d-flex flex-row">
            <img src="{{ asset('images/image1.jpg') }}" class="img-fluid" style="max-width: 300px;" alt="Dorm 2 Image">
            <div class="card-body">
              <h5 class="card-title">Dorm B</h5>
              <p class="card-text"><strong>Location:</strong> Urdaneta, Pangasinan</p>
              <p class="card-text">Affordable dormitory with shared amenities, perfect for budget-conscious tenants.</p>
              <a href="{{ route('viewdorm') }}" class="btn btn-primary">View More</a>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-4">
          <div class="card h-100 d-flex flex-row">
            <img src="{{ asset('images/image1.jpg') }}" class="img-fluid" style="max-width: 300px;" alt="Dorm 3 Image">
            <div class="card-body">
              <h5 class="card-title">Dorm C</h5>
              <p class="card-text"><strong>Location:</strong> San Carlos, Pangasinan</p>
              <p class="card-text">Spacious and modern dorm with private rooms and high-speed internet access.</p>
              <a href="{{ route('viewdorm') }}" class="btn btn-primary">View More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card h-100 d-flex flex-row">
            <img src="{{ asset('images/image1.jpg') }}" class="img-fluid" style="max-width: 300px;" alt="Dorm 4 Image">
            <div class="card-body">
              <h5 class="card-title">Dorm D</h5>
              <p class="card-text"><strong>Location:</strong> Alaminos, Pangasinan</p>
              <p class="card-text">Quiet dorm located near natural parks, perfect for those who love a peaceful environment.</p>
              <a href="{{ route('viewdorm') }}" class="btn btn-primary">View More</a>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-4">
          <div class="card h-100 d-flex flex-row">
            <img src="{{ asset('images/image1.jpg') }}" class="img-fluid" style="max-width: 300px;" alt="Dorm 5 Image">
            <div class="card-body">
              <h5 class="card-title">Dorm E</h5>
              <p class="card-text"><strong>Location:</strong> Lingayen, Pangasinan</p>
              <p class="card-text">A spacious dormitory with both private and shared rooms, close to Lingayen Beach.</p>
              <a href="{{ route('viewdorm') }}" class="btn btn-primary">View More</a>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-4">
          <div class="card h-100 d-flex flex-row">
            <img src="{{ asset('images/image1.jpg') }}" class="img-fluid" style="max-width: 300px;" alt="Dorm 6 Image">
            <div class="card-body">
              <h5 class="card-title">Dorm F</h5>
              <p class="card-text"><strong>Location:</strong> Calasiao, Pangasinan</p>
              <p class="card-text">Modern dorm with top-notch facilities and 24/7 security, close to commercial areas.</p>
              <a href="{{ route('viewdorm') }}" class="btn btn-primary">View More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>  
</main>

  
</x-app-layout>
