<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <section class="registration">
            <div class="container" id="container">
                <div class="form-container sign-up-container" style="max-height: 500px; overflow-y: auto; padding: 40px 20px;">
                    <h1 class="text-center" style="margin-bottom: 20px;">Create Account</h1>
                    <span class="text-center block mb-4">or use your email for registration</span>

                    <!-- Role Selection -->
                    <div class="infield">
                        <label for="role" class="block mt-2">Select your role:</label>
                        <select id="role" name="role" class="block mt-2 w-full" required onchange="toggleFields()">
                            <option value="" disabled selected>Select your role</option>
                            <option value="owner">Owner</option>
                            <option value="renter">Renter</option>
                        </select>
                    </div>

                    <!-- Common Fields -->
                    <div class="infield">
                        <x-text-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required placeholder="Enter your full name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="infield">
                        <x-text-input id="number" class="block mt-2 w-full" type="number" name="number" :value="old('number')" required placeholder="Enter your Phone number" />
                        <x-input-error :messages="$errors->get('number')" class="mt-2" />
                    </div>

                    <div class="infield">
                        <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required placeholder="Enter your email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="infield">
                        <x-text-input id="password" class="block mt-2 w-full" type="password" name="password" required placeholder="Enter your password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="infield">
                        <x-text-input id="password_confirmation" class="block mt-2 w-full" type="password" name="password_confirmation" required placeholder="Confirm your password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Owner-Specific Fields -->
                    <div id="ownerFields" style="display: none;">
                        <div class="infield">
                            <label for="identification" class="block mt-2">Please select ID:</label>
                            <select id="identification" name="identification" class="block mt-2 w-full" required>
                                <option value="" disabled selected>Select an option</option>
                                <option value="id1">Driver's License</option>
                                <option value="id2">National Identity Card</option>
                                <option value="id3">Passport</option>
                            </select>
                            <x-input-error :messages="$errors->get('identification')" class="mt-2" />
                        </div>

                        <div class="infield mt-4">
                            <label for="imageUpload" class="block mt-2">Upload ID Image:</label>
                            <input id="imageUpload" type="file" name="image" class="block mt-2 w-full" accept="image/*" required />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Sign Up</button>
                </div>

                <div class="overlay-container" id="overlayCon">
                    <div class="overlay">
                        <div class="overlay-panel overlay-right">
                            <h1>Hello, Friend!</h1>
                            <p>Fill in your information to begin your journey with us.</p>
                            <button class="btn btn-secondary" id="overlayBtn">Sign Up</button>
                        </div>
                    </div>
                </div>

                <!-- Scroll to Top Button -->
                <button id="scrollToTopBtn" style="display: none; position: fixed; bottom: 20px; right: 20px; background-color: #007bff; color: white; border: none; padding: 10px; border-radius: 5px;">
                    ↑
                </button>
            </div>
        </section>
    </form>

    <script>
        const container = document.getElementById('container');
        const overlayBtn = document.getElementById('overlayBtn');
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');

        overlayBtn.addEventListener('click', () => {
            container.classList.toggle('left-panel-active');
        });

        // Show or hide the scroll button based on scroll position
        window.onscroll = function() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };

        // Smooth scroll to top on button click
        scrollToTopBtn.onclick = function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };

        // Toggle fields based on selected role
        function toggleFields() {
            const role = document.getElementById('role').value;
            const ownerFields = document.getElementById('ownerFields');

            if (role === 'owner') {
                ownerFields.style.display = 'block';
            } else {
                ownerFields.style.display = 'none';
            }
        }
    </script>
</x-guest-layout>
