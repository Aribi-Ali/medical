@extends("layouts.patient-layout")
@section("content")
    @include("components.patient.navbar")
    <section class="w-full bg-gray-50 py-8 mt-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Find a Pharmacy Near You</h1>
                <p class="text-lg text-gray-600">Search for pharmacies in your area and check their availability</p>
            </div>
            <!-- Search and Filter Section -->
            <form action="{{ route('find-pharmacy') }}" method="GET" class="mb-8 bg-white rounded-lg shadow-md p-6">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label htmlFor="city" class="block text-sm font-medium text-gray-700">
                            Filter by City
                        </label>
                        <select
                            id="wilayaSelect"
                            name="wilaya"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-dashboardPrimary-500 focus:border-dashboardPrimary-500"
                        >
                            <option value="" disabled selected>Loading cities...</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input
                                name="isOpen"
                                type="checkbox"
                            class="w-4 h-4 text-dashboardPrimary-600 border-gray-300 rounded focus:ring-dashboardPrimary-500"
                            />
                            <span class="text-sm text-gray-700">Show Open Pharmacies Only</span>
                        </label>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button
                        type="submit"
                        class="px-6 py-2 bg-dashboardPrimary-600 text-white rounded-md hover:bg-dashboardPrimary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-dashboardPrimary-500 focus:ring-offset-2"
                    >
                        Search Pharmacies
                    </button>
                </div>
            </form>
            <!-- Available Pharmacies -->
            <div class="space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-900">Available Pharmacies</h2>
                    <span class="text-sm text-gray-500">
                      {{ count($pharmacies) }} pharmacies found
                    </span>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($pharmacies as $pharmacy)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all hover:shadow-lg">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-medium text-gray-900">{{$pharmacy['name']}}</h3>
                                        <p class="text-sm text-gray-500 mt-1">{{$pharmacy['address']}}</p>
                                        <p class="text-sm font-medium text-dashboardPrimary-600 mt-1">{{$pharmacy['city']}}</p>
                                    </div>
                                </div>
                                <div class="mt-4 border-t border-gray-100 pt-4">
                                    <button
                                        onclick="toggleSchedule({{ $pharmacy->id }})"
                                        id="toggleButton{{ $pharmacy->id }}"
                                        class="text-dashboardPrimary-600 hover:text-dashboardPrimary-700 text-sm font-medium focus:outline-none">
                                        View Schedule
                                        <span class="ml-1">↓</span>
                                    </button>
                                    <div id="schedule{{ $pharmacy->id }}" class="mt-4 grid grid-cols-1 gap-2" style="display: none;">
                                        @foreach($pharmacy->workingSchedules as $workingSchedule)
                                            <div class="flex justify-between items-center py-2">
                                                <span class="capitalize text-gray-700">{{ $workingSchedule['day'] }}</span>
                                                <span class="text-gray-900">
                                                    {{ \Carbon\Carbon::parse($workingSchedule['open_time']) }} - {{ \Carbon\Carbon::parse($workingSchedule['close_time']) }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script>
        function toggleSchedule(pharmacyId) {
            // Get the schedule container and button
            const scheduleContainer = document.getElementById(`schedule${pharmacyId}`);
            const toggleButton = document.getElementById(`toggleButton${pharmacyId}`);

            // Toggle visibility
            if (scheduleContainer.style.display === "none" || !scheduleContainer.style.display) {
                scheduleContainer.style.display = "grid"; // Show the schedule
                toggleButton.innerHTML = 'Hide Schedule <span class="ml-1">↑</span>';
            } else {
                scheduleContainer.style.display = "none"; // Hide the schedule
                toggleButton.innerHTML = 'View Schedule <span class="ml-1">↓</span>';
            }
        }
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
