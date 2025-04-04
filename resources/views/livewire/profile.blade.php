<div class="bg-gray-900 text-white min-h-screen flex flex-col items-center py-10 px-4"
    x-data="{ showModal: false, showModal2:false}">

    <!-- Profile Card -->
    <div class="bg-gray-800 rounded-2xl shadow-lg w-full max-w-3xl p-6 relative">
        @if($user->id === Auth::user()->id)
        @if (Auth::user()->role !== 'admin')
        <a wire:navigate href="/user-dashboard"
            class="absolute top-4 right-4 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            Edit Profile
        </a>
        @else
        <a wire:navigate href="/admin-dashboard"
            class="absolute top-4 right-4 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            Edit Profile
        </a>
        @endif
        @endif

        <div class="flex flex-col md:flex-row items-center gap-6">
            <img src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : '/default-avatar.png' }}"
                alt="Profile Image" class="w-32 h-32 rounded-full object-cover border-4 border-purple-500 shadow-md">

            <div class="text-center md:text-left space-y-2">
                <h2 class="text-3xl font-bold text-white">{{ $user->name }}</h2>
                <div class="flex gap-6 justify-center md:justify-start text-purple-400 text-sm">
                    <a href="#" @click="showModal = true;" class="hover:underline hover:text-purple-300 transition">
                        Followers: {{ $user->followed }}
                    </a>
                    <a href="#" @click="showModal2 = true;" class="hover:underline hover:text-purple-300 transition">
                        Following: {{ $user->following }}
                    </a>
                </div>

                @if($user->id !== Auth::user()->id)
                <div class="mt-4">
                    @if(!$followed->isEmpty())
                    <form wire:submit='follow({{ $user->id }}, {{ Auth::user()->id}} )'>
                        <button
                            class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-lg transition font-semibold">
                            Unfollow
                        </button>
                    </form>
                    @else
                    <form wire:submit='follow({{ $user->id }}, {{ Auth::user()->id}} )'>
                        <button
                            class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg transition font-semibold">
                            Follow
                        </button>
                    </form>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Uploaded Books Section -->
    <div class="w-full max-w-3xl mt-10">
        <h3 class="text-xl font-bold mb-4 border-b border-gray-700 pb-2">Uploaded Books</h3>

        @if($user->books->isEmpty())
        <p class="text-gray-400">No books uploaded yet.</p>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($user->books as $book)
            <div class="bg-gray-800 p-4 rounded-lg shadow hover:shadow-lg transition">
                <img src="{{ asset('storage/'.$book->display_image) }}" alt="{{ $book->book_title }}"
                    class="h-40 w-full object-cover rounded mb-3">
                <h4 class="text-lg font-semibold text-white truncate">{{ $book->book_title }}</h4>
                <p class="text-purple-400 text-sm italic mt-1">by {{ $book->book_author }}</p>
                <a wire:navigate href="/book-details/{{ $book->id }}"
                    class="inline-block mt-3 text-blue-500 hover:text-blue-400 text-sm font-medium">
                    View Details →
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <div x-show="showModal2" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        @click="showModal2 = false;">
        <livewire:helpers.followings-view id="{{ $user->id }}">
    </div>

    <div x-show="showModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        @click="showModal = false;">
        <livewire:helpers.followers-view id="{{ $user->id }}">
    </div>
</div>
