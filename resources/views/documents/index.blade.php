@extends('layouts.patient-layout')
@section('content')
    @include('components.patient.navbar')
    <section class="w-full min-h-screen py-8 mt-16 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="mb-6 text-3xl font-bold text-gray-800">📁 My Documents</h2>
            <!-- Buttons Section -->
            <div class="flex mb-6 space-x-4">
                <a href="{{ route('documents.index') }}"
                    class="flex items-center px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                    📄 My Documents
                </a>
                <a href="{{ route('documents.sent') }}"
                    class="flex items-center px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">
                    ✉️ Sent
                </a>
                <a href="{{ route('documents.recived') }}"
                    class="flex items-center px-4 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
                    📥 Received
                </a>
                <a href="{{ route('documents.saved') }}"
                    class="flex items-center px-4 py-2 text-white bg-purple-500 rounded-lg hover:bg-purple-600">
                    💾 Saved
                </a>
                <a href="{{ route('documents.share') }}"
                    class="flex items-center px-4 py-2 text-white bg-purple-500 rounded-lg hover:bg-purple-600">
                    💾 send
                </a>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 text-left">👤 Sender</th>
                            <th class="p-3 text-left">📝 Name</th>
                            <th class="p-3 text-left">📌 Files</th>

                            <th class="p-3 text-left">📅 Date</th>
                            <th class="p-3 text-left">🔗 Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($documents->isEmpty())
                            <tr>
                                <td class="p-3 text-center" colspan="4">No documents found.</td>
                            </tr>
                        @else
                            @foreach ($documents as $document)
                                <tr class="border-b">
                                    <td class="p-3">
                                        @if ($document->sender->email === auth()->user()->email)
                                            <a href="{{ route('documents.sender', $document->sender->id) }}">
                                                {{ $document->sender->name }} ({{ $document->sender->email }})
                                            </a>
                                        @else
                                            You
                                        @endif
                                    </td>
                                    <td class="p-3">{{ $document->name }} </td>
                                    <td class="p-3">
                                        <ul class="pl-5 space-y-1 list-disc">
                                            @foreach ($document->files as $file)
                                                <li>
                                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                                        class="text-blue-500 hover:underline">
                                                        {{ basename($file->file_name) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="p-3">{{ $document->created_at->format('d M Y') }}</td>
                                    <td class="p-3">
                                        <form action="{{ route('documents.save-document', $document->id) }} "
                                            method="POST">
                                            @csrf
                                            <button class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">
                                                @if ($document->is_saved)
                                                    📁 Saved
                                                @else
                                                    💾 Save
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
