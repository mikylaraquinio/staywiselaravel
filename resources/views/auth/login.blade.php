<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <section class="registration">
            <div class="container" id="container">
                <div class="form-container sign-in-container">
                        <h1>Sign in</h1>
                        @if(session()->has('message'))
                            <p class="alert alert-info">
                                {{session()->get('message')}}
                            </p>
                        @endif
                        <!-- Email Address -->
                        <div class="infield">
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <!-- Password -->
                        <div class="infield">
                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required placeholder="Password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <!-- Remember Me -->
                        <div class="infield block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-primary-button class="ms-3">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                </div>
                <div class="overlay-container" id="overlayCon">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <h1>Welcome Back!</h1>
                            <p>To keep connected with us please login with your personal info</p>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h1>Hello, Friend!</h1>
                            <p>Enter your personal details and start journey with us</p>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const container = document.getElementById('container');
                const overlayBtn = document.getElementById('overlayBtn');

                overlayBtn.addEventListener('click', () => {
                    container.classList.toggle('right-panel-active');

                    overlayBtn.classList.remove('btnScaled');
                    window.requestAnimationFrame(()=>{
                        overlayBtn.classList.add('btnScaled');
                    })
                });
            </script>
        </section>
    </form>
</x-guest-layout>



