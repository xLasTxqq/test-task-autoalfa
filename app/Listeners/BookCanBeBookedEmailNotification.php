<?php

namespace App\Listeners;

use App\Events\BookCanBeBookedEvent;
use App\Jobs\SendMailAboutBookJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookCanBeBookedEmailNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BookCanBeBookedEvent $event)
    {
        dispatch(new SendMailAboutBookJob($event->action->book_id));
    }
}
