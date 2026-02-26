@extends('Admin.Layouts.main')

@section('container-admin')
    <div class="min-h-screen sm:ml-64 p-6">
        <div class="mx-auto max-w-6xl">
            <h1 class="text-2xl font-semibold text-gray-800">
                Daftar Video
            </h1>
            <br>
            <a href="/admin/video/create" class="px-6 py-2 rounded-lg bg-blue-600 mt-10 text-white hover:bg-blue-400">Tambah
                Video</a>
            <br>
            <div class="mt-4 overflow-x-auto rounded-lg bg-white shadow">
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">No</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Judul</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Deskripsi</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Video</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data as $video)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3 text-gray-800">
                                    {{ $video->title }}
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $video->description }}
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('video.watch', $video->id) }}"
                                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-400">
                                        Lihat
                                    </a>
                                </td>
                                <td class="px-4 py-3 flex gap-2">
                                    <a href="/admin/video/{{ $video->id }}/edit"
                                        class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-400">Edit</a>
                                    <form action="/admin/video/{{ $video->id }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?')"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-500 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($data->isEmpty())
                <p class="mt-4 text-center text-gray-500">
                    Belum ada data video.
                </p>
            @endif
        </div>
    </div>
@endsection
