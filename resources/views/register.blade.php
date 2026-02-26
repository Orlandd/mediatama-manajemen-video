<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-center mb-6">Register</h2>

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-100 p-3 text-sm text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" required
                    class="mt-1 w-full rounded border border-gray-300 px-3 py-2 focus:border-green-500 focus:outline-none focus:ring-1 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required
                    class="mt-1 w-full rounded border border-gray-300 px-3 py-2 focus:border-green-500 focus:outline-none focus:ring-1 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="mt-1 w-full rounded border border-gray-300 px-3 py-2 focus:border-green-500 focus:outline-none focus:ring-1 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="mt-1 w-full rounded border border-gray-300 px-3 py-2 focus:border-green-500 focus:outline-none focus:ring-1 focus:ring-green-500">
            </div>

            <button type="submit"
                class="w-full rounded bg-green-600 py-2 text-white font-semibold hover:bg-green-700 transition">
                Register
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-green-600 hover:underline">Login</a>
        </p>
    </div>

</body>

</html>
