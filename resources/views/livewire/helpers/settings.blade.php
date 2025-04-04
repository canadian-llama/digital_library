<div x-data="{ tab: 'preferences', showModal:false }" class="w-full h-full bg-gray-100 dark:bg-gray-900 py-10">
    <div class="lg:w-[70%] sm:w-[80%] w-[90%] mx-auto flex flex-col gap-6">
        <!-- Header -->
        <h2 class="text-2xl font-bold text-yellow-600 border-b pb-4">⚙️ Customize Settings</h2>

        <!-- Tabs Navigation -->
        <div class="flex flex-wrap gap-2 border-b border-gray-300 dark:border-gray-700 pb-2">
            <template x-for="item in ['preferences', 'privacy']">
                <button @click="tab = item"
                    :class="{'border-b-4 border-blue-500 text-blue-600 dark:text-blue-400': tab === item}"
                    class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                    <span x-text="item.charAt(0).toUpperCase() + item.slice(1)"></span>
                </button>
            </template>
        </div>

        <!-- Tabs Content -->
        <div class="bg-white dark:bg-gray-800 rounded-md shadow-md p-6 space-y-6 max-h-[80vh] overflow-auto">

            <!-- Account Settings -->
            {{-- <div x-show="tab === 'account'" class="space-y-4">
                <h3 class="text-xl font-semibold dark:text-white">Account Settings</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm dark:text-gray-300">Name</label>
                        <input type="text"
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm dark:text-gray-300">Email</label>
                        <input type="email"
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm dark:text-gray-300">Password</label>
                        <input type="password"
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>
            </div> --}}

            <!-- Preferences -->
            <div x-show="tab === 'preferences'" class="space-y-4">
                <h3 class="text-xl font-semibold dark:text-white">Preferences</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm dark:text-gray-300">Theme</label>
                        <select
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            name="theme" wire:model.live='theme'>
                            <option>Light</option>
                            <option>Dark</option>
                            {{-- <option>System Default</option> --}}
                        </select>
                        @error('theme')
                        <span class="text-sm text-red-600 italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm dark:text-gray-300">Font Size</label>
                        <select
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            name="font" wire:model.live='font'>
                            <option>Small</option>
                            <option>Medium</option>
                            <option>Large</option>
                        </select>
                        @error('font')
                        <span class="text-sm text-red-600 italic">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="sm:col-span-2">
                        <label class="block text-sm dark:text-gray-300">Default Reading Mode</label>
                        <select
                            class="w-full mt-1 p-2 rounded border dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option>Scroll</option>
                            <option>Paginated</option>
                        </select>
                    </div> --}}
                </div>
            </div>

            <!-- Notifications -->
            {{-- <div x-show="tab === 'notifications'" class="space-y-4">
                <h3 class="text-xl font-semibold dark:text-white">Notification Settings</h3>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 dark:text-gray-300">
                        <input type="checkbox" class="rounded" name="notification1" wire:model='notification1'> Email
                        Notifications
                    </label>
                    <label class="flex items-center gap-2 dark:text-gray-300">
                        <input type="checkbox" class="rounded" name="notification2"> In-App Notifications
                    </label>
                    <label class="flex items-center gap-2 dark:text-gray-300">
                        <input type="checkbox" class="rounded" name="notification3" wire:model='notification3 '> Push
                        Notifications
                    </label>
                </div>
            </div> --}}

            <!-- Privacy -->
            <div x-show="tab === 'privacy'" class="space-y-4">
                <h3 class="text-xl font-semibold dark:text-white">Privacy & Security</h3>
                <div class="space-y-2">
                    {{-- <label class="flex items-center gap-2 dark:text-gray-300">
                        <input type="checkbox" class="rounded"> Two-Factor Authentication
                    </label> --}}
                    <button @click="showModal = true;" class="text-blue-600 dark:text-blue-400 hover:underline">Change
                        Password</button>
                    <button wire:click='deactivate'
                        class="text-yellow-600 dark:text-yellow-400 hover:underline">Deactivate My Account</button>
                    <button wire:click='delete' class="text-red-600 hover:underline">Delete My Account</button>
                </div>
            </div>

            <!-- Billing -->
            {{-- <div x-show="tab === 'billing'" class="space-y-4">
                <h3 class="text-xl font-semibold dark:text-white">Subscription & Billing</h3>
                <div class="space-y-2 dark:text-gray-300">
                    <p>Current Plan: <span class="font-semibold dark:text-white">Premium</span></p>
                    <p>Next Billing Date: 2025-04-10</p>
                    <button class="text-blue-600 dark:text-blue-400 hover:underline">Manage Payment Methods</button>
                    <button class="text-red-600 hover:underline">Cancel Subscription</button>
                </div>
            </div> --}}

            <!-- Action Buttons -->
            <div x-show="tab === 'preferences'" class="flex justify-end gap-4 pt-4 border-t dark:border-gray-700">
                <button
                    class="px-4 py-2 rounded bg-gray-200 dark:bg-gray-700 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600">Cancel</button>
                <button wire:click='save' class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Save
                    Changes</button>
            </div>

        </div>
        <div x-show="showModal"
            class="hidde  fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <livewire:forms.change-password>
        </div>
    </div>

</div>