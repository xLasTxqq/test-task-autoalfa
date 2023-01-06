<?php

namespace App\Actions\Subscriber;

use App\Http\Requests\SubscriberRequest;
use App\Http\Resources\SubscriberResource;
use App\Models\Subscriber;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreSubscriberAction
{
    function __invoke(SubscriberRequest $request): JsonResource
    {
        return new SubscriberResource(Subscriber::firstOrCreate([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id 
        ]));
    }
}
