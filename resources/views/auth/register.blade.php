@extends('layouts.patient-layout')
@section('content')
    @include('components.patient.navbar')
    <div class="min-h-screen bg-gradient-to-r from-teal-50 to-blue-50 py-8 mt-16 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">
                Sign up to <span class="text-teal-500">HealthHub</span>
            </h2>
            <p class="mt-2 text-lg text-gray-600">Join our healthcare network and make a difference</p>
        </div>
        <section
            class="sm:mx-auto sm:w-full sm:max-w-md mx-auto bg-white backdrop-blur-lg bg-opacity-90 py-8 px-6 shadow-xl rounded-2xl sm:px-10 card-hover">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-input-label for="phone_number" :value="__('Phone Number')" />
                        <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                            :value="old('phone_number')" required autocomplete="phone_number" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-primary-button class="bg-teal-500 hover:bg-teal-600">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
