@extends('User.Layouts.main')

@section('container')
    <div class="min-h-screen mt-10 p-6">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">
                Request Akses Video
            </h1>

            <div class="bg-white shadow rounded-lg p-6">
                <form action="/video/{{ $video['id'] }}/request" method="POST">
                    @csrf

                    {{-- ID Video (WAJIB) --}}
                    <input type="hidden" name="video_id" value="{{ $video['id'] }}">

                    {{-- Judul (readonly) --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Video
                        </label>
                        <input type="text" value="{{ $video['title'] }}"
                            class="w-full rounded-lg bg-gray-100 border-gray-300 cursor-not-allowed" readonly>
                    </div>

                    {{-- Deskripsi (readonly) --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi
                        </label>
                        <textarea rows="4" class="w-full rounded-lg bg-gray-100 border-gray-300 cursor-not-allowed" readonly>{{ $video['description'] }}</textarea>
                    </div>

                    {{-- Start Access --}}
                    <div class="mb-4">
                        <label for="start" class="block text-sm font-medium text-gray-700 mb-1">
                            Start Access
                        </label>
                        <input type="datetime-local" name="start" id="start"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    {{-- End Access --}}
                    <div class="mb-6">
                        <label for="end" class="block text-sm font-medium text-gray-700 mb-1">
                            End Access
                        </label>
                        <input type="datetime-local" name="end" id="end"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    {{-- Button --}}
                    <div class="flex justify-end gap-3">
                        <a href="/user/video" class="px-6 py-2 rounded-lg bg-gray-300 text-gray-800 hover:bg-gray-400">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-500">
                            Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
