<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    protected $fillable = [
        'user_id',
        'follower_id',
    ];
    /** @use HasFactory<\Database\Factories\FollwersFactory> */
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
