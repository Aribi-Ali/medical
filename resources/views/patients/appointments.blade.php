@extends("layouts.patient-layout")
@section("content")
    @include("components.patient.navbar")
    <section class="w-full bg-gray-50 py-8 mt-16 min-h-screen">
        @if(session('success'))
            @include('components.patient.notification', [
                'message' => "Appointment booked successfully!"
            ])
        @endif
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Book Your Appointment</h1>
                <p class="text-lg text-gray-600">Choose your preferred doctor and time slot</p>
            </div>
            <!-- Search and Filter Section -->
            <form action="{{ route('doctors.search') }}" method="GET" class="mb-8 bg-white rounded-lg shadow-md p-6">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label htmlFor="search" class="block text-sm font-medium text-gray-700">
                            Search by Specialization or Name
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="query"
                                name="query"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-dashboardPrimary-500 focus:border-dashboardPrimary-500"
                                placeholder="e.g., Médecin Généraliste"
                                value="{{ request('query') }}"
                            />
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                🔍
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label htmlFor="city" class="block text-sm font-medium text-gray-700">
                            Filter by City
                        </label>
                        <select
                            id="city"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-dashboardPrimary-500 focus:border-dashboardPrimary-500"
                        >
                        <option value="">All Cities</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button
                        type="submit"
                        class="px-6 py-2 bg-dashboardPrimary-600 text-white rounded-md hover:bg-dashboardPrimary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-dashboardPrimary-500 focus:ring-offset-2"
                    >
                        Search Doctors
                    </button>
                </div>
            </form>
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Doctors List -->
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-900">Available Doctors</h2>
                        <span class="text-sm text-gray-500">
                            {{ count($doctors) }} doctors found
                        </span>
                    </div>
                    @if($doctors->isEmpty())
                        <div class="bg-white rounded-lg shadow-md p-8 text-center">
                            <div class="text-6xl mb-4">🔍</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Doctors Found</h3>
                            <p class="text-gray-500">
                                Try adjusting your search criteria or selecting a different city
                            </p>
                        </div>
                    @else
                        @foreach ($doctors as $doctor)
                            <div class="bg-white rounded-lg shadow-md p-6 cursor-pointer transition-all"
                                 data-doctor-id="{{ $doctor['id'] }}"
                                 onclick="selectDoctorCard(this, {{ $doctor['id'] }})"
                            >
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">{{$doctor['name']}}</h3>
                                        <p class="text-dashboardPrimary-600">{{$doctor['specialization']}}</p>
                                        <p class="text-sm text-gray-500 mt-1">{{$doctor['address']}}, {{$doctor['wilaya']}}</p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2 hover:line-clamp-none transition-all">
                                    {{$doctor['bio']}}
                                </p>
                            </div>
                        @endforeach
                    @endempty
                </div>
                <!--Time Slots -->
                <div id="scheduleModal">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Available Time Slots</h2>
                    <form action="{{ route('appointments.store') }}" method="POST"  class="bg-white rounded-lg shadow-md p-6">
                        @csrf
                        <input type="hidden" name="schedule_id" id="selectedScheduleId" value="">
                        <div id="scheduleList" class="grid grid-cols-2 gap-4">
                            <!-- Available schedule list -->
                        </div>
                        <div id="notSelected" class="bg-white rounded-lg shadow-md p-8 text-center">
                            <div class="text-6xl mb-4">👆</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                Select a Doctor First
                            </h3>
                            <p class="text-gray-500">
                                Choose your preferred doctor to see available time slots
                            </p>
                        </div>
                        <div id="confirmButton" class="mt-8 hidden">
                            <button type="submit" class="w-full py-3 px-4 bg-dashboardPrimary-600 text-white rounded-md hover:bg-dashboardPrimary-700 transition-colors">
                                Confirm Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Function to fetch schedules for a doctor
        function fetchSchedules(doctorId) {
            fetch(`/doctors/${doctorId}/available-schedules`)
                .then(response => response.json())
                .then(data => {
                    const notSelected = document.getElementById('notSelected');
                    notSelected.innerHTML = '';
                    // Display schedules in the modal
                    const scheduleList = document.getElementById('scheduleList');
                    scheduleList.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(schedule => {
                            const scheduleItem = document.createElement('button');
                            scheduleItem.type = 'button';
                            scheduleItem.className = "p-4 rounded-lg text-center transition-all bg-gray-50 text-gray-700 hover:bg-gray-100"
                            scheduleItem.innerHTML = `
                                <input type="hidden" name="schedule_id" value=${schedule.id}>
                                <div class="font-medium">
                                    ${schedule.day_of_week}
                                </div>
                                <div class="text-sm">${schedule.start_time}</div>
                        `;
                            // Add click event listener to the schedule card
                            scheduleItem.addEventListener('click', () => {
                                // Set the selected schedule ID in a hidden input field
                                document.getElementById('selectedScheduleId').value = schedule.id;

                                // Highlight the selected schedule card
                                const allCards = document.querySelectorAll('#scheduleList button');
                                allCards.forEach(card => card.classList.remove('bg-dashboardPrimary-100', 'text-dashboardPrimary-700', 'hover:bg-gray-100', 'ring-2'));
                                scheduleItem.classList.add('bg-dashboardPrimary-100', 'text-dashboardPrimary-700', 'ring-2', 'ring-dashboardPrimary-500');
                                // Show the Confirm Appointment button
                                document.getElementById('confirmButton').classList.remove('hidden');
                            });
                            scheduleList.appendChild(scheduleItem);
                        });
                    } else {
                        scheduleList.innerHTML = '<p class="text-gray-500">No available schedules.</p>';
                    }

                    // Show the modal
                    document.getElementById('scheduleModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching schedules:', error);
                });
        }

        // Function to handle doctor card selection
        function selectDoctorCard(card, doctorId) {
            // Remove the selected styles from all doctor cards
            const allDoctorCards = document.querySelectorAll('[data-doctor-id]');
            allDoctorCards.forEach(doctorCard => {
                doctorCard.classList.remove('ring-2', 'ring-dashboardPrimary-500', 'transform', 'scale-[1.02]');
            });

            // Add the selected styles to the clicked doctor card
            card.classList.add('ring-2', 'ring-dashboardPrimary-500', 'transform', 'scale-[1.02]');

            // Fetch schedules for the selected doctor
            fetchSchedules(doctorId);
        }
    </script>
@endsection
