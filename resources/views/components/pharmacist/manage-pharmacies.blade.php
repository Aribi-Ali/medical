@extends('dashboard')
@section("content")
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-900">Create Pharmacy</h1>
        <p class="mt-2 text-sm text-gray-600">Add a new pharmacy to the medical platform</p>
    </div>
    <form id="availabilityForm" method="POST" action="{{ route('pharmacies.store') }}" class=" p-6 text-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
        @csrf
        <div class="px-6 py-4 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Pharmacy Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-dashboardPrimary-500 focus:border-dashboardPrimary-500"
                        placeholder="Enter pharmacy name"
                        value="{{ request('name') }}"
                    />
                </div>
                <div class="space-y-2">
                    <label for="city" class="block text-sm font-medium text-gray-700">
                        City
                    </label>
                    <input
                        type="text"
                        id="city"
                        name="city"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-dashboardPrimary-500 focus:border-dashboardPrimary-500"
                        placeholder="e.g., Alger"
                        value="{{ request('city') }}"
                    />
                </div>
            </div>
            <div class="mt-6">
                <label for="address" class="block text-sm font-medium text-gray-700">
                    Address
                </label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-dashboardPrimary-500 focus:border-dashboardPrimary-500"
                    placeholder="Your business address"
                    value="{{ request('address') }}"
                />
            </div>
        </div>
        <div class="my-6">
            <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Weekly Schedule</h2>
                </div>
                <div class="divide-y divide-gray-200" id="timeSlotsContainer"></div>
            </div>
            <div class="mt-6 flex justify-end">
                <button class="px-6 py-3 bg-dashboardPrimary-600 text-white rounded-md hover:bg-dashboardPrimary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dashboardPrimary-500 transition-colors">
                    Create Pharmacy
                </button>
            </div>
        </div>
    </form>

    <script>
        const initialTimeSlots = [
            { id: 1, day: 'Monday', openTime: '09:00', closeTime: '17:00', isAvailable: true },
            { id: 2, day: 'Tuesday', openTime: '09:00', closeTime: '17:00', isAvailable: true },
            { id: 3, day: 'Wednesday', openTime: '09:00', closeTime: '17:00', isAvailable: true },
            { id: 4, day: 'Thursday', openTime: '09:00', closeTime: '17:00', isAvailable: true },
            { id: 5, day: 'Friday', openTime: '09:00', closeTime: '17:00', isAvailable: true },
        ];

        let timeSlots = [...initialTimeSlots];
        let appointmentDuration = 30;

        function renderTimeSlots() {
            const container = document.getElementById('timeSlotsContainer');
            container.innerHTML = timeSlots.map(slot => `
                <div class="p-6 transition-colors ${slot.isAvailable ? 'bg-white' : 'bg-gray-50'}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-28">
                                <span class="font-medium text-gray-900">${slot.day}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input
                                    type="time"
                                    value="${slot.openTime}"
                                    onchange="handleTimeChange(${slot.id}, 'openTime', this.value)"
                                    class="px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    ${!slot.isAvailable ? 'disabled' : ''}
                                    name="timeSlots[${slot.id}][openTime]"
                                />
                                <span class="text-gray-500">to</span>
                                <input
                                    type="time"
                                    value="${slot.closeTime}"
                                    onchange="handleTimeChange(${slot.id}, 'closeTime', this.value)"
                                    class="px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    ${!slot.isAvailable ? 'disabled' : ''}
                                    name="timeSlots[${slot.id}][closeTime]"
                                />
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button
                                type="button"
                                onclick="handleAvailabilityToggle(${slot.id})"
                                class="px-4 py-2 rounded-md transition-colors ${slot.isAvailable ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200'}"
                            >
                                ${slot.isAvailable ? 'Available' : 'Unavailable'}
                            </button>
                            ${slot.isAvailable ? `<input type="hidden" name="timeSlots[${slot.id}][dayOfWeek]" value="${slot.day.toUpperCase()}" />` : ''}
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function handleAvailabilityToggle(dayId) {
            timeSlots = timeSlots.map(slot =>
                slot.id === dayId ? { ...slot, isAvailable: !slot.isAvailable } : slot
            );
            renderTimeSlots();
        }

        function handleTimeChange(dayId, field, value) {
            timeSlots = timeSlots.map(slot =>
                slot.id === dayId ? { ...slot, [field]: value } : slot
            );
        }

        document.getElementById('availabilityForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            timeSlots.forEach(slot => {
                if (slot.isAvailable) {
                    formData.append(`timeSlots[${slot.id}][dayOfWeek]`, slot.day.toUpperCase());
                    formData.append(`timeSlots[${slot.id}][openTime]`, slot.openTime);
                    formData.append(`timeSlots[${slot.id}][closeTime]`, slot.closeTime);
                }
            });
            this.submit();
        });

        document.addEventListener('DOMContentLoaded', function () {
            renderTimeSlots();
        });
    </script>
@endsection
