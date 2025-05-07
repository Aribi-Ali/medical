@extends('dashboard')
@section("content")
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form id="availabilityForm" method="POST" action="{{ route('availability.store') }}">
        @csrf
        <div class="px-4 py-6 sm:px-0">
            <div class="grid justify-first">
                <!-- Appointment Duration Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Appointment Duration</h2>
                    <div class="flex items-center space-x-4">
                        <input
                            id="appointmentDuration"
                            name="slotDuration"
                            type="number"
                            class="w-24 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-dashboardPrimary-500 focus:border-dashboardPrimary-500"
                            min="10"
                            max="60"
                            step="5"
                            value="30"
                            placeholder="30"
                        />
                        <span class="text-gray-500">minutes per session</span>
                    </div>
                </div>
            </div>
            <!-- Weekly Schedule Card -->
            <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Weekly Schedule</h2>
                </div>
                <div class="divide-y divide-gray-200" id="timeSlotsContainer">

                </div>
            </div>
            <!-- Save Changes Button -->
            <div class="mt-6 flex justify-end">
                <button class="px-6 py-3 bg-dashboardPrimary-600 text-white rounded-md hover:bg-dashboardPrimary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dashboardPrimary-500 transition-colors">
                    Create
                </button>
            </div>
        </div>
    </form>
        </div>
    </div>

    <script>
        // Mock data for demonstration
        const initialTimeSlots = [
            // SUNDAY,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY
            { id: 1, day: 'Sunday', startTime: '09:00', endTime: '17:00', isAvailable: true },
            { id: 2, day: 'Monday', startTime: '09:00', endTime: '17:00', isAvailable: true },
            { id: 3, day: 'Tuesday', startTime: '09:00', endTime: '17:00', isAvailable: true },
            { id: 4, day: 'Wednesday', startTime: '09:00', endTime: '17:00', isAvailable: true },
            { id: 5, day: 'Thursday', startTime: '09:00', endTime: '17:00', isAvailable: true },
            { id: 6, day: 'Friday', startTime: '09:00', endTime: '17:00', isAvailable: true },
            { id: 7, day: 'Saturday', startTime: '09:00', endTime: '17:00', isAvailable: true },
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
                            value="${slot.startTime}"
                            onchange="handleTimeChange(${slot.id}, 'startTime', this.value)"
                            class="px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            ${!slot.isAvailable ? 'disabled' : ''}
                            name="timeSlots[${slot.id}][startTime]"
                        />
                        <span class="text-gray-500">to</span>
                        <input
                            type="time"
                            value="${slot.endTime}"
                            onchange="handleTimeChange(${slot.id}, 'endTime', this.value)"
                            class="px-2 py-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            ${!slot.isAvailable ? 'disabled' : ''}
                            name="timeSlots[${slot.id}][endTime]"
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

                    <!-- Ensure dayOfWeek is explicitly included -->
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

        // Intercept form submission
        document.getElementById('availabilityForm').addEventListener('submit', function (e) {
            // Log the form data to the console for verification
            const formData = new FormData(this);
            timeSlots.forEach(slot => {
                if (slot.isAvailable) { // Only include available slots
                    formData.append(`timeSlots[${slot.id}][dayOfWeek]`, slot.day.toUpperCase());
                    formData.append(`timeSlots[${slot.id}][startTime]`, slot.startTime);
                    formData.append(`timeSlots[${slot.id}][endTime]`, slot.endTime);
                }
            });
            // Submit the form manually
            fetch(this.action, {
                method: this.method,
                body: formData
            }).then(response => response.json())
                .then(data => console.log('Server Response:', data))
                .catch(error => console.error('Error:', error));

            // Submit the form programmatically
            //this.submit();
        });

        // Ensure the DOM is fully loaded before adding event listeners
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('appointmentDuration').addEventListener('input', function (e) {
                appointmentDuration = parseInt(e.target.value);
            });

            // Initial render
            renderTimeSlots();
        });
    </script>
@endsection
