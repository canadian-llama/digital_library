<div class="w-full h-full bg-gray-100 dark:bg-gray-900 p-6">
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">📊 Dashboard</h1>
            <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                + Add Book
            </button>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Card: Total Books -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Books</p>
                <h2 class="text-3xl font-bold dark:text-white">{{ count($book) }}</h2>
            </div>

            <!-- Card: Active Users -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Active Users</p>
                <h2 class="text-3xl font-bold dark:text-white">{{ count($user) }}</h2>
            </div>

            <!-- Card: Monthly Downloads -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Monthly Downloads</p>
                <h2 class="text-3xl font-bold dark:text-white">{{ count($downloads) }}</h2>
            </div>

            <!-- Card: Revenue -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Revenue</p>
                <h2 class="text-3xl font-bold dark:text-white">₦0</h2>
            </div>
        </div>

        <!-- Recent Uploads -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5">
            <h3 class="text-xl font-semibold dark:text-white mb-4">📢 Recent Uploads</h3>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($uploads as $upload)
                <li class="py-3 flex justify-between items-center dark:text-gray-300">
                    <span>📘 “{{ $upload->book->book_title }}” by {{ ucwords($upload->book->book_author) }}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400"> {{
                        $upload->book->created_at->diffForHumans() }} </span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>