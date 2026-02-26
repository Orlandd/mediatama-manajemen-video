@extends('Admin.Layouts.main')

@section('container-admin')
    <div class="max-w-4xl mx-auto mt-10">
        <div class="relative" style="padding-top: 56.25%;">
            <video class="absolute top-0 left-0 w-full h-full" controls>
                <source src="{{ url('video/stream/' . basename($video->url)) }}" type="video/mp4">
                Browser Anda tidak mendukung video.
            </video>
        </div>

        <h1 class="text-2xl font-semibold mb-2 mt-4">{{ $video->title }}</h1>
        <p class="mb-4 text-gray-600">{{ $video->description }}</p>


    </div>
@endsection
