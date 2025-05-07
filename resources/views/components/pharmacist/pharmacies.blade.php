@extends('dashboard')
@section("content")
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-900">Pharmacies</h1>
        <p class="mt-2 text-sm text-gray-600">View and manage your pharmacies</p>
    </div>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Working Days List -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Your Pharmacies</h2>
                    <button class="px-4 py-2 bg-dashboardPrimary-600 text-white rounded-md hover:bg-dashboardPrimary-700 transition-colors">
                        <a href="{{ route('pharmacies.create') }}">Add New Pharmacy</a>
                    </button>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach ($pharmacies as $pharmacy)
                        <a href="{{ route('pharmacies.show', $pharmacy['id']) }}">
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-8">
                                        <div class="w-32">
                                            <span class="text-lg font-medium text-gray-900">{{ $pharmacy['name'] }}</span>
                                        </div>
                                        <div>
                                            <span class="text-lg font-medium text-gray-900">{{ $pharmacy['city'] }}, {{ $pharmacy['address'] }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <form action="{{ route('working-day.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this day?');" >
                                            @csrf
                                            <input type="hidden" name="dayOfWeek" value={{ $pharmacy['name'] }} />
                                            <button
                                                type="submit"
                                                class="group relative px-4 py-2 bg-red-50 text-red-700 rounded-md hover:bg-red-100 transition-colors"
                                            >
                                        <span class="hidden group-hover:block absolute -top-10 left-1/2 transform -translate-x-1/2 px-2 py-1 bg-gray-800 text-white text-sm rounded">
                                          Delete day
                                       </span>
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
