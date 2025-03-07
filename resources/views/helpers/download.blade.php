<x-layout href="{{ route('home') }}">

    <div>
        <h4>Uploaded by</h4>
        <img src="" alt="image" class="size-40 rounded-xl">
        <p><a href="{{ route('book.show',['view-profile', $book->user->id]) }}" class="btn">{{ $book->user->name }}</a></p>
    </div>

    <form action="{{ route('download', $book->id) }}" method="post">
        @csrf
        <button type="submit" class="btn">Download</button>
    </form>

</x-layout>