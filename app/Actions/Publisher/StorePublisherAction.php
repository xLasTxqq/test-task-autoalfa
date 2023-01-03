<?php

namespace App\Actions\Publisher;

use App\Http\Requests\PublisherRequest;
use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Resources\Json\JsonResource;

class StorePublisherAction
{
    function __invoke(PublisherRequest $request): JsonResource
    {
        return new PublisherResource(Publisher::firstOrCreate($request->validated()));
    }
}
