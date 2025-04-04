<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'Digital Library' }}</title>

    @livewireStyles()
</head>

<body class="tracking-wider bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-200">
    <div class="flex h-screen">

        <!-- Main Content -->
        <div class="">
            <!-- Header -->
            {{-- <header
                class="w-full py-4 px-6 bg-indigo-600 dark:bg-gray-800 text-white shadow-md flex justify-between items-center">
                <h1 class="text-2xl font-bold">Digital Library</h1>
                <button class="px-4 py-2 rounded bg-yellow-400 text-black font-semibold hover:bg-yellow-500">
                    Profile
                </button>
            </header> --}}

            <!-- Content Area -->
            <main class="bg-white dark:bg-gray-800 overflow-y-auto">
                {{ $slot }}
            </main>

            <!-- Footer -->
            {{-- <footer class="w-full py-4 bg-gray-700 text-center text-white">
                <p>&copy; {{ date('Y') }} Digital Library. All rights reserved.</p>
            </footer> --}}
        </div>
    </div>

    <x-toaster-hub />
    @livewireScripts()
</body>

</html>