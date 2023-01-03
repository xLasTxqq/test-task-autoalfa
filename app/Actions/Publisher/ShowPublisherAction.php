<?php

namespace App\Actions\Publisher;

use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPublisherAction
{
    function __invoke(Publisher $publisher): JsonResource
    {
        return new PublisherResource($publisher);
    }
}
