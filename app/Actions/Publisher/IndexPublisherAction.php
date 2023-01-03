<?php

namespace App\Actions\Publisher;

use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexPublisherAction
{
    function __invoke(): JsonResource
    {
        return PublisherResource::collection(Publisher::all());
    }
}
