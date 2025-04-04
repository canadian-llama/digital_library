<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class BookLibrary extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        return view('livewire.book-library', [
            'books' => Book::orderBy('book_title', 'asc')->paginate(50),
            'latests' => Book::orderBy('created_at', 'desc')->paginate(7),
        ]);
    }
}
