@extends('Admin.Layouts.main')

@section('container-admin')
    <div class="min-h-screen sm:ml-64 p-6">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">
                Edit Video
            </h1>

            <div class="bg-white shadow rounded-lg p-6">
                <form action="/admin/video/{{ $video->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Method PUT untuk update --}}

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Video
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $video->title) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukkan judul video" required>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukkan deskripsi video" required>{{ old('deskripsi', $video->description) }}</textarea>
                    </div>

                    {{-- Upload Video --}}
                    <div class="mb-6">
                        <label for="video_file" class="block text-sm font-medium text-gray-700 mb-1">
                            Upload Video (Opsional: biarkan kosong jika tidak ingin mengganti)
                        </label>
                        <input type="file" name="video_file" id="video_file" accept="video/*"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        @if ($video->video_url)
                            <p class="mt-2 text-sm text-gray-500">
                                Video saat ini: <a href="{{ $video->video_url }}" target="_blank"
                                    class="text-blue-600 underline">Lihat Video</a>
                            </p>
                        @endif
                    </div>

                    {{-- Button --}}
                    <div class="flex justify-end gap-3">
                        <a href="/admin" class="px-6 py-2 rounded-lg bg-gray-300 text-gray-800 hover:bg-gray-400">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-400">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
