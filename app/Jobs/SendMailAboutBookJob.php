<?php

namespace App\Jobs;

use App\Mail\NotificationSubscribedBookForm;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailAboutBookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private int $book_id)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subs = Subscriber::where('book_id', $this->book_id)->with('user','book')->get()->toArray();
        foreach($subs as $sub){
            Mail::to($sub->user)->send(new NotificationSubscribedBookForm($sub->book));
            $sub->delete();
        }
    }
}
