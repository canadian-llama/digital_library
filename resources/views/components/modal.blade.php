@props(['name'])

<div x-data="{ show: false, name: '{{ $name }}' }" x-show="show"
    x-on:open-modal.window="show = ($event.detail.name === name)" x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false" x-cloak
    class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-700/50 transition-opacity"
    style="display: none;">
    <div x-on:click.outside="show = false"
        class="bg-white dark:bg-sky-800 rounded-lg shadow-lg max-w-lg w-full mx-auto p-6 transform transition-all scale-95 max-h-[90vh] overflow-y-auto"
        x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        {{ $slot }}
    </div>
</div>