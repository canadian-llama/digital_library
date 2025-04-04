<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'user_id',
        'theme',
        'font',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
