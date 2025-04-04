<div class="bg-white dark:bg-secondary-100 rounded-xl shadow-md hover:shadow-xl border border-transparent 
hover:border-emerald transform hover:scale-105 transition duration-300 ease-in-out overflow-hidden relative"
    wire:key="{{ $key ?? 0 }}">
    <a wire:navigate href="/book-details/{{ $book->id }}" class="block">
        <!-- Book Cover -->
        <div class="relative">
            <img src="{{ asset('storage/' . $book->display_image) }}" alt="Book Cover"
                class="w-full h-48 object-cover rounded-t-xl" />
            <!-- Overlay on Hover -->
            <div
                class="absolute inset-0 bg-emerald/20 opacity-0 hover:opacity-100 transition-opacity duration-300 rounded-t-xl">
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-4 space-y-2">
            <!-- Title -->
            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 truncate capitalize">
                {{ $title ?? 'Book Title' }}
            </h3>
            <!-- Author -->
            <p class="text-sm text-gray-600 dark:text-gray-400 truncate">
                by {{ $author }}
            </p>
            <!-- Rating -->
            @if ($rating)
            <div class="flex items-center gap-1 bg-snow dark:bg-darkblue/50 rounded-md p-1">
                @for ($i = 1; $i <= 5; $i++) @if ($i <=$rating) <!-- Filled Star -->
                    <svg class="w-4 h-4 text-desertsand" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955 4.15.011c.969.003 1.371 1.24.588 1.81l-3.36 2.45 1.286 3.955c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.36 2.45c-.785.57-1.84-.197-1.54-1.118l1.286-3.955-3.36-2.45c-.783-.57-.38-1.807.588-1.81l4.15-.011 1.286-3.955z" />
                    </svg>
                    @else
                    <!-- Empty Star -->
                    <svg class="w-4 h-4 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.955 4.15.011c.969.003 1.371 1.24.588 1.81l-3.36 2.45 1.286 3.955c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.36 2.45c-.785.57-1.84-.197-1.54-1.118l1.286-3.955-3.36-2.45c-.783-.57-.38-1.807.588-1.81l4.15-.011 1.286-3.955z" />
                    </svg>
                    @endif
                    @endfor
            </div>
            @endif
        </div>
    </a>

    <!-- Favorite Button (Visible to Authenticated Users) -->
    {{-- @auth
    <div class="absolute top-2 right-2">
        @if ($fave->isEmpty())
        <form wire:submit.prevent='favorite("favorite", {{ $book->id }})'>
            <button title="Unfavorite" class="hover:text-madder transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="" class="w-6 h-6 text-madder hover:fill-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
        </form>
        @else
        <form wire:submit.prevent='favorite("favorite", {{ $book->id }})'>
            <button title="Favorite" class="hover:text-madder transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 text-gray-500 dark:text-gray-400 hover:fill-madder">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
        </form>
        @endif
    </div>
    @endauth --}}
</div>