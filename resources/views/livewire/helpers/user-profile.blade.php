<!-- Scrollable Profile Container -->
<div class="w-full h-full overflow-y-auto p-6 bg-gray-100 dark:bg-gray-900 rounded-md max-h-[95vh]"
    x-data="{ showModal: false, fieldToEdit: null, showModal2:false, showModal3:false }">
    <h2 class="text-2xl font-bold text-green-600 border-b pb-4">👤 Your Profile</h2>
    <!-- Profile Top Section -->
    <div class="flex flex-col items-center gap-3 mb-6">
        <!-- Profile Image -->
        <div class="relative">
            @if ($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile" class="w-24 h-24 rounded-full object-cover">
            @else
            <img src="https://via.placeholder.com/100" alt="Profile" class="w-24 h-24 rounded-full object-cover">
            @endif

            <!-- Camera Icon -->
            <button @click="fieldToEdit = 'Image'; showModal = true;"
                class="absolute bottom-0 right-0 bg-blue-600 p-1 rounded-full hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                        d="M12 5a3 3 0 013 3v1h3a1 1 0 011 1v10a1 1 0 01-1 1H6a1 1 0 01-1-1V10a1 1 0 011-1h3V8a3 3 0 013-3z" />
                </svg>
            </button>
        </div>

        <!-- Username and Stats -->
        <div class="text-center dark:text-white">
            <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
            <div class="flex gap-4 justify-center mt-1 text-sm text-gray-500 dark:text-gray-300">
                <a href="#" @click="showModal3 = true;">
                    <span>
                        <strong>{{ $user->followed }}</strong>
                        Followers
                    </span>
                    <a href="#" @click="showModal2 = true;">
                        <span>
                            <strong>{{ $user->following }}</strong>
                            Followings
                        </span>
                    </a>

                </a>
            </div>
        </div>
    </div>

    <!-- Profile Fields -->
    <div class=" flex flex-col gap-4">
        {{-- Username --}}
        <div class="relative group">
            <label class="block text-gray-600 dark:text-gray-300">Username</label>
            <input type="text" readonly value="{{ $username }}" wire:model.live.debounce.150ms='username'
                class="w-full mt-1 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white cursor-not-allowed" />
            <button @click="fieldToEdit = 'Username'; showModal = true;" class="absolute top-6 right-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-gray-500 hover:text-blue-600 dark:hover:text-blue-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 112.828 2.828L11 14l-4 1 1-4z" />
                </svg>
            </button>
        </div>

        {{-- Email --}}
        <div class="relative group">
            <label class="block text-gray-600 dark:text-gray-300">Email</label>
            <input type="text" readonly value="{{ $email }}" wire:model.live.debounce.150ms='email'
                class="w-full mt-1 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white cursor-not-allowed" />
            <button @click="fieldToEdit = 'Email'; showModal = true;" class="absolute top-6 right-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-gray-500 hover:text-blue-600 dark:hover:text-blue-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 112.828 2.828L11 14l-4 1 1-4z" />
                </svg>
            </button>
        </div>

        {{-- Bio (Fixed Height, Scroll if Needed) --}}
        <div class="relative group">
            <label class="block text-gray-600 dark:text-gray-300">Bio</label>
            <textarea readonly rows="3"
                class="w-full mt-1 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white resize-none cursor-not-allowed overflow-y-auto"
                placeholder="Tell us something about yourself...">{{ $bio }}</textarea>
            <button @click="fieldToEdit = 'Bio'; showModal = true;" class="absolute top-6 right-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-gray-500 hover:text-blue-600 dark:hover:text-blue-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 112.828 2.828L11 14l-4 1 1-4z" />
                </svg>
            </button>
        </div>

        {{-- Password / Account Actions --}}
        {{-- <div class="flex flex-col gap-2 mt-4">
            <button class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded"
                wire:click.prevent='changePassword'>Change Password</button>
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded" wire:click='deactivate'>Deactivate
                Account</button>
            <button class="bg-red-600 hover:bg-red-700 text-white p-2 rounded" wire:click='softDelete'>Delete
                Account</button>
        </div> --}}
    </div>

    <!-- Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-11/12 max-w-md">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Edit <span x-text="fieldToEdit"></span>
            </h2>

            <form wire:submit='update({{ $user }})'>
                <!-- Dynamic Input Field -->
                <template x-if="fieldToEdit === 'Username'">
                    <div class="mb-4">
                        <label class="block text-gray-600 dark:text-gray-300">New Username</label>
                        <input type="text"
                            class="w-full mt-1 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            value="{{ $user->username }}" wire:model.live.debounce.50ms='username'>
                        @error('username')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </template>

                <template x-if="fieldToEdit === 'Email'">
                    <div class="mb-4">
                        <label class="block text-gray-600 dark:text-gray-300">New Email</label>
                        <input type="email"
                            class="w-full mt-1 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            value="{{ $user->email }}" wire:model.live.debounce.150ms='email'>
                    </div>
                    @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </template>

                <template x-if="fieldToEdit === 'Bio'">
                    <div class="mb-4">
                        <label class="block text-gray-600 dark:text-gray-300">New Bio</label>
                        <textarea rows="3"
                            class="w-full mt-1 p-2 rounded border dark:border-gray-600 dark:bg-gray-700 dark:text-white resize-none"
                            wire:model.live.debounce.150ms='bio'>{{ $bio }}</textarea>
                    </div>
                    @error('bio')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </template>

                <template x-if="fieldToEdit === 'Image'">
                    <div class="mb-4">
                        <label class="block text-gray-600 dark:text-gray-300">Upload New Image</label>
                        <img src="{{ asset('storage/' . $this->user->profile_image) }}" alt="apple">
                        <input type="file"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 text-gray-900"
                            wire:model.live.debounce.10ms="image">
                    </div>
                    @error('image')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </template>

                <!-- Buttons -->
                <div class="flex justify-end gap-4">
                    <a href="#" @click="showModal = false;"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                        Cancel
                    </a>
                    <button @click="showModal = false;"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="showModal2" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        @click="showModal2 = false;">
        <livewire:helpers.followings-view id="{{ $user->id }}">
    </div>

    <div x-show="showModal3" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        @click="showModal3 = false;">
        <livewire:helpers.followers-view id="{{ $user->id }}">
    </div>

</div>