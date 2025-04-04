<?php

namespace App\Livewire\Helpers;

use App\Events\FavouriteSystem;
use App\Events\NotificationSystem;
use App\Models\Book;
use App\Models\DownloadHistory;
use App\Models\Favorite;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class BookDetails extends Component
{
    public $book;
    public $pdfBook;
    public $epubBook;
    public $username;
    public $genres;
    public $fave;

    public function mount($id)
    {
        $this->book = Book::findOrFail($id);
        $this->pdfBook = Book::where('book_title', $this->book->book_title)
            ->where('book_format', 'pdf')->first();
        $this->epubBook = Book::where('book_title', $this->book->book_title)
            ->where('book_format', 'epub')->first();
        $this->username = $this->book->user->username;
        $this->genres = explode(',', $this->book->book_genre);
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

    public function download($format)
    {
        $bookToDownload = $format === 'pdf' ? $this->pdfBook : $this->epubBook;

        if (!$bookToDownload) {
            Toaster::error('Book File not found');
            return;
        }

        $path = Storage::path('\public/' . $bookToDownload->book_url);

        return response()->download($path, $bookToDownload->book_title . '.' . $bookToDownload->book_format);

        if (Auth::user()) {
            $userid = Auth::user()->id;
            $bookid = $book->id;
            $user = User::findOrFail($userid);
            DownloadHistory::create([
                'user_id' => $userid,
                'book_id' => $bookid
            ]);

            $user->update([
                'downloads' => count($user->DownloadHistories)
            ]);
        }
    }

    #[Layout('components.layouts.headerless')]
    public function render()
    {
        return view('livewire.helpers.book-details', []);
    }
}
