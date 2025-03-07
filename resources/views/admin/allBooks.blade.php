<x-layout>
    <p>All Books</p>

    @if ($books->isEmpty())

    <p>No Book yet</p>

    @else
    <table class="container">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Book name</th>
                <th>Image</th>
                <th>actions</th>
            </tr>
        </thead>
        @foreach($books as $book)
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $book->book_title }}</td>
                @if ($book->display_image)
                <td>
                    <img src="{{ asset('storage/'. $book->display_image) }}" alt="book" class="size-16">
                </td>
                @endif
                <td>
                    <div class="row">
                        <a href="{{ route('book.showEdit', $book->id) }}" class="btn">Edit</a>

                        <form action="{{ route('book.delete', $book->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn" onclick="return confirm('Are u sure you want to delete book?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    @endforeach
    @endif

    <a href="{{ route('user.dashboard') }}" class="btn">Go back</a>
</x-layout>