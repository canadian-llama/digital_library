<?php

namespace App\Listeners;

use App\Events\FavouriteSystem;
use App\Models\Favorite;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        if($event->var === 'favorite'){
            $favorite = Favorite::where(['user_id' => $event->userid, 'book_id' => $event->bookid])->get();
            if ($favorite->isEmpty()) {
                Favorite::create([
                    'user_id' => $event->userid,
                    'book_id' => $event->bookid,
                ]);
            }
        }else{
            Favorite::where(['user_id' => $event->userid, 'book_id' => $event->bookid])->delete();
        }
    }
}
