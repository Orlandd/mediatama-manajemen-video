@extends('Admin.Layouts.main')

@section('container-admin')
    <div class="min-h-screen sm:ml-64 p-6">
        <div class="mx-auto max-w-6xl">
            <h1 class="text-2xl font-semibold text-gray-800">
                Daftar User
            </h1>
            <br>
            <a href="/admin/user/create" class="px-6 py-2 rounded-lg bg-blue-600 mt-10 text-white hover:bg-blue-400">Tambah
                User</a>
            <br>
            <div class="mt-4 overflow-x-auto rounded-lg bg-white shadow">
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">No</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Name</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Email</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 py-3">
                                    <a href="/admin/user/{{ $user->id }}/edit"
                                        class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-400">Edit</a>
                                    <form action="/admin/user/{{ $user->id }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
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
                    Belum ada data user.
                </p>
            @endif
        </div>
    </div>
@endsection
