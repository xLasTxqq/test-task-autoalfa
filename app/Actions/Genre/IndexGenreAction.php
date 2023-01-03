<?php

namespace App\Actions\Genre;

use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexGenreAction
{
    function __invoke(): JsonResource
    {
        return GenreResource::collection(Genre::all());
    }
}
