<?php

namespace App\Actions\Subscriber;

use App\Http\Resources\SubscriberResource;
use App\Models\Subscriber;
use Illuminate\Http\Resources\Json\JsonResource;

class DestroySubscriberAction
{
    function __invoke(Subscriber $subscriber): JsonResource
    {
        if($subscriber->user_id != auth()->id()) abort('403', "You can't do this");
        $subscriber->delete();
        return new SubscriberResource($subscriber);
    }
}