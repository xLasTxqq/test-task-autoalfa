<?php

namespace App\Listeners;

use App\Events\PasswordIsReady;
use App\Jobs\SendMailAboutPasswordJob;
use App\Mail\NotificationPasswordForm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PasswordChangedOrUserCreated implements ShouldQueue
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
    public function handle(PasswordIsReady $event)
    {
        dispatch(new SendMailAboutPasswordJob($event->password,$event->user));
    }
}
