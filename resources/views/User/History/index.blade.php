@extends('User.Layouts.main')

@section('container')
    <div class="min-h-screen mt-10 p-6">
        <div class="mx-auto max-w-6xl">
            <h1 class="text-2xl font-semibold text-gray-800">
                Daftar Video
            </h1>

            <div class="mt-4 overflow-x-auto rounded-lg bg-white shadow">
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">No</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Judul</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Deskripsi</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Video</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Start</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">End</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data as $video)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $video['title'] ?? 'Tidak ada judul' }}
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $video['description'] ?? 'Tidak ada deskripsi' }}
                                </td>
                                <td class="px-4 py-3  text-gray-600">
                                    <a href="{{ route('video.watch', $video['video_id']) }}"
                                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-400">
                                        Watch
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    @if ($video['status'] === 'approved')
                                        {{ $video['start'] ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    @if ($video['status'] === 'approved')
                                        {{ $video['end'] ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3  text-gray-600">
                                    <div
                                        class="px-2 py-1 text-xs font-medium text-center {{ $video['status'] == 'approved' ? 'bg-green-100 text-green-800' : ($video['status'] == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }} rounded-full">
                                        {{ $video['status'] }}
                                    </div>
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
