<div class="max-w-5xl mx-auto mt-8 px-4 h-[90vh] flex flex-col" x-data="{ showPassword: false, isSaving: false }"
    @save-complete.window="isSaving = false">

    <!-- Book Upload Box -->
    <div class="bg-snow border border-gray-300 rounded-lg shadow-lg flex-1 overflow-hidden flex flex-col">

        <!-- Scrollable Content -->
        <div class="overflow-y-auto flex-1 p-6 sm:p-8">
            <form wire:submit.prevent="save" class="space-y-6" @submit="isSaving = true">
                <h2 class="text-2xl font-bold text-madder border-b pb-4">📚 Upload a New Book</h2>

                <!-- Book Title -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1">Book Title</label>
                    <input type="text" placeholder="Enter book title..."
                        class="w-full border text-gray-900 placeholder-gray-500 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-skyline transition-shadow"
                        wire:model="title">
                    @error('title') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
                </div>

                <!-- Book Description -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1">Book Description</label>
                    <textarea placeholder="Write a brief description..."
                        class="w-full border text-gray-900 placeholder-gray-500 border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-skyline resize-none min-h-[150px] h-40 transition-shadow"
                        wire:model="description"></textarea>
                    @error('description') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
                </div>

                <!-- Book Genre -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1">Book Genre</label>
                    <select name="genre[]" multiple
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-skyline bg-white text-gray-900 transition-shadow"
                        wire:model="genre">
                        <option value="action">Action</option>
                        <option value="adventure">Adventure</option>
                        <option value="comedy">Comedy</option>
                        <option value="drama">Drama</option>
                        <option value="fantasy">Fantasy</option>
                        <option value="horror">Horror</option>
                        <option value="mystery">Mystery</option>
                        <option value="romance">Romance</option>
                        <option value="science-fiction">Sci-Fiction</option>
                        <option value="suspense">Suspense</option>
                        <option value="thriller">Thriller</option>
                    </select>
                    @error('genre') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
                </div>

                <!-- Book Author -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1">Book Author</label>
                    <input type="text" placeholder="Author's name..."
                        class="w-full text-gray-900 placeholder-gray-500 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-skyline transition-shadow"
                        wire:model="author">
                    @error('author') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
                </div>

                <!-- Book Format -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1">Book Format</label>
                    <select name="format"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-skyline bg-white text-gray-900 transition-shadow"
                        wire:model="format">
                        <option value="">Choose Format</option>
                        <option value="pdf">PDF</option>
                        <option value="epub">EPUB</option>
                    </select>
                    @error('format') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
                </div>

                <!-- Book File -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1">Upload Book File</label>
                    <input type="file"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-skyline file:text-white hover:file:bg-madder transition-shadow"
                        wire:model="book">
                    @error('book') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
                </div>

                <!-- Book Cover Image -->
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1">Book Cover Image</label>
                    <input type="file"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-skyline file:text-white hover:file:bg-madder transition-shadow"
                        wire:model="book_image">
                    @error('book_image') <span class="text-sm text-red-600 italic">{{ $message }}</span> @enderror
                </div>

                <!-- General Errors -->
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-madder hover:bg-skyline text-white py-2 px-4 rounded-lg font-medium transition duration-200 flex items-center justify-center relative">
                        <svg wire:loading wire:target="save"
                            class="animate-spin h-5 w-5 mr-2 text-white absolute left-4 top-1/2 transform -translate-y-1/2"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="save">Save Book</span>
                        <span wire:loading wire:target="save">Saving...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>