<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main>
            <!-- Carousel -->
            <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Carousel Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <!-- Carousel Inner -->
            <div class="carousel-inner">
                <div class="carousel-item active c-item">
                <img src="{{ asset('images/image1.jpg') }}" class="d-block w-100 c-img" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Apyong's Guest Room</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                    <button class="btn btn-primary">View Details</button>
                    </div>
                </div>
                <div class="carousel-item c-item">
                <img src="{{ asset('images/image2.jpg') }}" class="d-block w-100 c-img" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Apyong's Guest Room</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                    <button class="btn btn-primary">View Details</button>
                    </div>
                </div>
                <div class="carousel-item c-item">
                <img src="{{ asset('images/image1.jpg') }}" class="d-block w-100 c-img" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Apyong's Guest Room</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                    <button class="btn btn-primary">View Details</button>
                    </div>
                </div>
            </div>

            <!-- Previous Control -->
            <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <!-- Next Control -->
            <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> 
    </section>
  <section class="overview">
    <div class="container h-100 d-flex align-items-center">
      <div class="row w-100 text-center fs-4">
        <div class="col-xl">
          <i class="bi bi-coin me-2"></i>
          Affordable
        </div>
        <div class="col-xl">
          <i class="bi bi-fast-forward-fill me-2"></i>
          Easy Access
        </div>
        <div class="col-xl">
          <i class="bi bi-check-circle-fill me-2"></i>
          Less Hassle
        </div>
      </div>
    </div>

  <section id="feedback" class="pt-5">
    <h2 class="text-center my-5">Feedback</h2>
  
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <img src="{{ asset('images/image1.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Feedback</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">See more</a>
            </div>
          </div>
        </div>
  
        <div class="col-lg-4">
          <div class="card">
            <img src="{{ asset('images/image1.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Feedback</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">See more</a>
            </div>
          </div>
        </div>
  
        <div class="col-lg-4">
          <div class="card">
            <img src="{{ asset('images/image1.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Feedback</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">See more</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section id="aboutus" class="py-5 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <span class="text-muted">Our Story</span>
          <h2 class="display-5 fw-bold">About Us</h2>
          <p class="lead">At Stay Wise, we make it easy to find the perfect dorm or room in Dagupan, Pangasinan, offering a convenient and reliable platform to match you with your ideal accommodation.</p><a class="btn btn-primary mt-2" href="">Learn more</a>
        </div>
        <div class="col-md-6 offset-md-1">
          <p class="lead">Dear Customers,</p>
          <p class="lead">At Stay Wise, we make it easy to find the perfect dorm or room in Dagupan, Pangasinan. Our platform is designed to help students, professionals, and travelers discover affordable and comfortable accommodations that suit their needs. Whether you're looking for a short-term stay or a long-term arrangement, we provide detailed listings with essential information to ensure you make the right choice. Stay Wise is committed to offering a reliable, hassle-free experience, so you can focus on what matters most—finding a place that feels like home.</p>
        </div>
      </div>
    </div>
  </section>
  <footer class="bg-dark py-4 mt-5">
    <div class="container text-light text-center">
      <p class="display-5 mb-3">Stay Wise</p>
      <small class="text-white-50">&copy; Copyright by Apyong. All rights reserved.</small>
    </div>
  </footer>
  </main>

  
</x-app-layout>
