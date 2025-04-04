<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-11/12 max-w-md">
    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
        Change Password
    </h2>

    <form wire:submit.prevent='save'>
        <input type="text" name="token" id="token" hidden value="{{ $token }}">
        <div class="mb-4" x-data="{ showPassword1: false }">
            <label class="block text-gray-600 dark:text-gray-300">Old Password</label>
            <div class="relative">
                <input :type="showPassword1 ? 'text' : 'password'" wire:model.live="oldPassword"
                    class="mt-1 text-gray-900 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="••••••••">
                <button type="button" @click="showPassword1 = !showPassword1"
                    class="absolute top-1/2 right-3 transform -translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-5 h-5 text-gray-600 dark:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12c0-1.5-.5-2.8-1.4-3.8L16 6M9 12c0 1.5.5 2.8 1.4 3.8L8 18m9 0a9 9 0 1 0-8-8 9 9 0 0 0 8 8z" />
                    </svg>
                </button>
            </div>
            @error('oldPassword')
            <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4" x-data="{ showPassword: false }">
            <label class="block text-gray-600 dark:text-gray-300">New Password</label>
            <div class="relative">
                <input :type="showPassword ? 'text' : 'password'" wire:model.live="password"
                    class="mt-1 text-gray-900 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="••••••••">
                <button type="button" @click="showPassword = !showPassword"
                    class="absolute top-1/2 right-3 transform -translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-5 h-5 text-gray-600 dark:text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12c0-1.5-.5-2.8-1.4-3.8L16 6M9 12c0 1.5.5 2.8 1.4 3.8L8 18m9 0a9 9 0 1 0-8-8 9 9 0 0 0 8 8z" />
                    </svg>
                </button>
            </div>
            @error('password')
            <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-600 dark:text-gray-300">Confirm Password</label>
            <div class="relative" x-data="{ showPasswordConfirmation: false }">
                <input :type="showPasswordConfirmation ? 'text' : 'password'" id="password_confirmation"
                    wire:model.lazy='password_confirmation' placeholder="••••••••"
                    class="mt-1 text-gray-900 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <button type="button" @click="showPasswordConfirmation = !showPasswordConfirmation"
                    class="absolute top-1/2 right-3 transform -translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-5 h-5 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12c0-1.5-.5-2.8-1.4-3.8L16 6M9 12c0 1.5.5 2.8 1.4 3.8L8 18m9 0a9 9 0 1 0-8-8 9 9 0 0 0 8 8z" />
                    </svg>
                </button>
            </div>
        </div>
        <button wire:click='save' class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Save
            Changes</button>
    </form>
</div>