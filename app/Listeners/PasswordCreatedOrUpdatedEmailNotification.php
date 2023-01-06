<?php

namespace App\Listeners;

use App\Events\PasswordCreatedOrUpdatedEvent;
use App\Jobs\SendMailAboutPasswordJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordCreatedOrUpdatedEmailNotification implements ShouldQueue
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
    public function handle(PasswordCreatedOrUpdatedEvent $event)
    {
        dispatch(new SendMailAboutPasswordJob($event->password, $event->user));
    }
}
