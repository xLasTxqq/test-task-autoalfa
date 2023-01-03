<?php

namespace App\Actions\Publisher;

use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Resources\Json\JsonResource;

class DestroyPublisherAction
{
    function __invoke(Publisher $publisher): JsonResource
    {
        $publisher->delete();
        return new PublisherResource($publisher);
    }
}
