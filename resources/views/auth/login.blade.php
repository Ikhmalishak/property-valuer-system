<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="font-medium text-gray-700"/>
            <x-text-input id="email"
                          class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="font-medium text-gray-700"/>
            <x-text-input id="password"
                          class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mt-4">
            <input id="remember_me" type="checkbox"
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <label for="remember_me" class="ms-2 text-sm text-gray-700">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-end mt-6 space-y-2 sm:space-y-0 sm:space-x-4">
            @if (Route::has('register'))
                <a class="underline text-sm text-gray-700 hover:text-gray-900 transition" href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
            @endif

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-700 hover:text-gray-900 transition" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif

            @if (Route::has('admin'))
                <a class="underline text-sm text-gray-700 hover:text-gray-900 transition" href="{{ route('admin') }}">
                    {{ __('Admin') }}
                </a>
            @endif

            <x-primary-button class="ms-3 px-6 py-2 text-base rounded-lg">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
