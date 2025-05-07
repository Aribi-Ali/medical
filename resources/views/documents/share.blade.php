@extends("layouts.patient-layout")
@section("content")
    @include("components.patient.navbar")
    <section class="w-full min-h-screen py-8 mt-16 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="mb-6 text-3xl font-bold text-gray-800">📤 Share a Document</h2>
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
            <form action="{{ route('documents.share') }}" method="POST" enctype="multipart/form-data"
                class="p-6 bg-white rounded-lg shadow-md">
                @csrf

                <label class="block mb-4">
                    <span class="font-semibold text-gray-700">Recipient Email</span>
                    <input type="email" name="receiver_email"
                        class="w-full p-2 mt-1 border rounded-lg @error('receiver_email') border-red-500 @enderror"
                        value="{{ old('receiver_email') }}" required>
                    @error('receiver_email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </label>

                <label class="block mb-4">
                    <span class="font-semibold text-gray-700">File Name</span>
                    <input type="text" name="name"
                        class="w-full p-2 mt-1 border rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </label>

                <label class="block mb-4">
                    <span class="font-semibold text-gray-700">Upload File</span>
                    <input type="file" name="files[]"
                        class="w-full p-2 mt-1 border rounded-lg @error('files') border-red-500 @enderror" multiple
                        required>
                    @error('files')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </label>

                <label class="block mb-4">
                    <span class="font-semibold text-gray-700">Description (optional)</span>
                    <textarea name="description" class="w-full p-2 mt-1 border rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </label>

                <button type="submit" class="px-4 py-2 text-white transition bg-blue-500 rounded-lg hover:bg-blue-600">
                    📨 Share Document
                </button>
            </form>
        </div>
    </section>
@endsection
