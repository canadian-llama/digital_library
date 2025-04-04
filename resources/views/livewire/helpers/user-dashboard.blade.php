<div class="w-full h-full bg-gray-100 dark:bg-gray-900 p-6">
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">📊 Your Dashboard</h1>
            <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                + Upload Book
            </button>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Total Uploads -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Books Uploaded</p>
                <h2 class="text-3xl font-bold dark:text-white">{{ count($uploads) }}</h2>
                <p class="text-sm text-green-600 dark:text-green-400 mt-2">+{{ $monthCount }} this week</p>
            </div>

            <!-- Total Downloads -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Downloads</p>
                <h2 class="text-3xl font-bold dark:text-white">{{ count($downloads) }}</h2>
                <p class="text-sm text-blue-600 dark:text-blue-400 mt-2">+{{ $monthCount }} this month</p>
            </div>

            <!-- Monthly Downloads -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">This Month's Downloads</p>
                <h2 class="text-3xl font-bold dark:text-white">{{ $monthCount }}</h2>
                <p class="text-sm text-green-600 dark:text-green-400 mt-2">+{{ $percentageIncrease }}% from last month
                </p>
            </div>

            <!-- Earnings -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5">
                <p class="text-sm text-gray-500 dark:text-gray-400">Earnings</p>
                <h2 class="text-3xl font-bold dark:text-white">₦0</h2>
                <p class="text-sm text-green-600 dark:text-green-400 mt-2">+₦0 this week</p>
            </div>
        </div>

        <!-- Most Downloaded Book -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5">
            <h3 class="text-xl font-semibold dark:text-white mb-4">🔥 Most Downloaded Book</h3>
            @foreach ($populars as $popular)
            @if ($popular)
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . $popular->book->display_image) }}" alt="Book Cover"
                    class="w-16 h-24 object-cover rounded" />
                <div class="dark:text-gray-300">
                    <p class="font-semibold dark:text-white">{{ $popular->book->book_title }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">by {{ ucwords($popular->book->book_author) }}
                    </p>
                    <p class="text-sm text-green-600 dark:text-green-400 mt-1">+50 downloads this month</p>
                </div>
            </div>
            @endif
            @endforeach
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