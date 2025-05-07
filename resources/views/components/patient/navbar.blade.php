<!-- Navbar -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 py-4 transition-all duration-300 bg-transparent">
    <div class="container px-4 mx-auto">
        <div class="flex items-center justify-between">
            <a href="/" class="flex items-center">
                <div class="relative w-10 h-10 mr-2">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full">
                        {{-- <span class="font-bold text-white">H</span> --}}
                    <img src="{{asset("logo-patient.png")}} " alt="">
                    </div>
                </div>
                <span class="text-xl font-bold text-gray-900">Patient Access</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="items-center hidden space-x-8 md:flex">
                <a href="{{ route('doctors.search') }}"
                    class="text-gray-700 transition-colors hover:text-teal-500">{{ __('landingpage.book-appointment') }}
                </a>
                <a href="{{ route('find-pharmacy') }}"
                    class="text-gray-700 transition-colors hover:text-teal-500">{{ __('pharmacy.find-pharmacy') }} </a>


                @if (Auth::check())
                    @if (Auth::user()->role == 'doctor' || Auth::user()->role == 'patient')


                        @php
                            $unviewedDocumentsCount = \App\Models\Document::where('receiver_id', auth()->id())
                                ->where('is_vued', false)
                                ->count();
                        @endphp

                        <a href="{{ route('documents.index') }}" class="relative inline-block">
                            <!-- Messages Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 12.75h7.5m-7.5-3h7.5m-7.5 6h4.5M21 12c0 4.971-4.029 9-9 9a8.963 8.963 0 01-4.98-1.47L3 21l1.47-4.98A8.963 8.963 0 013 12c0-4.971 4.029-9 9-9s9 4.029 9 9z" />
                            </svg>

                            @if ($unviewedDocumentsCount > 0)
                                <!-- Notification Badge -->
                                <span
                                    class="absolute top-0 right-0 px-2 py-1 text-xs font-bold text-white transform translate-x-2 -translate-y-2 bg-red-500 rounded-full">
                                    {{ $unviewedDocumentsCount }}
                                </span>
                            @endif
                        </a>
                    @endif
                    @if (Auth::user()->role == 'doctor')
                        <a href="{{ route('doctor.schedules', Auth::user()->id) }} "
                            class="text-gray-700 transition-colors hover:text-teal-500">{{ __('pharmacy.clinique') }}
                        </a>
                    @elseif (Auth::user()->role == 'pharmacist')
                        <a href="{{ route('pharmacies.index') }}"
                            class="text-gray-700 transition-colors hover:text-teal-500">{{ __('pharmacy.pharmacies') }}</a>
                    @endif

                @endif

                <button class="px-5 py-2 text-white transition duration-300 bg-teal-500 rounded-lg hover:bg-teal-600">
                    <a href="{{ route('doctors.search') }}">{{ __('landingpage.book-appointment') }}</a>
                </button>
                @if (!Auth::user())
                    <button
                        class="px-5 py-2 text-teal-500 transition duration-300 bg-white rounded-lg hover:bg-teal-500 hover:text-white">
                        <a href="{{ route('register.options') }}">{{ __('pharmacy.become-partner') }} </a>
                    </button>
                @endif


                <!-- Language Switcher -->
                <div class="relative">
                    <!-- Button -->
                    <button onclick="toggleDropdown()" id="lang-button"
                        class="flex items-center px-3 py-2 space-x-2 rounded-md focus:outline-none">
                        <span class="text-sm">{{ strtoupper(app()->getLocale()) }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div id="lang-dropdown"
                        class="absolute left-0 hidden w-32 mt-2 text-gray-900 bg-white rounded-md shadow-md">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-200">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
               @if (Auth::check())

                <div class="relative">
                    <!-- Button -->
                    <button onclick="toggleDropdown2()" id="profile-button"
                        class="flex items-center px-3 py-2 space-x-2 rounded-md focus:outline-none">
                        <span class="text-sm">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div id="profile-dropdown"
                        class="absolute left-0 hidden w-32 mt-2 text-gray-900 bg-white rounded-md shadow-md">

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                    </div>
                </div>
@endif
                <script>
                    function toggleDropdown() {
                        document.getElementById("lang-dropdown").classList.toggle("hidden");
                    }

                    // Close dropdown when clicking outside
                    document.addEventListener("click", function(event) {
                        const dropdown = document.getElementById("lang-dropdown");
                        const button = document.getElementById("lang-button");

                        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                            dropdown.classList.add("hidden");
                        }
                    });


                    function toggleDropdown2() {
                        document.getElementById("profile-dropdown").classList.toggle("hidden");
                    }

                    // Close dropdown when clicking outside
                    document.addEventListener("click", function(event) {
                        const dropdown2 = document.getElementById("profile-dropdown");
                        const button2 = document.getElementById("profile-button");

                        if (!button2.contains(event.target) && !dropdown2.contains(event.target)) {
                            dropdown2.classList.add("hidden");
                        }
                    });
                </script>

</nav>
