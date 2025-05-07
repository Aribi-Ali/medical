@extends('dashboard')
@section("content")
    <div class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-900">User Management</h1>
                <p class="mt-2 text-gray-600">Manage user accounts, roles, and status</p>
            </div>
            <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
                <form action="{{ route("users.index") }}" method="get">
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label htmlFor="search" class="block text-sm font-medium text-gray-700">
                                Search Users
                            </label>
                            <div class="relative">
                                <input
                                    type="text"
                                    id="search"
                                    name="email"
                                    value="{{ request('email') }}"
                                    class="w-full px-4 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Search by email"
                                />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    🔍
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button
                                type="submit"
                                class="px-6 py-2 bg-dashboardPrimary-600 text-white rounded-md hover:bg-dashboardPrimary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-dashboardPrimary-500 focus:ring-offset-2"
                            >
                                Search Users
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="min-w-full divide-y divide-gray-200">
                    <div class="bg-gray-50">
                        <div class="grid grid-cols-6 w-full gap-4 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="col-span-2">User</div>
                            <div>Role</div>
                            <div>Status</div>
                            <div>Actions</div>
                        </div>
                    </div>
                    <div class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                            <div class="grid grid-cols-6 gap-4 px-6 py-4 hover:bg-gray-50">
                                <div class="col-span-2">
                                    <div class="text-sm font-medium text-gray-900">{{ $user['name'] }}</div>
                                    <div class="text-sm text-gray-500">{{ $user['email'] }}</div>
                                </div>
                                <form action="{{ route('admin.updateRole', $user['id']) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex items-center gap-1 text-sm text-gray-900">
                                        <select
                                            name="role"
                                            class="px-2 w-40 py-1 border border-gray-300 rounded-md text-sm focus:ring-dashboardPrimary-500 focus:border-dashboardPrimary-500"
                                        >
                                            <option value="patient" {{ $user['role'] === 'patient' ? 'selected' : '' }}>Patient</option>
                                            <option value="doctor" {{ $user['role'] === 'doctor' ? 'selected' : '' }}>Doctor</option>
                                            <option value="pharmacist" {{ $user['role'] === 'pharmacist' ? 'selected' : '' }}>Pharmacist</option>
                                            <option value="admin" {{ $user['role'] === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <button
                                            type="submit"
                                            class="px-2 py-1 bg-dashboardPrimary-600 text-white rounded-md hover:bg-dashboardPrimary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-dashboardPrimary-500 focus:ring-offset-2"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </form>
                                <div>
                                    <span @class([
                                        'px-3 py-1 rounded-md text-sm font-medium',
                                        'bg-red-50 text-red-700 hover:bg-red-100' => $user['status'] !== 'active',
                                        'bg-green-50 text-green-700 hover:bg-green-100' => $user['status'] === 'active'
                                    ])>
                                        {{ $user['status'] }}
                                    </span>
                                </div>
                                <div>
                                    <form action="{{ route('admin.toggleStatus', $user['id']) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button @class([
                                            'px-3 py-1 rounded-md text-sm font-medium',
                                            'bg-red-50 text-red-700 hover:bg-red-100' => $user['status'] === 'active',
                                            'bg-green-50 text-green-700 hover:bg-green-100' => $user['status'] !== 'active'
                                        ])>
                                            {{ $user['status'] === 'active' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
