<div class="w-full max-w-screen-xl mx-auto px-4 py-6">
    @if ($favorites->isEmpty())
    <div class="flex flex-col items-center justify-center py-20">
        <span class="text-lg font-semibold text-gray-600 dark:text-gray-300">No books available yet!</span>
    </div>
    @else
    {{-- All Books Section --}}
    <section>
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">My Library</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-6 gap-4">
            @foreach ($favorites as $favorite)
            <livewire:card id="{{ $favorite->book->id }}">
            @endforeach
        </div>

        {{-- Pagination --}}
        {{-- <div class="mt-6">
            {{ $favorites->links('pagination::tailwind') }}
        </div> --}}
    </section>
    @endif
</div>
