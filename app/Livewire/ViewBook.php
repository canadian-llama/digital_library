<?php

namespace App\Livewire;

use App\Models\Book;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class ViewBook extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $count = 0;
    public $query = '';

    public $title;
    public $author;
    public $description;
    public $format;
    public $book;
    public $bookPath;
    public $book_image;

    public $userBooks;

    public $user;

    public Book $selectedBook;

    public function mount(){
        $this->user = Auth::user();
        // $this->userBooks =;
        // dd();
        
    }

    private function updateBookImage(Book $book)
    {
        if (!$this->book_image) return $book->display_image;

        try {
            return Storage::disk('public')->put('book_images', $this->book_image);
        } catch (Exception $e) {
            Log::error('Book Image Upload Failed:' . $e->getMessage());
            return null;
        }
    }

    private function updateBookUrl(Book $book)
    {
        if (!$this->book) return $book->book_url;

        try {
            if (!$this->book instanceof TemporaryUploadedFile) {
                throw new  Exception('Book File is not ready or Invalid.');
            }
            return Storage::disk('public')->put('books', $this->book);
        } catch (Exception $e) {
            Log::error('Book File Upload Failed:' . $e->getMessage());
            return null;
        }
    }

    private function validator()
    {
        $rules = [
            'title' => 'required|string',
            'description' => 'required|min:10',
            'format' => 'required|string',
            'author' => 'required|string',
            'book' => 'nullable|file|max:100000|mimes:pdf,epub',
            'book_image' => 'nullable|file|max:100000|mimes:png,jpg,webp',
        ];

        if ($this->format === 'pdf') {
            $rules['book'] = 'nullable|file|max:100000|mimes:pdf';
        } elseif ($this->format === 'epub') {
            $rules['book'] = 'nullable|file|max:100000|mimes:epub';
        }
        $this->validate($rules);
    }

    public function viewBook(Book $book)
    {
        $this->selectedBook = $book;
        $this->title = $book->book_title;
        $this->author = $book->book_author;
        $this->description = $book->book_description;
        $this->format = $book->book_format;
        // $this->dispatch('open-modal', name: 'viewBook');
    }

    public function updateBook(Book $book)
    {
        $this->validator();

        $book_path = $this->updateBookUrl($book);
        $image_path = $this->updateBookImage($book) ?? null;

        $book->update([
            'book_title' => $this->title,
            'book_author' => strtolower($this->author),
            'book_description' => $this->description,
            'book_format' => $this->format,
            'book_url' => $book_path,
            'display_image' => $image_path
        ]);

        $this->reset(['book', 'book_image']);

        $this->dispatch('close-modal', name:'viewBook');
        Toaster::success('Updated');

    }

    public function delete(Book $book){
        $book->delete();
        Toaster::success('Deletion successful');
    }


    public function render()
    {
        if (Auth::user()->role !== 'admin') {
            return view('livewire.view-book', [
                'books' => Book::where('user_id', $this->user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10),
            ]);
        }
        return view('livewire.view-book', [
            'books' => Book::orderby('created_at', 'desc')->paginate(10),
        ]);
    }
}
