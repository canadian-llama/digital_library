<div x-data="{ showPassword: false, showPassword2: false, isSaving: false }" @save-complete.window="isSaving = false"
    class="flex-1 flex items-center justify-center p-6 overflow-hidden">

    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-6 h-[85vh] overflow-y-auto">
        <h2 class="text-2xl font-bold text-madder border-b pb-4">👤 Create New Admin/User</h2>
        <form wire:submit.prevent="save" @submit="isSaving = true" class="space-y-5 mt-4">
            {{-- Full Name --}}
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-1">Full Name</label>
                <input type="text" class="w-full border text-gray-900 placeholder-gray-500 border-gray-300 rounded-lg 
                    px-4 py-2 focus:outline-none focus:ring-2 focus:ring-skyline transition-shadow" name="name"
                    wire:model.live.debounce.100ms="name" placeholder="John Doe">
                @error('name')
                <span class="text-sm text-red-600 italic">{{ $message }}</span>
                @enderror
            </div>

            {{-- Username --}}
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-1">Username</label>
                <input type="text"
                    class="w-full border text-gray-900 placeholder-gray-500 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-skyline transition-shadow"
                    name="username" wire:model.live.debounce.100ms="username" placeholder="johndoe123">
                @error('username') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-1">Email Address</label>
                <input type="email"
                    class="w-full border text-gray-900 placeholder-gray-500 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-skyline transition-shadow"
                    name="email" wire:model.live.debounce.100ms="email" placeholder="john@example.com">
                @error('email') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-1">Role</label>
                <select name="role"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-skyline bg-white text-gray-900 transition-shadow"
                    wire:model="role">
                    <option value="">Choose Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                @error('role') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
            </div>

            {{-- Password --}}
            <div class="relative">
                <label class="block text-sm font-semibold text-gray-800 mb-1">Password</label>
                <input :type="showPassword ? 'text' : 'password'"
                    class="w-full border text-gray-900 placeholder-gray-500 border-gray-300 rounded-lg px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-skyline transition-shadow"
                    name="password" wire:model="password" placeholder="••••••••">

                <!-- Eye Icon Toggle -->
                <button type="button" @click="showPassword = !showPassword"
                    class="absolute right-3 top-9 text-gray-500">
                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.045 10.045 0 012.442-4.293M15 12a3 3 0 11-6 0 3 3 0 016 0zm6.121 6.121L4.879 4.879" />
                    </svg>
                </button>

                @error('password') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="relative">
                <label class="block text-sm font-semibold text-gray-800 mb-1">Confirm Password</label>
                <input :type="showPassword2 ? 'text' : 'password'"
                    class="w-full border text-gray-900 placeholder-gray-500 border-gray-300 rounded-lg px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-skyline transition-shadow"
                    name="password" wire:model="password_confirmation" placeholder="••••••••">

                <!-- Eye Icon Toggle -->
                <button type="button" @click="showPassword2 = !showPassword2"
                    class="absolute right-3 top-9 text-gray-500">
                    <svg x-show="!showPassword2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showPassword2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.045 10.045 0 012.442-4.293M15 12a3 3 0 11-6 0 3 3 0 016 0zm6.121 6.121L4.879 4.879" />
                    </svg>
                </button>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-madder hover:bg-skyline text-white py-2 px-4 rounded-lg font-medium transition duration-200 flex items-center justify-center relative"
                    wire:loading.attr="disabled" wire:target="save">

                    <!-- Loading Spinner -->
                    <svg wire:loading wire:target="save"
                        class="animate-spin h-5 w-5 mr-2 text-white absolute left-4 top-1/2 transform -translate-y-1/2"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                    </svg>

                    <span wire:loading.remove wire:target="save">Save User</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>
        </form>
    </div>
</div>