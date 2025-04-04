<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clouds Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles()
</head>

<body
    class="bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100 min-h-screen flex flex-col w-screen overflow-x-hidden">
    <!-- Header -->
    <livewire:page-header />

    <!-- Main Content Area -->
    <main class="">
        <!-- Success Message -->
        @if (session('success'))
        <div
            class="bg-emerald/10 dark:bg-emerald/20 border-l-4 border-emerald text-emerald-800 dark:text-emerald-200 px-4 py-3 rounded-lg shadow-md font-semibold max-w-screen-xl mx-auto">
            {{ session('success') }}
        </div>
        @endif

        <!-- Page Content -->
        <div class="bg-white dark:bg-secondary-100 rounded-lg shadow-md mx-auto p-6">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    {{-- <footer class="bg-bora dark:bg-darkblue py-8 text-center text-sm text-gray-800 dark:text-gray-400">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Logo/Brand -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">Clouds Library</h3>
                    <p class="text-sm">Your digital library for eBooks, accessible anytime, anywhere.</p>
                </div>
                <!-- Quick Links -->
                <div>
                    <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-2">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-emerald transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-emerald transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-emerald transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
                <!-- Social Links -->
                <div>
                    <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-2">Follow Us</h4>
                    <div class="flex justify-center md:justify-start gap-4">
                        <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-emerald transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.6c-.9.4-1.8.7-2.8.8 1-.6 1.8-1.6 2.2-2.7-.9.6-2 1-3.1 1.2-.9-1-2.2-1.6-3.6-1.6-2.7 0-4.9 2.2-4.9 4.9 0 .4 0 .8.1 1.2-4.1-.2-7.7-2.2-10.1-5.2-.4.7-.7 1.6-.7 2.5 0 1.7.9 3.2 2.2 4.1-.8 0-1.6-.2-2.2-.6v.1c0 2.4 1.7 4.4 3.9 4.8-.4.1-.8.2-1.3.2-.3 0-.6 0-.9-.1.6 1.9 2.4 3.3 4.5 3.3-1.6 1.3-3.7 2.1-5.9 2.1-.4 0-.8 0-1.2-.1 2.1 1.4 4.6 2.2 7.3 2.2 8.7 0 13.5-7.2 13.5-13.5 0-.2 0-.4-.1-.6.9-.7 1.7-1.5 2.3-2.5z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 dark:text-gray-400 hover:text-emerald transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.2c-5.4 0-9.8 4.4-9.8 9.8 0 4.3 2.8 8 6.6 9.3.5.1.7-.2.7-.5v-1.7c-2.7.6-3.3-1.3-3.3-1.3-.4-1.1-1.1-1.4-1.1-1.4-.9-.6.1-.6.1-.6 1 .1 1.5 1 1.5 1 .9 1.5 2.3 1.1 2.9.8.1-.7.4-1.1.6-1.4-2.2-.2-4.5-1.1-4.5-5 0-1.1.4-2 1.1-2.7-.1-.2-.5-1.3.1-2.7 0 0 .9-.3 2.9 1.1 1.7-.5 3.5-.5 5.2 0 2-1.4 2.9-1.1 2.9-1.1.6 1.4.2 2.5.1 2.7.7.7 1.1 1.6 1.1 2.7 0 3.9-2.3 4.8-4.5 5v1.7c0 .3.2.6.7.5 3.8-1.3 6.6-5 6.6-9.3 0-5.4-4.4-9.8-9.8-9.8z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <p class="border-t border-secondary-100 dark:border-secondary-200 pt-4">
                © {{ date('Y') }} Clouds Library. All rights reserved.
            </p>
        </div>
    </footer> --}}

    <x-toaster-hub />

    @livewireScripts()
</body>

</html>