<div class="flex flex-col items-center gap-6 bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100 min-h-screen py-8 px-4"
    x-data="{ showFullSummary: false, showShareOptions: false }">
    <!-- Book Detail Card -->
    <div class="bg-white dark:bg-secondary-100 rounded-xl shadow-lg w-full max-w-4xl overflow-hidden">
        <!-- Share Button (Top Right) -->
        <div class="flex justify-end p-4">
            <button @click="showShareOptions = !showShareOptions"
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary transition duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.684 13.342C9.886 12.938 10 12.773 10 12c0-.773-.886-1.938-2.088-2.342M15.316 13.342C14.114 12.938 14 12.773 14 12c0-.773.886-1.938 2.088-2.342M12 19l-3.5-7 3.5-7 3.5 7-3.5 7z">
                    </path>
                </svg>
                Share
            </button>
            <!-- Share Options Dropdown -->
            <div x-show="showShareOptions" x-cloak
                class="absolute mt-12 bg-white dark:bg-darkblue rounded-lg shadow-lg p-4 z-10"
                @click.away="showShareOptions = false">
                <div class="flex flex-col gap-2">
                    <!-- Copy Link -->
                    <button
                        @click="navigator.clipboard.writeText(window.location.href); alert('Link copied to clipboard!'); showShareOptions = false"
                        class="flex items-center gap-2 px-3 py-2 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-secondary-200 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        Copy Link
                    </button>
                    <!-- Share on Twitter -->
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text=Check out this book on Clouds Library!"
                        target="_blank"
                        class="flex items-center gap-2 px-3 py-2 text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-secondary-200 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.6c-.9.4-1.8.7-2.8.8 1-.6 1.8-1.6 2.2-2.7-.9.6-2 1-3.1 1.2-.9-1-2.2-1.6-3.6-1.6-2.7 0-4.9 2.2-4.9 4.9 0 .4 0 .8.1 1.2-4.1-.2-7.7-2.2-10.1-5.2-.4.7-.7 1.6-.7 2.5 0 1.7.9 3.2 2.2 4.1-.8 0-1.6-.2-2.2-.6v.1c0 2.4 1.7 4.4 3.9 4.8-.4.1-.8.2-1.3.2-.3 0-.6 0-.9-.1.6 1.9 2.4 3.3 4.5 3.3-1.6 1.3-3.7 2.1-5.9 2.1-.4 0-.8 0-1.2-.1 2.1 1.4 4.6 2.2 7.3 2.2 8.7 0 13.5-7.2 13.5-13.5 0-.2 0-.4-.1-.6.9-.7 1.7-1.5 2.3-2.5z" />
                        </svg>
                        Share on Twitter
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3">
            <!-- Book Cover -->
            <div class="p-6 flex items-center justify-center">
                <img src="{{ asset('storage/' . $book->display_image) }}" alt="{{ $book->book_title }}"
                    class="rounded-lg w-full max-w-xs shadow-md">
            </div>

            <!-- Book Info -->
            <div class="md:col-span-2 p-6 space-y-4">
                <!-- Title -->
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $book->book_title }}</h1>

                <!-- Author and Uploader -->
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold text-gray-800 dark:text-gray-200">Author:</span>
                    {{ $book->book_author }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold text-gray-800 dark:text-gray-200">Uploaded by:</span>
                    @auth
                    <a wire:navigate href="/profile/{{ $book->user_id }}" class="underline hover:text-emerald">
                        {{ $book->user->username }}
                    </a>
                    @endauth
                    @guest
                    <a href="#" @click="$dispatch('open-modal', { name: 'login' })"
                        class="underline hover:text-emerald">
                        {{ $book->user->username }}
                    </a>
                    @endguest
                </p>

                <!-- Language, Words, Chapters, Views -->
                <div class="flex flex-wrap gap-4 text-sm text-gray-600 dark:text-gray-400">
                    <p>
                        <span class="font-semibold text-gray-800 dark:text-gray-200">Language:</span> English
                    </p>
                    <p>
                        <span class="font-semibold text-gray-800 dark:text-gray-200">Words:</span> {{
                        number_format($book->word_count ?? 184800) }}
                    </p>
                    <p>
                        <span class="font-semibold text-gray-800 dark:text-gray-200">Chapters:</span> {{
                        $book->chapter_count ?? 1015 }}
                    </p>
                    <p>
                        <span class="font-semibold text-gray-800 dark:text-gray-200">Views:</span> {{
                        number_format($book->views ?? 388500) }}
                    </p>
                </div>

                <!-- Rating -->
                <div class="flex items-center gap-2">
                    <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $book->rating ?? 8.9
                        }}</span>
                    <div class="flex items-center gap-1">
                        @for ($i = 1; $i <= 5; $i++) @if ($i <=floor($book->rating ?? 8.9))
                            <svg class="w-4 h-4 text-desertsand" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955 4.15.011c.969.003 1.371 1.24.588 1.81l-3.36 2.45 1.286 3.955c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.36 2.45c-.785.57-1.84-.197-1.54-1.118l1.286-3.955-3.36-2.45c-.783-.57-.38-1.807.588-1.81l4.15-.011 1.286-3.955z" />
                            </svg>
                            @else
                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955 4.15.011c.969.003 1.371 1.24.588 1.81l-3.36 2.45 1.286 3.955c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.36 2.45c-.785.57-1.84-.197-1.54-1.118l1.286-3.955-3.36-2.45c-.783-.57-.38-1.807.588-1.81l4.15-.011 1.286-3.955z" />
                            </svg>
                            @endif
                            @endfor
                    </div>
                </div>

                <!-- Genre -->
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold text-gray-800 dark:text-gray-200">Genre:</span>
                    @foreach(explode(',', $book->book_genre) as $genre)
                    <span
                        class="inline-block bg-emerald/20 text-emerald-800 dark:text-emerald-200 px-2 py-1 rounded-full text-xs mr-2">
                        {{ $genre }}
                    </span>
                    @endforeach
                </p>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="p-6 border-t border-gray-200 dark:border-secondary-200">
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Summary</h2>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                <span x-show="!showFullSummary">
                    {{ Str::limit($book->book_description, 100) }}
                </span>
                <span x-show="showFullSummary" x-cloak>
                    {{ $book->book_description }}
                </span>
                <a href="#" @click.prevent="showFullSummary = !showFullSummary" class="text-primary hover:underline">
                    <span x-text="showFullSummary ? 'Less' : 'More'"></span>
                </a>
            </p>
        </div>
    </div>

    <!-- You Might Also Like Section -->
    {{-- <div class="w-full max-w-4xl">
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">You Might Also Like</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            <!-- Placeholder for related books (using card component) -->
            @for ($i = 0; $i
            < 4; $i++) <livewire:card :title="'Book Title ' . ($i + 1)" :author="'Author ' . ($i + 1)"
                :rating="rand(3, 5)" :book="$book" :key="$i" />
            @endfor
        </div>
    </div> --}}

    <!-- Action Buttons -->
    <div class="flex gap-4 w-full max-w-4xl">
        @auth
        <!-- Favorite Button -->
        @if ($fave->isEmpty())
        <form wire:submit='favorite("favorite", {{ $book->id }})'>
            <button title="Favorite" class="text-gray-600 dark:text-gray-400 hover:text-madder transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8 hover:fill-madder">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
        </form>
        @else
        <form wire:submit='favorite("favorite", {{ $book->id }})'>
            <button title="Unfavorite" class="text-madder hover:text-gray-600 dark:hover:text-gray-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="" class="w-8 h-8 hover:fill-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
        </form>
        @endif

        <!-- Download PDF Button -->
        @if ($pdfBook)
        <form wire:submit.prevent='download("pdf")'>
            <button type="submit"
                class="flex-1 bg-emerald text-white px-6 py-2 rounded-lg font-semibold flex items-center justify-center gap-3 hover:bg-emerald/90 focus:outline-none focus:ring-2 focus:ring-emerald transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                    </path>
                </svg>
                Download PDF
            </button>
        </form>
        @endif

        <!-- Download EPUB Button -->
        @if ($epubBook)
        <form wire:submit.prevent='download("epub")'>
            <button type="submit"
                class="flex-1 bg-madder text-white px-6 py-2 rounded-lg font-semibold flex items-center justify-center gap-3 hover:bg-madder/90 focus:outline-none focus:ring-2 focus:ring-madder transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253">
                    </path>
                </svg>
                Download EPUB
            </button>
        </form>
        @endif
        @endauth
    </div>

    <!-- Comments Section (for authenticated users) -->
    @auth
    <div class="bg-white dark:bg-secondary-100 rounded-xl shadow-lg w-full max-w-4xl p-6 mt-6 space-y-4">
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">Comments</h2>
        <livewire:comment-section id="{{ $book->id }}">
    </div>
    @endauth
</div>