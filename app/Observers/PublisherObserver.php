<?php

namespace App\Observers;

use App\Models\Publisher;
use Illuminate\Support\Facades\Cache;

class PublisherObserver
{
    /**
     * Handle the Publisher "created" event.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return void
     */
    public function created(Publisher $publisher)
    {
        Cache::delete('publishers');
    }

    /**
     * Handle the Publisher "updated" event.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return void
     */
    public function updated(Publisher $publisher)
    {
        Cache::delete('publishers');
    } 

    /**
     * Handle the Publisher "deleted" event.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return void
     */
    public function deleted(Publisher $publisher)
    {
        Cache::delete('publishers');
    }

    /**
     * Handle the Publisher "restored" event.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return void
     */
    public function restored(Publisher $publisher)
    {
        Cache::delete('publishers');
    }

    /**
     * Handle the Publisher "force deleted" event.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return void
     */
    public function forceDeleted(Publisher $publisher)
    {
        Cache::delete('publishers');
    }
}
