<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $books = Book::orderby('created_at', 'desc')->paginate(10);

        return view('users.index', compact('books'));
    }


    public function show($var, $id)
    {
        // dd($var);
        if ($var === 'add-books') {
            return view('admin.addBooks');
        } elseif ($var === 'download') {
            $book = Book::findOrFail($id);
            return view('helpers.download', compact('book'));
        } elseif ($var === 'view-profile') {
            $user = User::findOrFail($id);
            return view('users.profile', compact('user'));
        } elseif ($var === 'view-book-details') {
            $book = Book::findOrFail($id);
            return view('helpers.bookDetails', compact('book'));
        }
    }


    public function store(Request $request)
    {

        $format = $request->input('format');

        if ($format === 'pdf') {
            $request->validate([
                'title' => 'required|string|max:50',
                'description' => 'required|string|min:1',
                'genre' => 'required|array',
                'author' => 'required|string|max:100',
                'format' => 'required|in:epub,pdf',
                'book' => 'required|file|max:100000|mimes:pdf',
                'image' => 'nullable|file|max:100000|mimes:png,jpg,webp',
            ]);


            $book_path = null;
            $image_path = null;
            $id = Auth::user()->id;

            if ($request->hasFile('book') && $request->hasFile('image')) {
                $book_path = Storage::disk('public')->put('books', $request->book);
                $image_path = Storage::disk('public')->put('book_images', $request->image);
            }

            $genreArray = $request->input('genre');
            $genre = implode(',', $genreArray);

            // dd($genre);

            Book::create([
                'book_title' => $request->input('title'),
                'book_description' => $request->input('description'),
                'book_genre' => $genre,
                'book_author' => $request->input('author'),
                'book_format' => $request->input('format'),
                'book_url' => $book_path,
                'display_image' => $image_path,
                'user_id' => $id
            ]);

            return redirect()->route('admin.show', 'all-books')->with('success', 'New Book uploaded successfully');
        }

        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|min:1',
            'genre' => 'required|array',
            'author' => 'required|string|max:100',
            'format' => 'required|in:epub,pdf',
            'book' => 'required|file|max:100000|mimes:epub',
            'image' => 'nullable|file|max:100000|mimes:png,jpg,webp',
        ]);


        $book_path = null;
        $image_path = null;
        $id = Auth::user()->id;

        if ($request->hasFile('book') && $request->hasFile('image')) {
            $book_path = Storage::disk('public')->put('books', $request->book);
            $image_path = Storage::disk('public')->put('book_images', $request->image);
        }

        $genreArray = $request->input('genre');
        $genre = implode(',', $genreArray);

        // dd($genre);

        Book::create([
            'book_title' => $request->input('title'),
            'book_description' => $request->input('description'),
            'book_genre' => $genre,
            'book_author' => $request->input('author'),
            'book_format' => $request->input('format'),
            'book_url' => $book_path,
            'display_image' => $image_path,
            'user_id' => $id
        ]);

        return redirect()->route('admin.show', 'all-books')->with('success', 'New Book uploaded successfully');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'min:3'
        ]);

        $search = $request->input('search');

        $books = Book::where('book_title', 'like', '%' . $search . '%')->get();

        // dd(gettype($search_results));

        return view('users.index', ['books' => $books, 'search' => $request->search]);
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.editBook', compact('book'));
    }

    public function update(Request $request, $id, User $user)
    {
        $book = Book::findOrFail($id);

        $valid = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|min:1',
            'genre' => 'required|array',
            'author' => 'required|string|max:100',
            'image' => 'nullable|file|max:100000|mimes:png,jpg,webp',
        ]);

        $image_path = $book->display_image ?? null;

        $genreArray = $request->input('genre');
        $genre = implode(',', $genreArray);

        if ($request->hasFile('image')) {
            if ($book->display_image) {
                Storage::disk('public')->delete($book->display_image);
            }
            $image_path = Storage::disk('public')->put('book_images', $request->image);
        }


        $book->update([
            'book_title' => $request->input('title'),
            'book_description' => $request->input('description'),
            'book_genre' => $genre,
            'book_author' => $request->input('author'),
            'display_image' => $image_path,
        ]);

        return redirect()->route('admin.show', 'all-books')->with('success', 'New Book uploaded successfully');
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);

        $img = $book->display_image;

        $book_path = $book->book_url;

        if ($img && $book_path) {
            Storage::disk('public')->delete($img);
            Storage::disk('public')->delete($book_path);
        }

        $book->delete();

        return redirect()->route('admin.show', 'all-books')->with('success', 'Book Deleted Successfully');
    }

    public function download($id)
    {
        $book = Book::findOrFail($id);


        $path = Storage::path('\public/' . $book->book_url);


        return response()->download($path);


        // return view('helpers.download');
    }

    public function favorite($userid, $bookid)
    {
        $favorite = Favorite::where(['user_id' => $userid, 'book_id' => $bookid])->get();
        // dd($favorite->isEmpty());
        if ($favorite->isEmpty()) {
            Favorite::create([
                'user_id' => $userid,
                'book_id' => $bookid
            ]);
            return redirect()->route('book.show', ['view-book-details', $bookid])->with('success', 'Favourite successful');
        }

        return redirect()->route('book.show', ['view-book-details', $bookid])->with('success', 'Already Favourite');
    }

    public function unfavorite($userid, $bookid)
    {
        $favorite = Favorite::where('user_id', $userid)->where('book_id', $bookid)->delete();
        if($favorite){
            return redirect()->route('book.show', ['view-book-details', $bookid])->with('success', 'UnFavourite successful');
        }
        return redirect()->route('book.show', ['view-book-details', $bookid])->with('success', 'Not already Favourite');
    }
}
