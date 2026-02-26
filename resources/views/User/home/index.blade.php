@extends('User.layouts.main')

@section('container')
    @auth
        <div class="min-h-screen  flex items-start justify-center pt-20">
            <div class="w-full max-w-3xl px-4">
                <div class="rounded-lg bg-green-100 p-6 shadow">
                    <h4 class="text-xl font-semibold text-green-800">
                        Halo, {{ auth()->user()->name }} 👋
                    </h4>
                    <p class="mt-2 text-green-700">
                        Selamat datang di dashboard.
                    </p>
                </div>
            </div>
        </div>
    @endauth
@endsection
