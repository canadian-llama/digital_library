<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail,CanResetPassword
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
        'followed',
        'following',
        'uploads',
        'downloads',
        'comments',
        'bio',
        'profile_image',
        'suspended',
        'deactivated',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function favourites(){
        return $this->hasMany(Favorite::class);
    }

    public function followers()
    {
        return $this->hasMany(Followers::class);
    }

    public function followings()
    {
        return $this->hasMany(Following::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function Uploads()
    {
        return $this->hasMany(UploadHistory::class);
    }

    public function DownloadHistories()
    {
        return $this->hasMany(DownloadHistory::class);
    }

    public function notifications(){
        return $this->hasMany(Notifications::class);
    }

    public function setting(){
        return $this->hasOne(Setting::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
