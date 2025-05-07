@extends('dashboard')
@section("content")
    @if(session('success'))
        @include('components.patient.notification', [
            'message' => session('success')
        ])
    @endif
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-900">Appointment Schedule</h1>
        <p class="mt-2 text-sm text-gray-600">Your upcoming and completed patient appointments</p>
    </div>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Working Days List -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <form action="{{ route("availability-schedules.reset") }}" method="POST" class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    @csrf
                    @method("PATCH")
                    <h2 class="text-lg font-semibold text-gray-900">Appointment Schedule</h2>
                    <button type="submit" class="px-4 py-2 bg-dashboardPrimary-600 text-white rounded-md hover:bg-dashboardPrimary-700 transition-colors">
                        Reset all
                    </button>
                </form>
                <div class="divide-y divide-gray-200">
                    @foreach($allSchedules as $schedule)
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between space-x-8">
                                    <div class="w-32">
                                        <span class="text-lg font-medium text-gray-900">{{ $schedule['day_of_week'] }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="px-3 py-1 bg-dashboardPrimary-50 text-dashboardPrimary-700 rounded-md">
                                            {{ \Carbon\Carbon::parse($schedule['start_time'])->format('H:i') }}
                                        </div>
                                        <span class="text-gray-500">to</span>
                                        <div class="px-3 py-1 bg-dashboardPrimary-50 text-dashboardPrimary-700 rounded-md">
                                            {{ \Carbon\Carbon::parse($schedule['end_time'])->format('H:i') }}
                                        </div>
                                    </div>
                                    <div @class([
                                        'px-4 py-2 rounded-md transition-colors',
                                        'bg-green-100 text-green-800 hover:bg-green-200' => $schedule['is_available'],
                                        'bg-red-100 text-red-800 hover:bg-red-200' => !$schedule['is_available']
                                    ])>
                                        {{ $schedule['is_available'] ? 'Available' : 'Booked' }}
                                    </div>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
