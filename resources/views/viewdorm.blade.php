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
                    <img src="{{ asset($room->image) }}" class="img-fluid" alt="{{ $room->room_title }}">
                </div>
                <div class="col-md-6">
                    <h3>Room Details</h3>
                    <p><strong>Description:</strong> {{ $room->description }}</p>
                    <p><strong>Price:</strong> {{ number_format($room->price, 2) }}</p>
                    <p><strong>Amenities:</strong> {{ $room->amenities }}</p>
                    <p><strong>Type:</strong> {{ $room->room_type }}</p>
                    
                    <!-- Trigger Modal Button -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookingModal">Book Now</button>
                </div>
            </div>

            <!-- Modal Structure -->
            <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="bookingModalLabel">Booking Form</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <form action="{{ route('owner.incomingRequest') }}" method="POST">  <!-- Adjusted the action route here -->
                              @csrf  <!-- CSRF token for security -->
                              
                              <!-- Room ID (hidden) -->
                              <input type="hidden" name="room_id" value="{{ $room->id }}">
                              
                              <!-- User ID (hidden) -->
                              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                              
                              <!-- Owner ID (optional) -->
                              <input type="hidden" name="owner_id" value="{{ $room->owner_id }}">

                              <div class="form-group">
                                  <label for="move-in-date" class="col-form-label">Preferred Move-In Date:</label>
                                  <input type="date" class="form-control" id="move-in-date" name="move_in_date" required>
                              </div>

                              <div class="form-group">
                                  <label for="move-out-date" class="col-form-label">Preferred Move-Out Date:</label>
                                  <input type="date" class="form-control" id="move-out-date" name="move_out_date" required>
                              </div>

                              <div class="form-group">
                                  <label for="number-of-occupants" class="col-form-label">Number of Occupants:</label>
                                  <input type="number" class="form-control" id="number-of-occupants" name="number_of_occupants" min="1" required>
                              </div>

                              <div class="form-group">
                                  <label for="duration" class="col-form-label">Duration of Stay (Weeks/Months/Semester):</label>
                                  <input type="text" class="form-control" id="duration" name="duration" required>
                              </div>

                              <div class="form-group">
                                  <label for="message" class="col-form-label">Message:</label>
                                  <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                              </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Submit Booking</button>  <!-- This button submits the form -->
                      </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>


            <div class="mt-4">
                <a href="{{ route('dorm') }}" class="btn btn-secondary">Back to Dorms</a>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</x-app-layout>
