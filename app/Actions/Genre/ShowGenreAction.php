<?php

namespace App\Actions\Genre;

use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowGenreAction
{
    function __invoke(Genre $genre): JsonResource
    {
        return new GenreResource($genre);
    }
}
