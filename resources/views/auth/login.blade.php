<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 shadow-sm focus:ring-[#16697a]" style="color: #16697a;" name="remember">
                <span class="ml-2 text-sm" style="color: #5a6c7d;">Ricordami</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#16697a]" style="color: #5a6c7d;" onmouseover="this.style.color='#16697a'" onmouseout="this.style.color='#5a6c7d'" href="{{ route('password.request') }}">
                    Password dimenticata?
                </a>
            @endif

            <x-primary-button class="ml-3">
                Accedi
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
