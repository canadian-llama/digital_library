<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clouds Library - Book Details</title>
    @vite('resources/css/app.css')
    @livewireStyles()
</head>

<body
    class="bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100 min-h-screen flex flex-col w-screen overflow-x-hidden">
    <!-- Header -->
    <header class="sticky top-0 z-30 w-full bg-white dark:bg-darkblue shadow-md transition-all py-4">
        <div class="px-4 max-w-screen-xl mx-auto flex items-center justify-between">
            <!-- Logo -->
            <a href="/" wire:navigate class="text-2xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">
                Clouds Library
            </a>

            <!-- Share Button -->
            {{-- <button @click="$dispatch('open-modal', { name: 'share-book' })"
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary transition duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.684 13.342C9.886 12.938 10 12.773 10 12c0-.773-.114-1.938 1.088-2.342M8.684 13.342C7.482 13.746 6 14.692 6 16c0 1.308 1.482 2.254 2.684 2.658m0-5.316l4.632-2.658m4.632 2.658c1.202-.404 2.684-1.35 2.684-2.658 0-1.308-1.482-2.254-2.684-2.658m0 5.316c-1.202.404-2.684 1.35-2.684 2.658 0 1.308 1.482 2.254 2.684 2.658M13.316 10.658L8.684 13.342m4.632-2.684l4.632 2.684">
                    </path>
                </svg>
                Share
            </button> --}}
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 mx-auto max-w-screen-md md:max-w-screen-lg px-4 py-8 space-y-6">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-bora dark:bg-darkblue py-8 text-center text-sm text-gray-800 dark:text-gray-400">
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
    </footer>

    <!-- Share Modal -->
    {{-- <x-modal name="share-book">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Share This Book</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Share "{{ $book->book_title }}" with your friends!</p>
            <div class="space-y-4">
                <!-- Copy Link -->
                <div class="flex items-center gap-2">
                    <input type="text" readonly value="{{ url('/book-details/' . $book->id) }}"
                        class="w-full p-2 rounded-lg border border-gray-300 dark:border-secondary-200 bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100">
                    <button
                        @click="navigator.clipboard.writeText('{{ url('/book-details/' . $book->id) }}'); alert('Link copied to clipboard!')"
                        class="px-4 py-2 bg-emerald text-white rounded-lg hover:bg-emerald/90 transition">
                        Copy
                    </button>
                </div>
                <!-- Social Share Buttons -->
                <div class="flex gap-4">
                    <a href="https://twitter.com/intent/tweet?text=Check out {{ $book->book_title }} on Clouds Library!&url={{ url('/book-details/' . $book->id) }}"
                        target="_blank" class="p-2 bg-darkblue text-white rounded-full hover:bg-darkblue/80">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.6c-.9.4-1.8.7-2.8.8 1-.6 1.8-1.6 2.2-2.7-.9.6-2 1-3.1 1.2-.9-1-2.2-1.6-3.6-1.6-2.7 0-4.9 2.2-4.9 4.9 0 .4 0 .8.1 1.2-4.1-.2-7.7-2.2-10.1-5.2-.4.7-.7 1.6-.7 2.5 0 1.7.9 3.2 2.2 4.1-.8 0-1.6-.2-2.2-.6v.1c0 2.4 1.7 4.4 3.9 4.8-.4.1-.8.2-1.3.2-.3 0-.6 0-.9-.1.6 1.9 2.4 3.3 4.5 3.3-1.6 1.3-3.7 2.1-5.9 2.1-.4 0-.8 0-1.2-.1 2.1 1.4 4.6 2.2 7.3 2.2 8.7 0 13.5-7.2 13.5-13.5 0-.2 0-.4-.1-.6.9-.7 1.7-1.5 2.3-2.5z" />
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('/book-details/' . $book->id) }}"
                        target="_blank" class="p-2 bg-blue-600 text-white rounded-full hover:bg-blue-600/80">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.04c-5.5 0-10 4.5-10 10 0 5 3.66 9.15 8.44 9.9v-7H7.9v-2.9h2.54V9.85c0-2.51 1.49-3.89 3.78-3.89 1.09 0 2.23.19 2.23.19v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.45 2.9h-2.33v7A10 10 0 0022 12.04c0-5.5-4.5-10-10-10z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </x-modal> --}}

    <x-toaster-hub />

    @livewireScripts()
</body>

</html>