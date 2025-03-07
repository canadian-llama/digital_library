<x-layout href="{{ route('landing') }}">
    <h2>User's Dashboard</h2>
    <div class="flex flex-auto flex-row py-2 px-2 mx-2">
        <form action="{{ route('book.search') }}">
            <input type="text" name="search" id="search" value="{{ @$search }}">
            <button type="submit" class="btn">Search</button>
            @if($errors->has('search'))
            <p class="text-xs italic text-red-700">{{ $errors->first('search') }}</p>
            @endif
        </form>
    </div>

    @if ($books->isEmpty())
    <p>No Book Found</p>
    @else
    @foreach($books as $book)
    <x-card src="{{ $book->display_image ? asset('storage/'. $book->display_image) : asset('storage/default.png') }}" href="{{ route('book.show', ['view-book-details',$book->id]) }}">
        <p>{{ $book->book_title }}</p>
    </x-card>
    @endforeach
    @endif
</x-layout>