<x-layout>
    <form action="{{ route('book.edit', $book->id) }}" method="post" class="form" enctype="multipart/form-data">

        @csrf

        <h2>Edit book</h2>

        <div class="row">
            <label for="title">Book name:</label>
            <input type="text" name="title" id="title" value="{{ $book->book_title }}">

            @if ($errors->has('title'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('title') }}</p>
            @endif
        </div>

        <div class="row">
            <label for="name">description:</label>
            <textarea name="description" id="desc">{{ $book->book_description }}</textarea>
            @if ($errors->has('description'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('description') }}</p>
            @endif
        </div>

        <div class="row">
            <label for="email">genre:</label>
            <select name="genre[]" id="genre" multiple>
                <option value="action">action</option>
                <option value="adventure">adventure</option>
                <option value="fantasy">fanstasy</option>
                <option value="suspense">suspense</option>
                <option value="horror">horror</option>
            </select>
            @if ($errors->has('genre'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('genre') }}</p>
            @endif
        </div>

        <div class="row">
            <label for="author">Author:</label>
            <input type="author" name="author" id="author" value="{{ $book->book_author }}">
            @if ($errors->has('author'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('author') }}</p>
            @endif
        </div>

        <div>
            <label for="image">Image:</label>
            @if($book->display_image)
            <img src="{{ asset('storage/' . $book->display_image) }}" alt="book image" class="size-20">
            @endif
            <input type="file" name="image" id="image" value="{{ $book->display_image }}">

            @if ($errors->has('image'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('image') }}</p>
            @endif
        </div>

        <button type="submit" class="btn">Edit Book</button>

        <a href="{{ route('user.dashboard') }}" class="btn">Go back</a>
    </form>
</x-layout>