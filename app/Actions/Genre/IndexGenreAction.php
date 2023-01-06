<?php

namespace App\Actions\Genre;

use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class IndexGenreAction
{
    function __invoke(): JsonResource
    {
        return GenreResource::collection(Cache::rememberForever('genres', function () {
            return Genre::all();
        }));
    }
}
