<?php

namespace App\Livewire;

use App\Events\FavouriteSystem;
use App\Events\NotificationSystem;
use App\Models\Book;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class Card extends Component
{
    public $book;
    public $key;
    public $title;
    public $author;
    public $rating = null;
    public $fave;

    public function mount($id){
        $this->book = Book::findOrFail($id);
        // dd($this->book);
        $this->title = $this->book->book_title;
        $this->author = $this->book->book_author;
        $this->key = $this->book->id;
        if (Auth::user()) {
            $this->fave = Favorite::where('book_id', $this->book->id)->where('user_id', Auth::user()->id)->get();
        }
    }

    public function favorite($var, $bookid)
    {
        $userid = Auth::user()->id;

        $favorite = Favorite::where('user_id', $userid)->get();
        if ($favorite->isEmpty()) {
            event(new FavouriteSystem($var, $userid, $bookid));
            event(new NotificationSystem('You Favorite a book', Auth::user()->id, 'favorite'));
            Toaster::success('Book added to favorites');
            return $this->redirect('/book-details/' . $bookid, navigate: true);
        } else {
            event(new FavouriteSystem($var, $userid, $bookid));
            event(new NotificationSystem('You UnFavorite a book', Auth::user()->id, 'favorite'));
            Toaster::success('Book removed from favorites');
            return $this->redirect('/book-details/' . $bookid, navigate: true);
        }
    }


    public function render()
    {
        return view('livewire.card');
    }
}
