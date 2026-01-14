<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            <div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center gap-3">
                <!-- Register Button -->
                <a href="{{ route('register') }}" 
                   style="display: inline-flex; align-items: center; padding: 10px 16px; background-color: #6b7280; border: 1px solid transparent; border-radius: 0.375rem; font-weight: 600; font-size: 12px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.05em; transition: all 0.15s; text-decoration: none;"
                   onmouseover="this.style.backgroundColor='#4b5563'"
                   onmouseout="this.style.backgroundColor='#6b7280'">
                    {{ __('Register') }}
                </a>

                <!-- Login Button -->
                <button type="submit"
                        style="display: inline-flex; align-items: center; padding: 10px 16px; background-color: #4f46e5; border: 1px solid transparent; border-radius: 0.375rem; font-weight: 600; font-size: 12px; color: #ffffff; text-transform: uppercase; letter-spacing: 0.05em; transition: all 0.15s;"
                        onmouseover="this.style.backgroundColor='#4338ca'"
                        onmouseout="this.style.backgroundColor='#4f46e5'">
                    {{ __('Log in') }}
                </button>
            </div>
        </div>
    </form>

    <!-- Register Section -->
    <div class="mt-6 pt-6 border-t border-gray-200 text-center">
        <p class="text-sm text-gray-600 mb-3">
            {{ __("Don't have an account? -> Than create one ;)") }}
        </p>

        <p class="text-sm text-gray-600 mb-3">
            {{ __("It's FREE of charge!") }}
        </p>
    </div>
</x-guest-layout>
