<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <section class="registration">
            <div class="container" id="container">
                <div class="form-container sign-up-container">
                    <h1>Create Account</h1>
                    <span>or use your email for registration</span>
                    <!-- Name -->
                    <div class="infield">
                        <x-text-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required autofocus  placeholder="Enter your name"  />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <label></label>
                    </div>
                    <!-- Email Address -->
                    <div class="infield">
                        <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required  placeholder="Enter your email"  />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="infield">
                        <x-text-input id="password" class="block mt-2 w-full" type="password" name="password" required  placeholder="Enter your password"  />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Confirm Password -->
                    <div class="infield">
                        <x-text-input id="password_confirmation" class="block mt-2 w-full" type="password" name="password_confirmation" required placeholder="Confirm your password"  />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <button class="btn btn-primary">Sign Up</button>
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
            </div>
        </section>
    </form>

    <script>
        const container = document.getElementById('container');
        const overlayBtn = document.getElementById('overlayBtn');
        overlayBtn.addEventListener('click', () => {
            container.classList.toggle('left-panel-active');
        });
    </script>
</x-guest-layout>
