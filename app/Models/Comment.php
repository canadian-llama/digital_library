<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'username',
        'comment'
    ];
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    public function user(){
        $this->belongsTo(User::class);
    }

    public function book()
    {
        $this->belongsTo(Book::class);
    }
}
