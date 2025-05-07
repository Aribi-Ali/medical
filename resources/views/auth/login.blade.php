@extends("layouts.patient-layout")
@section("content")
    @include("components.patient.navbar")
    <div class="min-h-screen bg-gradient-to-r from-teal-50 to-blue-50 py-8 mt-16 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">
                Sign in to <span class="text-teal-500">HealthHub</span>
            </h2>
        </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <section class="sm:mx-auto sm:w-full sm:max-w-md mx-auto bg-white backdrop-blur-lg bg-opacity-90 py-8 px-6 shadow-xl rounded-2xl sm:px-10 card-hover">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

        <div class="mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600  hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="bg-teal-500 hover:bg-teal-600">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
        </div>
    </section>
    </div>
@endsection
