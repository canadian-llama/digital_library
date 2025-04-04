<div class="max-w-md w-full mx-auto p-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Sign Up</h2>
    </div>

    <form wire:submit.prevent='register' class="space-y-5">
        <!-- Full Name -->
        <div>
            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Full Name</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <input id="name" type="text" wire:model.lazy='name' placeholder="Enter your Full Name"
                    class="w-full pl-10 p-3 rounded-lg border border-gray-300 dark:border-secondary-200 bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald">
            </div>
            @error('name')<p class="text-xs text-madder mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Username -->
        <div>
            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Username</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <input id="username" type="text" wire:model.lazy='username' placeholder="Enter your Username"
                    class="w-full pl-10 p-3 rounded-lg border border-gray-300 dark:border-secondary-200 bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald">
            </div>
            @error('username')<p class="text-xs text-madder mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Phone Number -->
        <div>
            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Phone No.</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h2a2 2 0 012 2v10a2 2 0 01-2 2H3m18 0h-2a2 2 0 01-2-2V7a2 2 0 012-2h2m-9 12h2m-2-4h2" />
                    </svg>
                </span>
                <input id="phone" type="tel" wire:model.lazy='phone' placeholder="Enter your Number"
                    class="w-full pl-10 p-3 rounded-lg border border-gray-300 dark:border-secondary-200 bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald">
            </div>
            @error('phone')<p class="text-xs text-madder mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Email</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12H8m4-4v8m-8 4h16a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </span>
                <input id="email" type="email" wire:model.lazy='email' placeholder="Enter your Email"
                    class="w-full pl-10 p-3 rounded-lg border border-gray-300 dark:border-secondary-200 bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald">
            </div>
            @error('email')<p class="text-xs text-madder mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Password -->
        <div x-data="{ showPassword: false }">
            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Password</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0-1.1.9-2 2-2m-2 6c-1.1 0-2-.9-2-2m2 2v4m0-10V7m6 4h4m-4 0H8m8 0c0 2.2-1.8 4-4 4s-4-1.8-4-4 1.8-4 4 4z" />
                    </svg>
                </span>
                <input :type="showPassword ? 'text' : 'password'" id="password" wire:model.lazy='password'
                    placeholder="Enter your Password"
                    class="w-full pl-10 p-3 rounded-lg border border-gray-300 dark:border-secondary-200 bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald">
                <button type="button" @click="showPassword = !showPassword"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 dark:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12c0-1.5-.5-2.8-1.4-3.8L16 6M9 12c0 1.5.5 2.8 1.4 3.8L8 18m9 0a9 9 0 1 0-8-8 9 9 0 0 0 8 8z" />
                    </svg>
                </button>
            </div>
            @error('password')<p class="text-xs text-madder mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Confirm Password -->
        <div x-data="{ showPasswordConfirmation: false }">
            <label class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">Confirm Password</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0-1.1.9-2 2-2m-2 6c-1.1 0-2-.9-2-2m2 2v4m0-10V7m6 4h4m-4 0H8m8 0c0 2.2-1.8 4-4 4s-4-1.8-4-4 1.8-4 4 4z" />
                    </svg>
                </span>
                <input :type="showPasswordConfirmation ? 'text' : 'password'" id="password_confirmation"
                    wire:model.lazy='password_confirmation' placeholder="Confirm Password"
                    class="w-full pl-10 p-3 rounded-lg border border-gray-300 dark:border-secondary-200 bg-snow dark:bg-darkblue text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald">
                <button type="button" @click="showPasswordConfirmation = !showPasswordConfirmation"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-600 dark:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12c0-1.5-.5-2.8-1.4-3.8L16 6M9 12c0 1.5.5 2.8 1.4 3.8L8 18m9 0a9 9 0 1 0-8-8 9 9 0 0 0 8 8z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-emerald text-white py-3 rounded-full font-semibold uppercase hover:bg-emerald/90 focus:outline-none focus:ring-2 focus:ring-emerald transition">
            Register
        </button>
    </form>

    <!-- Login Link -->
    <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
        Have an account?
        <a href="#" @click.prevent="$dispatch('open-modal', { name: 'login' })"
            class="text-primary hover:underline font-medium">
            Sign in
        </a>
    </p>
</div>