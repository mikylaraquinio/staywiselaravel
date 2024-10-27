<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main>
      <section class="hero">
          <div class="container d-flex text-white">
              <h1 class="content d-flex align-items-left text-white fs-1" style="font-size: 1.5em; font-weight: bold;">
                  Find Your Perfect <br>
                  Accommodation with StayWise
              </h1>
              <h2 class="subheadline text-white" style="font-size: 1.2em; margin-top: 10px;">
                  Your journey to comfortable living starts here!
              </h2>
              <a href="{{ route('dorm') }}" class="btn-heros btn-lg mt-3">Find Rooms</a>
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
      </section>

      <section>
      <!-- Check if there are no rooms -->
      @if($rooms->isEmpty())
          <div class="alert alert-info">No rooms available at the moment.</div>
      @else
          <!-- Carousel -->
          <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
              <!-- Carousel Indicators -->
              <div class="carousel-indicators">
                  @foreach($rooms as $key => $room)
                      <button type="button" data-bs-target="#carouselBasicExample" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $key + 1 }}"></button>
                  @endforeach
              </div>

              <!-- Carousel Inner -->
              <div class="carousel-inner">
                  @foreach($rooms as $key => $room)
                      <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" style="height: 400px; overflow: hidden;">
                          <img src="{{ asset($room->image) }}" class="d-block w-100" alt="{{ $room->room_title }}" style="height: 100%; object-fit: cover;">
                          <div class="carousel-caption d-none d-md-block">
                              <a href="{{ route('viewdorm', $room->id) }}" class="btn btn-primary">View Details</a>
                          </div>
                      </div>
                  @endforeach
              </div>

              <!-- Previous Control -->
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselBasicExample" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
              </button>

              <!-- Next Control -->
              <button class="carousel-control-next" type="button" data-bs-target="#carouselBasicExample" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
              </button>
          </div>
      @endif
  </section>

      
      <section id="aboutus" class="py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <span class="text-muted" style="font-size: 0.9rem;">Our Story</span>
                    <h2 class="display-6 fw-bold" style="font-size: 1.75rem;">About Us</h2>
                    <p class="lead" style="font-size: 0.95rem;">At Stay Wise, we make it easy to find the perfect dorm or room in Dagupan, Pangasinan, offering a convenient and reliable platform to match you with your ideal accommodation.</p>
                    <a class="btn btn-primary mt-2" href="">Learn more</a>
                </div>
                <div class="col-md-6 offset-md-1">
                    <p class="lead" style="font-size: 0.95rem;">Dear Customers,</p>
                    <p class="lead" style="font-size: 0.9rem;">At Stay Wise, we make it easy to find the perfect dorm or room in Dagupan, Pangasinan. Our platform is designed to help students, professionals, and travelers discover affordable and comfortable accommodations that suit their needs. Whether you're looking for a short-term stay or a long-term arrangement, we provide detailed listings with essential information to ensure you make the right choice. Stay Wise is committed to offering a reliable, hassle-free experience, so you can focus on what matters most—finding a place that feels like home.</p>
                </div>
            </div>
        </div>
      </section>


      <footer class="sticky-footer bg-white">
        <div class="container my-auto">        
          <div class="copyright text-center my-auto">         
             <span>Copyright &copy; StayWise 2024</span>           
          </div>           
        </div>        
      </footer>   
      
    </main>

  
</x-app-layout>
