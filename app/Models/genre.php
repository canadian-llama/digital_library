<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class genre extends Model
{
    protected $fillable = [
        'book_id'
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }
    //
}
