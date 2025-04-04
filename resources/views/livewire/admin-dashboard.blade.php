<div x-data="{ 
    selectedTab: localStorage.getItem('selectedTab') || 'dashboard' 
}" x-init="$watch('selectedTab', value => localStorage.setItem('selectedTab', value))"
    class="flex h-screen w-screen bg-gray-100">

    <!-- Sidebar -->
    <div class="flex flex-col w-64 bg-gray-900 text-white h-full">
        <div class="flex items-center p-4">
            <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z" />
            </svg>
            <span class="ml-2 text-lg font-bold">Clouds Library</span>
        </div>

        <!-- Navigation -->
        <div class="flex flex-col flex-grow p-2 overflow-y-auto">
            <template x-for="(tab, index) in [
                { name: 'Dashboard', icon: 'home', key: 'dashboard' },
                { name: 'Upload', icon: 'upload', key: 'upload' },
                { name: 'Add User', icon: 'user-plus', key: 'add-user' },
                { name: 'View Users', icon: 'users', key: 'view-users' },
                { name: 'View Books', icon: 'book', key: 'view-books' },
                { name: 'Settings', icon: 'settings', key: 'settings' }
            ]" :key="tab.key">
                <button @click="selectedTab = tab.key" class="flex items-center px-4 py-3 rounded-md transition-all"
                    :class="selectedTab === tab.key ? 'bg-blue-600 text-white' : 'hover:bg-gray-800'">
                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="{
                            'home': 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                            'upload': 'M4 16v1a1 1 0 001 1h14a1 1 0 001-1v-1m-4-4l-4-4m0 0l-4 4m4-4v12',
                            'user-plus': 'M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z',
                            'users': 'M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z',
                            'book': 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9',
                            'settings': 'M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 10c-3.313 0-6-2.687-6-6s2.687-6 6-6 6 2.687 6 6-2.687 6-6 6z'
                        }[tab.icon]" />
                    </svg>
                    <span x-text="tab.name"></span>
                </button>
            </template>
        </div>

        <!-- Profile & Logout -->
        <div class="mt-auto p-4 border-t border-gray-800">
            <button @click="selectedTab = 'profile'" class="flex items-center w-full p-3 rounded-md hover:bg-gray-800">
                <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>{{ Auth::user()->name }}</span>
            </button>

            <form wire:submit='logout'>
                <button class="flex items-center w-full p-3 mt-2 rounded-md bg-red-600 text-white hover:bg-red-700">
                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a1 1 0 01-1 1H5a1 1 0 01-1-1V7a1 1 0 011-1h7a1 1 0 011 1v1" />
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 overflow-x-hidden overflow-y-hidden">
        <div x-show="selectedTab === 'dashboard'" x-cloak>
            <livewire:helpers.dashboard />
        </div>
        <div x-show="selectedTab === 'upload'" x-cloak>
            <livewire:create-book />
        </div>
        <div x-show="selectedTab === 'add-user'" x-cloak>
            <livewire:add-user />
        </div>
        <div x-show="selectedTab === 'view-users'" x-cloak>
            <livewire:view-user wire:key="{{ now() }}" />
        </div>
        <div x-show="selectedTab === 'view-books'" x-cloak>
            <livewire:view-book />
        </div>
        <div x-show="selectedTab === 'settings'" x-cloak>
            <livewire:helpers.settings />
        </div>
        <div x-show="selectedTab === 'profile'" x-cloak>
            <livewire:helpers.user-profile />
        </div>
    </div>
</div>