<header class="sticky top-0 z-30 w-full bg-white dark:bg-darkblue shadow-md transition-all py-3">
    <div class="px-4 max-w-screen-xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">
            Clouds Library
        </a>

        <!-- Nav Links (Desktop) -->
        <nav class="hidden md:flex items-center gap-5 text-sm font-medium text-gray-800 dark:text-gray-200">
            @auth
            <a wire:navigate href="/my-library" class="hover:text-emerald transition-colors">
                My Library
            </a>

            @if (Auth::user()->suspended == 1)
            <a wire:navigate href="/user/suspended" class="hover:text-emerald transition-colors">
                Dashboard
            </a>
            @elseif (Auth::user()->deactivated == 1)
            <a wire:navigate href="/user/deactivated" class="hover:text-emerald transition-colors">
                Dashboard
            </a>
            @else
            @can('visit_admin')
            <a wire:navigate href="/admin-dashboard" class="hover:text-emerald transition-colors">
                Dashboard
            </a>
            @endcan
            @can('visit_user')
            <a wire:navigate href="/user-dashboard" class="hover:text-emerald transition-colors">
                Dashboard
            </a>
            @endcan
            @endif


            <form wire:submit='logout' wire:confirm="Are you sure you want to logout?">
                <button class="text-madder hover:text-madder/80 transition-colors">
                    Logout
                </button>
            </form>
            @endauth

            @guest
            <div class="flex items-center gap-3">
                <a href="#"
                    class="hidden sm:inline-flex items-center justify-center rounded-lg bg-white dark:bg-secondary-100 px-3 py-2 text-sm font-semibold text-gray-800 dark:text-gray-200 shadow ring-1 ring-gray-300 dark:ring-secondary-200 hover:bg-gray-100 dark:hover:bg-secondary-200 transition"
                    x-data x-on:click="$dispatch('open-modal', { name: 'register' })">
                    Sign Up
                </a>

                <a href="#"
                    class="inline-flex items-center justify-center rounded-lg bg-emerald px-3 py-2 text-sm font-semibold text-white shadow hover:bg-emerald/90 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald"
                    x-data x-on:click="$dispatch('open-modal', { name: 'login' })">
                    Login
                </a>
            </div>
            @endguest
        </nav>
    </div>
</header>