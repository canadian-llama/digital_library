<div class="w-full h-full bg-gray-100 dark:bg-gray-900" x-data="{ tab: 'all' }">
    <div class="lg:w-[70%] sm:w-[80%] w-[90%] mx-auto flex flex-col gap-4 py-10">
        <div class="w-full flex justify-between items-center pb-4">
            <h2 class="text-3xl font-semibold dark:text-white">Notifications</h2>
        </div>

        <!-- Tabs -->
        <div class="w-full flex sm:flex-row flex-col gap-4">
            <div class="sm:w-1/3 flex flex-col gap-1 px-2 dark:text-white">
                <button @click="tab = 'all'" :class="{ 'bg-white dark:bg-gray-800 font-semibold': tab === 'all' }"
                    class="w-full text-left py-2 rounded pl-4 hover:bg-white dark:hover:bg-gray-800 transition">
                    All
                </button>
                <button @click="tab = 'logs'" :class="{ 'bg-white dark:bg-gray-800 font-semibold': tab === 'logs' }"
                    class="w-full text-left py-2 rounded pl-4 hover:bg-white dark:hover:bg-gray-800 transition">
                    Logs
                </button>
                <button @click="tab = 'comments'"
                    :class="{ 'bg-white dark:bg-gray-800 font-semibold': tab === 'comments' }"
                    class="w-full text-left py-2 rounded pl-4 hover:bg-white dark:hover:bg-gray-800 transition">
                    Comments
                </button>
            </div>

            <!-- Notifications Container -->
            <div class="w-full flex flex-col gap-4 max-h-[80vh] overflow-y-auto pr-2">
                <!-- Notification Item -->
                <template x-if="tab === 'all'">
                    <div class="notification-item">
                        <!-- Profile + Info -->
                        @foreach ($notifications as $notification)
                        <div class="flex gap-2">
                            <img class="w-12 h-12 object-cover rounded-full" src="" alt="Profile" />
                            <div class="flex flex-col">
                                <div class="flex flex-col gap-2 items-center dark:text-white">
                                    <h4 class="text-lg font-semibold">{{ $notification->user->name }}</h4>
                                    <p class="text-sm">{{ $notification->message }}</p>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-300">{{ $notification->created_at }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </template>

                <template x-if="tab === 'logs'">
                    <div class="notification-item">
                        <!-- Profile + Info -->
                        @foreach ($notifications as $notification)
                        @if ($notification->type === 'login' || $notification->type === 'logout' || $notification->type
                        === 'follow' || $notification->type === 'favorite' || $notification->type === 'account_update')
                        <div class="flex gap-2">
                            <img class="w-12 h-12 object-cover rounded-full" src="" alt="Profile" />
                            <div class="flex flex-col">
                                <div class="flex flex-col gap-2 items-center dark:text-white">
                                    <h4 class="text-lg font-semibold">{{ $notification->user->name }}</h4>
                                    <p class="text-sm">{{ $notification->message }}</p>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-300">{{ $notification->created_at }}</p>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </template>

                <template x-if="tab === 'comments'">
                    <div class="notification-item">
                        <!-- Profile + Info -->
                        @foreach ($notifications as $notification)
                        @if ($notification->type === 'comment')
                        <div class="flex gap-2">
                            <img class="w-12 h-12 object-cover rounded-full" src="" alt="Profile" />
                            <div class="flex flex-col">
                                <div class="flex flex-col gap-2 items-center dark:text-white">
                                    <h4 class="text-lg font-semibold">{{ $notification->user->name }}</h4>
                                    <p class="text-sm">{{ $notification->message }}</p>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-300">{{ $notification->created_at }}</p>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>