<?php

namespace App\Listeners;

use App\Events\FavouriteSystem;
use App\Models\Favorite;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Masmerise\Toaster\Toaster;

class UpdateFavoriteDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FavouriteSystem $event): void
    {
        // dd($event->var);
            $favorite = Favorite::where(['user_id' => $event->userid, 'book_id' => $event->bookid])->get();
            if ($favorite->isEmpty()) {
                Favorite::create([
                    'user_id' => $event->userid,
                    'book_id' => $event->bookid,
                ]);
            Toaster::success('Book added to favorites');
            }else{
            Favorite::where(['user_id' => $event->userid, 'book_id' => $event->bookid])->delete();
            Toaster::success('Book removed from favorites');
        }
    }
}
