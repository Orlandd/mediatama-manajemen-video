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
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data as $video)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $video['title'] }}
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $video['description'] }}
                                </td>
                                <td class="px-4 py-3  text-gray-600">
                                    @if ($video['request_status'] == 'expired' || $video['request_status'] == null || $video['request_status'] == 'rejected')
                                        <button type="button" onclick="sendRequest({{ $video['id'] }})"
                                            class="px-4 py-2 rounded-full border-2 border-blue-600 hover:bg-blue-400 transition">
                                            Request
                                        </button>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                            {{ $video['request_status'] }}
                                        </span>
                                    @endif

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

<script>
    function sendRequest(videoId) {
        fetch(`/video/${videoId}/request`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                alert('Request berhasil!');
                location.reload();
            })
            .catch(err => {
                alert('Gagal request.');
            });
    }
</script>
