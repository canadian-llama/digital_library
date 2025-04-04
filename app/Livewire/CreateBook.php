<?php

namespace App\Livewire;

use App\Events\FollowSystem;
use App\Models\Author;
use App\Models\Book;
use App\Models\UploadHistory;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class CreateBook extends Component
{
    use WithFileUploads;
    public $title;

    public $description;

    public $genre;

    public $author;

    public $format;

    public $book;

    public $book_image;

    private function validator(){
        $rules = [
            'title' => 'required|string|max:50',
            'description' => 'required|string|min:1',
            'genre' => 'required|array',
            'author' => 'required|string|max:100',
            'format' => 'required|in:epub,pdf',
            'book' => 'required|file|max:100000|mimes:pdf,epub',
            'book_image' => 'nullable|file|max:100000|mimes:png,jpg,webp',
        ];

        if($this->format === 'pdf'){
            $rules['book'] = 'required|file|max:100000|mimes:pdf';
        }elseif($this->format === 'epub') {
            $rules['book'] = 'required|file|max:100000|mimes:epub';
        }

        $this->validate($rules);
    }

    private function uploadBookImage() {
        if(!$this->book_image) return null;

        try{
            return Storage::disk('public')->put('book_images', $this->book_image);
        }catch(Exception $e){
            Log::error('Book Image Upload Failed:' .$e->getMessage());
            return null;
        }

    }

    private function uploadBook() {
        try{
            if(!$this->book instanceof TemporaryUploadedFile){
                throw new  Exception('Book File is not ready or Invalid.');
            }else{
                if($this->format === 'epub'){
                    return Storage::disk('public')->put('epub_books', $this->book);
                }
                return Storage::disk('public')->put('pdf_books', $this->book);
            }
        }catch(Exception $e){
            Log::error('Book File Upload Failed:' . $e->getMessage());
            return null;
        }
    }


    public function save()
    {   
        $user = User::findOrFail(Auth::user()->id);
        $this->validator();

        $book_path = $this->uploadBook();

        if(!$book_path){
            Toaster::error('Book Upload Failed! Try Again!');
            return;
        }

        $image_path = $this->uploadBookImage();

        $genre = implode(',', $this->genre);

        $book = Book::create([
            'book_title' => $this->title,
            'book_description' => $this->description,
            'book_genre' => $genre,
            'book_author' => strtolower($this->author),
            'book_format' => $this->format,
            'book_url' => $book_path,
            'display_image' => $image_path,
            'user_id' => $user->id,
        ]);

        UploadHistory::create([
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);

        $user->update([
            'uploads' => $user->Uploads->count()
        ]);

        Toaster::success('Book Saved Successfully');

        $this->emit('$refresh');

        $this->reset(['title', 'description', 'author', 'genre', 'format', 'book', 'book_image']);
    }

    public function render()
    {
        return view('livewire.create-book');
    }
}
