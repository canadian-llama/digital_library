<?php

namespace App\Livewire;

use App\Events\NotificationSystem;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class CommentSection extends Component
{
    #[Validate('required|string|max:200')]
    public $message;

    public $book;

    public function mount($id)
    {
        $this->book = Book::findOrFail($id);
    }

    public function comment($bookid)
    {
        $userid = Auth::user()->id;
        $username = Auth::user()->username;

        $this->validate();

        Comment::create([
            'user_id' => $userid,
            'book_id' => $bookid,
            'username' => $username,
            'comment' => $this->message
        ]);
        event(new NotificationSystem('You commented on book', Auth::user()->id, 'comment'));
        Toaster::success('Comment Successful');
        return $this->redirect('/book-details/' . $bookid, navigate: true); 
    }

    public function render()
    {
        return view('livewire.comment-section');
    }
}
