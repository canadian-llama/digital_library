<div class="flex-1 flex items-center justify-center p-6 overflow-hidden"
    x-data="{ open:false, openEditModal:false, selectedBook:null }">
    <div class="w-full max-w-6xl bg-white rounded-lg shadow-lg p-6 h-[85vh] overflow-y-auto">
        <h2 class="text-2xl font-bold text-teal-600 border-b pb-4">📖 Explore Books</h2>
        @if ($books->isEmpty())
        <span class="text-gray-800">No Books yet!</span>
        @else
        <div class="table w-full">
            <table class="w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">S/N
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book
                            Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Format</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($books as $book)
                    <tr class="bg-gray-50 hover:bg-gray-100" wire:key="{{ $book->id }}">
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $count+=1 }}</td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $book->book_title }}</td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $book->book_author }}</td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">{{ $book->book_format }}</td>
                        <td class="px-6 py-4 text-gray-800 whitespace-nowrap flex space-x-2">
                            <!-- Edit Button -->
                            @if (Auth::user()->id === $book->user_id)
                            <button @click="openEditModal = true;" wire:click="viewBook({{ $book }})"
                                class="text-gray-600 hover:text-blue-500" title="Edit Book">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 3l5 5-13 13H3v-5L16 3z"></path>
                                </svg>
                            </button>
                            @endif

                            <!-- Delete Button -->
                            <button @click="open = true; confirmAction = () => deleteItem({{ $book->id }})"
                                class="text-gray-600 hover:text-red-500" title="Delete Book">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 6h12M6 6l1 14h10l1-14"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10h6">
                                    </path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal for Delete Confirmation -->
            <div x-show="open" x-transition.opacity
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                    <h2 class="text-lg font-bold text-red-600">Warning</h2>
                    <p class="text-gray-700 mt-2">Are You sure you want to Delete this Book? This action is
                        irreversible!!</p>
                    <div class="flex justify-end mt-4 space-x-2">
                        <button @click="open = false" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">No</button>
                        <button @click="open = false" class="px-4 py-2 bg-red-600 text-white rounded-md"
                            wire:click="delete({{ $book->id }})">Yes</button>
                    </div>
                </div>
            </div>

            <!-- Edit Book Modal -->
            @if ($selectedBook)
            <div x-show="openEditModal" x-transition.opacity
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" >
                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                    <h2 class="text-lg font-bold text-blue-600">Edit Book</h2>
                    <form wire:submit.prevent="updateBook({{ $selectedBook }})">
                        <div class="mb-4">
                            <label for="title" class="block text-gray-600">Book Title</label>
                            <input type="text" id="title" class="input w-full" wire:model.defer="title"
                                placeholder="Book Title">
                        </div>
                        <div class="mb-4">
                            <label for="author" class="block text-gray-600">Author</label>
                            <input type="text" id="author" class="input w-full" wire:model.defer="author"
                                placeholder="Author">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-600">Book Description</label>
                            <input type="text" id="description" class="input w-full" wire:model.defer="description"
                                placeholder="Description">
                        </div>
                        <div class="mb-4">
                            <label for="format" class="block text-gray-600">Book Format</label>
                            <select id="format" class="input w-full" wire:model.defer="format">
                                <option value="pdf">PDF</option>
                                <option value="epub">EPUB</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="book_file" class="block text-gray-600">Upload Book File</label>
                            <input type="file" id="book_file" class="input w-full" wire:model.defer="book">
                        </div>
                        <div class="mb-4">
                            <label for="book_image" class="block text-gray-600">Book Cover Image</label>
                            <input type="file" id="book_image" class="input w-full" wire:model.defer="book_image">
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button @click="openEditModal = false" type="button"
                                class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">Cancel</button>
                            <button @click="openEditModal = false" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            {{ $books->links() }}
        </div>
        @endif
    </div>
</div>