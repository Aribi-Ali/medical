@extends('layouts.patient-layout')
@section('content')
    @include('components.patient.navbar')
    <div class="min-h-screen py-8 mt-16 bg-gradient-to-r from-teal-50 to-blue-50 sm:px-6 lg:px-8">
        <div class="mb-16 text-center">
            <h2 class="mb-4 text-4xl font-extrabold text-gray-900">
                <span class="text-primary-600">Medical</span> Professional Registration
            </h2>
            <p class="mt-2 text-lg text-gray-600">Join our healthcare network and make a difference</p>
        </div>
        <div class="grid grid-cols-1 gap-12 mx-auto max-w-7xl lg:grid-cols-2">
            <!-- Doctor Registration Form -->
            <div
                class="flex flex-col min-h-[800px] bg-white backdrop-blur-lg bg-opacity-90 py-8 px-6 shadow-xl rounded-2xl sm:px-10 card-hover">
                <div class="flex items-center mb-8">
                    <span class="mr-3 text-3xl">👨‍⚕️</span>
                    <h3 class="text-2xl font-bold text-gray-900">Doctor Registration</h3>
                </div>
                <form method="POST" action="{{ route('doctor.register') }}" class="flex flex-col flex-grow">
                    @csrf
                    <div class="flex flex-col flex-grow">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')"
                                class="block mb-2 text-sm font-medium text-gray-700" />
                            <x-text-input id="name"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="Dr. John Doe" type="text" name="name" :value="old('name')" required
                                autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')"
                                class="block mb-2 text-sm font-medium text-gray-700" />
                            <x-text-input id="email"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="doctor@example.com" type="email" name="email" :value="old('email')" required
                                autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <x-input-label for="phone_number" :value="__('Phone Number')"
                                class="block mb-2 text-sm font-medium text-gray-700" />
                            <x-text-input id="phone_number"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="06 00 00 00 00" type="text" name="phone_number" :value="old('phone_number')" required
                                autocomplete="phone_number" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <!-- Specialization -->
                        <div class="mt-4">
                            <x-input-label for="specialization" :value="__('Specialization')"
                                class="block mb-2 text-sm font-medium text-gray-700" />
                            <select id="specialization"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                type="text" name="specialization" required autocomplete="specialization">
                                <option value="" disabled selected>Select your specialty</option>
                                <option value="generaliste">Médecin Généraliste</option>
                                <option value="cardiologue">Cardiologue</option>
                                <option value="dermatologue">Dermatologue</option>
                                <option value="neurologue">Neurologue</option>
                                <option value="ophtalmologue">Ophtalmologue</option>
                                <option value="pediatre">Pédiatre</option>
                                <option value="psychiatre">Psychiatre</option>
                                <option value="dentiste">Dentiste</option>
                                <option value="radiologue">Radiologue</option>
                                <option value="gynecologue">Gynécologue</option>
                                <option value="urologue">Urologue</option>
                                <option value="oncologue">Oncologue</option>
                                <option value="endocrinologue">Endocrinologue</option>
                                <option value="orthopediste">Orthopédiste</option>
                                <option value="otorhinolaryngologiste">Oto-rhino-laryngologiste (ORL)</option>
                                <option value="gastroenterologue">Gastro-entérologue</option>
                                <option value="rhumatologue">Rhumatologue</option>
                                <option value="chirurgien">Chirurgien</option>
                                <option value="anesthesiste">Anesthésiste</option>
                                <option value="nephrologue">Néphrologue</option>
                            </select>
                            <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Address')"
                                class="block mb-2 text-sm font-medium text-gray-700" />
                            <x-text-input id="address"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="Your business address" type="text" name="address" :value="old('address')"
                                required autofocus autocomplete="address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Wilaya -->
                        <div class="mt-4">
                            <x-input-label for="wilaya" :value="__('Wilaya')"
                                class="block mb-2 text-sm font-medium text-gray-700" />
                            <select id="wilayaSelect"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                name="wilaya"   >
                                <option value="" disabled selected>Loading cities...</option>
                            </select>
                            <x-input-error :messages="$errors->get('wilaya')" class="mt-2" />
                        </div>

                        <!--Biography -->
                        <div class="mt-4">
                            <x-input-label for="bio" :value="__('Biography')"
                                class="block mb-2 text-sm font-medium text-gray-700" />
                            <textarea id="bio"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="Tell us about your medical experience and expertise..." name="bio" required autocomplete="bio"
                                rows={4}></textarea>
                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="••••••••" type="password" name="password" required
                                autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-700" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="••••••••" type="password" name="password_confirmation" required
                                autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-8">
                        <x-primary-button>
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="/login" class="text-sm text-dashboardPrimary-600 hover:text-dashboardPrimary-500">
                            Already registered? Login here
                        </a>
                    </div>
                </form>
            </div>
            <!-- Pharmacist Registration Form -->
            <div
                class="flex flex-col min-h-[800px] bg-white backdrop-blur-lg bg-opacity-90 py-8 px-6 shadow-xl rounded-2xl sm:px-10 card-hover">
                <div class="flex items-center mb-8">
                    <span class="mr-3 text-3xl">💊️</span>
                    <h3 class="text-2xl font-bold text-gray-900">Pharmacist Registration</h3>
                </div>
                <form method="POST" action="{{ route('pharmacist.register') }}"
                    class="flex flex-col flex-grow space-y-6">
                    @csrf
                    <div class="flex flex-col flex-grow">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')"
                                class="block mb-2 text-sm font-medium text-gray-700" />
                            <x-text-input id="name"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="Dr. John Doe" type="text" name="name" :value="old('name')" required
                                autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')"
                                class="block mb-2 text-sm font-medium text-gray-700" />
                            <x-text-input id="email"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="doctor@example.com" type="email" name="email" :value="old('email')"
                                required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <x-input-label for="phone_number" :value="__('Phone Number')"
                                class="block mb-2 text-sm font-medium text-gray-700" />
                            <x-text-input id="phone_number"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="06 00 00 00 00" type="text" name="phone_number" :value="old('phone_number')"
                                required autocomplete="phone_number" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="••••••••" type="password" name="password" required
                                autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-700" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation"
                                class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg shadow-sm input-field form-input-focus"
                                placeholder="••••••••" type="password" name="password_confirmation" required
                                autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-8">
                        <x-primary-button>
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="/login" class="text-sm text-dashboardPrimary-600 hover:text-dashboardPrimary-500">
                            Already registered? Login here
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const wilayaSelect = document.getElementById('wilayaSelect');
            try {
                wilayaSelect.innerHTML = '<option value="" disabled selected>Loading wilayas...</option>';
                wilayaSelect.disabled = true;
                const response = await fetch('/wilayas');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                // Clear loading message
                wilayaSelect.innerHTML = '';
                const defaultOption = new Option('Select a wilaya', '', true, true);
                defaultOption.disabled = true;
                wilayaSelect.add(defaultOption);

                data.wilayas.forEach(city => {
                    const lowerCaseName = city.name.toLowerCase();
                    wilayaSelect.add(new Option(city.name, lowerCaseName));
                });
            } catch (error) {
                console.error('Error:', error);
                wilayaSelect.innerHTML = '<option value="" disabled selected>Error loading cities</option>';
            } finally {
                wilayaSelect.disabled = false;
            }
        });
    </script>
@endsection
