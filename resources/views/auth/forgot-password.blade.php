<x-guest-layout>
    <main class="flex flex-wrap items-center justify-center py-6 h-screen sm:w-10/12 sm:mx-auto">

        <form method="POST" action="{{ route('password.email') }}" class="sm:1/3 md:w-1/2 bg-white p-5 rounded shadow-lg">
            @csrf

            <p class="mb-5">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
        </form>
        
    </main>
</x-guest-layout>
