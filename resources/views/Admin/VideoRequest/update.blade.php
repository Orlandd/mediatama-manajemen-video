@extends('Admin.Layouts.main')

@section('container-admin')
    <div class="min-h-screen sm:ml-64 p-6">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">
                Request Access Video
            </h1>

            <div class="bg-white shadow rounded-lg p-6">
                <form action="/admin/video-request/{{ $videoRequest->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- ID Video --}}
                    <input type="hidden" name="video_id" value="{{ $videoRequest->video->id }}">

                    {{-- Nama User --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama User
                        </label>
                        <input type="text" value="{{ $videoRequest->user->name }}"
                            class="w-full rounded-lg bg-gray-100 border-gray-300 cursor-not-allowed" readonly>
                    </div>

                    {{-- Judul Video --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Video
                        </label>
                        <input type="text" value="{{ $videoRequest->video->title }}"
                            class="w-full rounded-lg bg-gray-100 border-gray-300 cursor-not-allowed" readonly>
                    </div>

                    {{-- Deskripsi Video --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi
                        </label>
                        <textarea rows="4" class="w-full rounded-lg bg-gray-100 border-gray-300 cursor-not-allowed" readonly>{{ $videoRequest->video->description }}</textarea>
                    </div>

                    {{-- Status Request --}}
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>
                        <select name="status" id="status"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="pending"
                                {{ old('status', $videoRequest->status) == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="approved"
                                {{ old('status', $videoRequest->status) == 'approved' ? 'selected' : '' }}>
                                Approved
                            </option>
                            <option value="rejected"
                                {{ old('status', $videoRequest->status) == 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>
                        </select>
                    </div>

                    {{-- Start Access --}}
                    <div class="mb-4">
                        <label for="start" class="block text-sm font-medium text-gray-700 mb-1">
                            Start Access
                        </label>
                        <input type="datetime-local" name="start" id="start"
                            value="{{ old('start', $videoRequest->start) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- End Access --}}
                    <div class="mb-6">
                        <label for="end" class="block text-sm font-medium text-gray-700 mb-1">
                            End Access
                        </label>
                        <input type="datetime-local" name="end" id="end"
                            value="{{ old('end', $videoRequest->end) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
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
