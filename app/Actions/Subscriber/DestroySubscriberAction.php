<?php

namespace App\Actions\Subscriber;

use App\Models\Subscriber;
use Illuminate\Http\Response;

class DestroySubscriberAction
{
    function __invoke(Subscriber $subscriber): Response
    {
        abort_if($subscriber->user_id != auth()->id(), '403', "You can't do this");
        $subscriber->delete();
        return response()->noContent();
    }
}