<?php

namespace App\Observers;

use App\Models\Genre;
use Illuminate\Support\Facades\Cache;

class GenreObserver
{
    /**
     * Handle the Genre "created" event.
     *
     * @param  \App\Models\Genre  $genre
     * @return void
     */
    public function created(Genre $genre)
    {
        Cache::delete('genres');
    }

    /**
     * Handle the Genre "updated" event.
     *
     * @param  \App\Models\Genre  $genre
     * @return void
     */
    public function updated(Genre $genre)
    {
        Cache::delete('genres'); 
    }

    /**
     * Handle the Genre "deleted" event.
     *
     * @param  \App\Models\Genre  $genre
     * @return void
     */
    public function deleted(Genre $genre)
    {
        Cache::delete('genres');
    }

    /**
     * Handle the Genre "restored" event.
     *
     * @param  \App\Models\Genre  $genre
     * @return void
     */
    public function restored(Genre $genre)
    {
        Cache::delete('genres');
    }

    /**
     * Handle the Genre "force deleted" event.
     *
     * @param  \App\Models\Genre  $genre
     * @return void
     */
    public function forceDeleted(Genre $genre)
    {
        Cache::delete('genres');
    }
}
