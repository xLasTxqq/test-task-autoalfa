<?php

namespace App\Actions\Genre;

use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Resources\Json\JsonResource;

class DestroyGenreAction
{
    function __invoke(Genre $genre): JsonResource
    {
        $genre->delete();
        return new GenreResource($genre);
    }
}
