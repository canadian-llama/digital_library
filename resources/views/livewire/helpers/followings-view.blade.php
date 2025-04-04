<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-11/12 max-w-md">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">{{ $title }}</h2>

    @if ($followings === 0)
    <p class="text-gray-700 dark:text-gray-300">Nothing to display</p>
    @elseif ($followings->isEmpty())
    <p class="text-gray-700 dark:text-gray-300">Nothing to display</p>
    @else
    @foreach ($followings as $following)
    <div class="flex justify-between items-center mt-5" wire:key="{{ $following->id }}">
        <a wire:navigate href="/profile/{{ $following->user_id }}"
            class="text-lg font-medium text-gray-800 dark:text-white">
            {{ $following->user->name }}
        </a>
        <button
            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm">
            Follow
        </button>
    </div>
    @endforeach
    @endif
</div>