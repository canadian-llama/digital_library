<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Digital Library</title>
    @vite('resources/css/app.css')
    @livewireStyles()
</head>

<body
    class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen flex flex-col w-screen overflow-x-hidden">

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

        <!-- Back Arrow -->
        <div class="px-4 pt-6">
            <button onclick="window.history.back()" aria-label="Go Back"
                class="text-purple-600 hover:text-purple-400 transition">
                <!-- Heroicon: Arrow Left -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>

        <!-- Main Content -->
        <main class="mx-auto max-w-screen-md md:max-w-screen-lg px-4 py-6">
            {{ $slot }}
        </main>

        <!-- Optional Footer -->
        <footer class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} Clouds Library. All rights reserved.
        </footer>

        <x-toaster-hub />
    </div>

    @livewireScripts()
</body>

</html>