<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadHistory extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
    ];
    /** @use HasFactory<\Database\Factories\DownloadHistoryFactory> */
    use HasFactory;

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function book()
    {
       return $this->belongsTo(Book::class);
    }
}
