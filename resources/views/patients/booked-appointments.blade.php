@extends("layouts.patient-layout")
@section("content")
    @include("components.patient.navbar")
    @if(session('success'))
        @include('components.patient.notification', [
            'message' => session('success')
        ])
    @endif
    <div class="w-full bg-gray-50 py-8 mt-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">My Appointments</h2>
                <h4 class="mt-1 text-sm text-gray-600">View and manage your pharmacy appointments</h4>
            </div>
            {{--Upcoming Appointments--}}
            <div class="mb-12">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Upcoming Appointments</h3>
                @if($appointments->isEmpty())
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 text-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-12 w-12 mx-auto text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width={1}
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No upcoming appointments</h3>
                        <p class="mt-1 text-sm text-gray-500">You don't have any scheduled appointments at the moment.</p>
                        <a href="{{ route("doctors.search") }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-dashboardPrimary-600 hover:bg-dashboardPrimary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Book New Appointment
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($appointments as $appointment)
                            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between">
                                        <div class="flex-1">
                                            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                <div class="flex items-center">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 text-gray-400 mr-2"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width={2}
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                        />
                                                    </svg>
                                                    <span class="text-sm text-gray-700">{{ $appointment['schedule']['day'] }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 text-gray-400 mr-2"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width={2}
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                        />
                                                    </svg>
                                                    <span class="text-sm text-gray-700">{{ $appointment['schedule']['start_time'] }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 text-gray-400 mr-2"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width={2}
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        />
                                                    </svg>
                                                    <span class="text-sm text-gray-700">{{ $appointment['doctorDetail']['name'] }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 text-gray-400 mr-2"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width={2}
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                        />
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width={2}
                                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                        />
                                                    </svg>
                                                    <span class="text-sm text-gray-700 truncate">{appointment.pharmacy.address}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 sm:mt-0 sm:ml-6 flex flex-col items-end">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                              Confirmed
                                            </span>
                                            <form action="{{ route('appointments.cancel', $appointment['id']) }}" method="POST" class="mt-4 flex space-x-3">
                                                @csrf
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 mr-2 text-gray-500"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width={2}
                                                            d="M6 18L18 6M6 6l12 12"
                                                        />
                                                    </svg>
                                                    Cancel
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
