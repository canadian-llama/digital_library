<div>
    <section class="w-[800px] rounded-lg border-2 border-purple-600 p-4 my-8 mx-auto max-w-xl">
        <h3 class="font-os text-lg font-bold">Comments</h3>

        <!-- Sample Comment 2 -->
        <div class="flex mt-4">
            <div class="w-14 h-14 rounded-full bg-purple-400/50 flex-shrink-0 flex items-center justify-center">
                <img class="h-12 w-12 rounded-full object-cover" src="https://randomuser.me/api/portraits/women/43.jpg"
                    alt="">
            </div>
            <div class="ml-3">
                @foreach ($book->comments as $comment)
                <div class="border-t border-gray-700 pt-4">
                    <div class="text-purple-300 font-semibold">{{ $comment->username ?? 'Commenter' }}</div>
                    <div class="text-gray-500 text-xs mb-2">Posted on {{ $comment->created_at->format('M d, Y') }}</div>
                    <p class="text-gray-300">{{ $comment->comment }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <form class="mt-4" wire:submit='comment({{ $book->id }})'>
            <div class="mb-4">
                <label for="comment" class="block text-purple-800 font-medium">Comment</label>
                <textarea name="message"
                    class="border-2 border-purple-600 p-2 w-full rounded resize-none" wire:model.live.debounce.100ms='message'></textarea>
                @error('comment')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <button
                class="bg-purple-700 text-white font-medium py-2 px-4 rounded hover:bg-purple-600">Post
                Comment
            </button>
        </form>
    </section>
</div>