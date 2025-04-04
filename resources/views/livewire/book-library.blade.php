<div class="w-full max-w-screen-xl mx-auto px-6 py-2">
    <!-- Hero Section -->
    <div class="relative bg-white dark:bg-secondary-100 rounded-lg shadow-lg overflow-hidden mb-12">
        <div class="flex flex-col md:flex-row items-center">
            <!-- Left: Featured Book Info -->
            <div class="md:w-1/2 p-8">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                    Featured Book
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
                    Discover the latest addition to our library
                </p>
                <!-- Search Bar with Alpine.js -->
                <div x-data="{ search: '' }" class="relative">
                    <input x-model="search" type="text" placeholder="Search in Clouds Library..."
                        class="w-full p-4 pr-12 rounded-lg border border-gray-300 dark:border-secondary-200 bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald">
                    <button
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300 hover:text-emerald dark:hover:text-emerald"
                        @click="alert('Search functionality coming soon!')">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Right: Featured Image (Placeholder) -->
            <div class="md:w-1/2 h-64 md:h-96 bg-gray-200 dark:bg-secondary-200 flex items-center justify-center">
                <span class="text-gray-500 dark:text-gray-300">Featured Book Image</span>
            </div>
        </div>
    </div>

    <!-- Latest Books Section -->
    @if (!$latests->isEmpty())
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Latest Books</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach ($latests as $latest)
            <livewire:card id="{{ $latest->id }}" />
            @endforeach
        </div>
    </section>
    @endif

    <!-- All Books Section -->
    <section>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">All Books</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach ($books as $book)
            <livewire:card id="{{ $book->id }}" />
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $books->links('pagination::tailwind') }}
        </div>
    </section>
</div>