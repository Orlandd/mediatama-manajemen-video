@extends('Admin.Layouts.main')

@section('container-admin')
    <div class="min-h-screen sm:ml-64 p-6">
        <div class="mx-auto max-w-6xl">
            <h1 class="text-2xl font-semibold text-gray-800">
                Daftar Request Access Video
            </h1>
            <div class="mt-4 overflow-x-auto rounded-lg bg-white shadow">
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">No</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">User Name</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">User Email</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Judul</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Deskripsi</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-700">Video</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-700">Start</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-700">End</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-700">Status</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data as $userRequest)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3  text-gray-800">
                                    {{ $userRequest->user->name }}
                                </td>
                                <td class="px-4 py-3  text-gray-800">
                                    {{ $userRequest->user->email }}
                                </td>
                                <td class="px-4 py-3  text-gray-800">
                                    {{ $userRequest->video->title }}
                                </td>
                                <td class="px-4 py-3  text-gray-800">
                                    {{ $userRequest->video->description }}
                                </td>
                                <td class="px-4 py-3  text-gray-800">
                                    <a href="{{ route('video.watch', $userRequest->video->id) }}"
                                        class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-400">
                                        Lihat
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-center  text-gray-800">
                                    {{ $userRequest->access_start }}
                                </td>
                                <td class="px-4 py-3 text-center text-gray-800">
                                    {{ $userRequest->access_end }}
                                </td>
                                <td class="px-4 py-3">
                                    <div
                                        class="px-2 py-1 text-xs font-medium text-center {{ $userRequest->status == 'approved' ? 'bg-green-100 text-green-800' : ($userRequest->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }} rounded-full">
                                        {{ $userRequest->status }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="/admin/video-request/{{ $userRequest->id }}/edit"
                                        class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-400">Update</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($data->isEmpty())
                <p class="mt-4 text-center text-gray-500">
                    Belum ada data
                </p>
            @endif
        </div>
    </div>
@endsection
