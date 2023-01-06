<?php

namespace App\Observers;

use App\Models\Author;
use Illuminate\Support\Facades\Cache;

class AuthorObserver
{
    /**
     * Handle the Author "created" event.
     *
     * @param  \App\Models\Author  $author
     * @return void
     */
    public function created(Author $author)
    {
        Cache::delete('authors');
    }

    /**
     * Handle the Author "updated" event.
     *
     * @param  \App\Models\Author  $author
     * @return void
     */
    public function updated(Author $author)
    {
        Cache::delete('authors');
    }

    /**
     * Handle the Author "deleted" event.
     *
     * @param  \App\Models\Author  $author
     * @return void
     */
    public function deleted(Author $author)
    {
        Cache::delete('authors');
    }

    /**
     * Handle the Author "restored" event.
     *
     * @param  \App\Models\Author  $author
     * @return void
     */
    public function restored(Author $author)
    {
        Cache::delete('authors');
    }

    /**
     * Handle the Author "force deleted" event.
     *
     * @param  \App\Models\Author  $author
     * @return void
     */
    public function forceDeleted(Author $author)
    {
        Cache::delete('authors');
    }
}
