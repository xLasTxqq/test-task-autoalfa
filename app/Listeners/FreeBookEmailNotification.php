<?php

namespace App\Listeners;

use App\Events\BookIsFree;
use App\Jobs\SendMailAboutBookJob;
use App\Mail\NotificationSubscribedBookForm;
use App\Models\Subscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class FreeBookEmailNotification implements ShouldQueue
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
    public function handle(BookIsFree $event)
    {
        dispatch(new SendMailAboutBookJob($event->book_id));
    }
}
