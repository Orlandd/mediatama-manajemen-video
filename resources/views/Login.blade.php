<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-100 p-3 text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required
                    class="mt-1 w-full rounded border border-gray-300 px-3 py-2
                           focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="mt-1 w-full rounded border border-gray-300 px-3 py-2
                           focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full rounded bg-blue-600 py-2 text-white font-semibold
                       hover:bg-blue-700 transition">
                Login
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                Register
            </a>
        </p>
    </div>

</body>

</html>
