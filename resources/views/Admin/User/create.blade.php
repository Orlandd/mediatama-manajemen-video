@extends('Admin.Layouts.main')

@section('container-admin')
    <div class="min-h-screen sm:ml-64 p-6">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">
                Tambah User
            </h1>

            <div class="bg-white shadow rounded-lg p-6">
                <form action="/admin/user" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukkan nama lengkap" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukkan email" required>
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <input type="password" name="password" id="password"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Masukkan password" required>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                            Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Konfirmasi password" required>
                    </div>

                    {{-- Role --}}
                    <div class="mb-6">
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                            Role
                        </label>
                        <select name="role" id="role"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="" disabled selected>Pilih role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                        </select>
                    </div>

                    {{-- Button --}}
                    <div class="flex justify-end gap-3">
                        <a href="/admin/users" class="px-6 py-2 rounded-lg bg-gray-300 text-gray-800 hover:bg-gray-400">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-400">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
