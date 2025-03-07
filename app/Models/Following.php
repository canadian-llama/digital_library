<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $fillable = [
        'user_id',
        'following_id',
    ];
    /** @use HasFactory<\Database\Factories\FollwersFactory> */
    use HasFactory;

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
