<div class="max-w-md w-full mx-auto p-6">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Log In</h2>
    </div>

    <form wire:submit.prevent='login' class="space-y-5">
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
                <input type="email" wire:model.live="email" placeholder="Enter your Email"
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
                <input :type="showPassword ? 'text' : 'password'" wire:model.live="password"
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

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" class="h-4 w-4 text-emerald focus:ring-emerald border-gray-300 rounded">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember Me</span>
            </label>
            <a href="#" class="text-sm text-primary hover:underline">Forgot Password?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-emerald text-white py-3 rounded-full font-semibold uppercase hover:bg-emerald/90 focus:outline-none focus:ring-2 focus:ring-emerald transition">
            Login
        </button>
    </form>

    <!-- Social Login -->
    <div class="mt-6">
        <p class="text-center text-sm text-gray-600 dark:text-gray-400">or Sign up with</p>
        <div class="flex justify-center gap-4 mt-4">
            <button class="p-2 bg-darkblue text-white rounded-full hover:bg-darkblue/80">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M24 4.6c-.9.4-1.8.7-2.8.8 1-.6 1.8-1.6 2.2-2.7-.9.6-2 1-3.1 1.2-.9-1-2.2-1.6-3.6-1.6-2.7 0-4.9 2.2-4.9 4.9 0 .4 0 .8.1 1.2-4.1-.2-7.7-2.2-10.1-5.2-.4.7-.7 1.6-.7 2.5 0 1.7.9 3.2 2.2 4.1-.8 0-1.6-.2-2.2-.6v.1c0 2.4 1.7 4.4 3.9 4.8-.4.1-.8.2-1.3.2-.3 0-.6 0-.9-.1.6 1.9 2.4 3.3 4.5 3.3-1.6 1.3-3.7 2.1-5.9 2.1-.4 0-.8 0-1.2-.1 2.1 1.4 4.6 2.2 7.3 2.2 8.7 0 13.5-7.2 13.5-13.5 0-.2 0-.4-.1-.6.9-.7 1.7-1.5 2.3-2.5z" />
                </svg>
            </button>
            <button class="p-2 bg-madder text-white rounded-full hover:bg-madder/80">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M7.5 12c0-.4.1-.8.4-1.1l6.5-6.5c.3-.3.7-.4 1.1-.4.4 0 .8.1 1.1.4l1.5 1.5c.3.3.4.7.4 1.1 0 .4-.1.8-.4 1.1L13.6 12l4.5 4.5c.3.3.4.7.4 1.1 0 .4-.1.8-.4 1.1l-1.5 1.5c-.3.3-.7.4-1.1.4-.4 0-.8-.1-1.1-.4l-6.5-6.5c-.3-.3-.4-.7-.4-1.1zm9-9.5H12c-.8 0-1.5.7-1.5 1.5s.7 1.5 1.5 1.5h4.5v4.5c0 .8.7 1.5 1.5 1.5s1.5-.7 1.5-1.5V5c0-.8-.7-1.5-1.5-1.5z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Sign Up Link -->
    <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
        Don’t have an account?
        <a href="#" @click.prevent="$dispatch('open-modal', { name: 'register' })"
            class="text-primary hover:underline font-medium">
            Sign up
        </a>
    </p>
</div>