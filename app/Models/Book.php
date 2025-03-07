<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'book_title',
        'book_description',
        'book_genre',
        'book_author',
        'book_format',
        'book_url',
        'display_image',
        'user_id'
    ];
    
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favorite::class);
    }
}
