<x-layout href="{{ route('home') }}">
    <x-book>
        <h2>{{ $book->book_title }}</h2>
        <form action="{{ route('book.favorite', ['favorite',Auth::user()->id, $book->id]) }}" method="post">
            @csrf
            <button type="submit" class="btn">Favourite</button>
        </form>
        <form action="{{ route('book.favorite', ['unfavorite',Auth::user()->id, $book->id]) }}" method="post">
            @csrf
            <button type="submit" class="btn">UnFavorite</button>
        </form>
    </x-book>
    <div>
        <h4>Uploaded by</h4>
        <img src="" alt="image" class="size-40 rounded-xl">
        <p><a href="{{ route('book.show',['view-profile', $book->user->id]) }}" class="btn">{{ $book->user->name }}</a></p>
    </div>

    <form action="{{ route('download', $book->id) }}" method="post">
        @csrf
        <button type="submit" class="btn">Download</button>
    </form>

    <a href="{{ route('home') }}" class="btn">Go back</a>

</x-layout>