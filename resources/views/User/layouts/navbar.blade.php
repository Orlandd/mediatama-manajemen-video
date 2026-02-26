<nav class="bg-neutral-primary fixed w-full z-20 top-0 start-0 border-b border-default">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-7" alt="Flowbite Logo" />
            <span class="self-center text-xl text-heading font-semibold whitespace-nowrap">Flowbite</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-base md:hidden hover:bg-neutral-secondary-soft hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-tertiary"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium items-center flex flex-col p-4 md:p-0 mt-4 border border-default rounded-base bg-neutral-secondary-soft md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-neutral-primary">
                <li>
                    <a href="/"
                        class="block py-2 px-3 text-white bg-brand rounded md:bg-transparent md:text-fg-brand md:p-0"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="/video"
                        class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Video</a>
                </li>
                <li>
                    <a href="/history"
                        class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">History</a>
                </li>
                <li>
                    <div class="flex items-center space-x-4">
                        @auth
                            <!-- Jika sudah login -->
                            <span class="text-heading font-medium">
                                Halo, {{ auth()->user()->name }} 👋
                            </span>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 text-sm rounded-base bg-red-500 text-white hover:bg-red-600">
                                    Logout
                                </button>
                            </form>
                        @else
                            <!-- Jika belum login -->
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 text-sm rounded-base border-2 border-blue-200 text-heading hover:bg-neutral-tertiary">
                                Login
                            </a>

                            <a href="{{ route('register') }}"
                                class="px-4 py-2 text-sm rounded-base bg-brand text-white hover:bg-brand/90">
                                Register
                            </a>
                        @endauth
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
