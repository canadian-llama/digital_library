<x-layout>
    <form action="{{ route('storeBooks') }}" method="post" class="form" enctype="multipart/form-data">

        @csrf

        <h2>Add new book</h2>

        <div class="row">
            <label for="title">Book name:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">

            @if ($errors->has('title'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('title') }}</p>
            @endif
        </div>

        <div class="row">
            <label for="name">description:</label>
            <textarea name="description" id="desc"></textarea>
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
            <input type="author" name="author" id="author">
            @if ($errors->has('author'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('author') }}</p>
            @endif
        </div>

        <div class="row">
            <label for="format">format:</label>
            <select name="format" id="format">
                <option value="pdf">pdf</option>
                <option value="epub">epub</option>
            </select>
            @if ($errors->has('format'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('format') }}</p>
            @endif
        </div>


        <div>
            <label for="book">Book:</label>
            <input type="file" name="book" id="book">
            @if ($errors->has('book'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('book') }}</p>
            @endif
        </div>

        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
            @if ($errors->has('image'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('image') }}</p>
            @endif
        </div>

        <button type="submit" class="btn">Add Book</button>

        <a href="{{ route('user.dashboard') }}" class="btn">Go back</a>
    </form>
</x-layout>