<?php

namespace App\Actions\Publisher;

use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class IndexPublisherAction
{
    function __invoke(): JsonResource
    {
        return PublisherResource::collection(Cache::rememberForever('publishers', function () {
            return Publisher::all();
        }));
    }
}
