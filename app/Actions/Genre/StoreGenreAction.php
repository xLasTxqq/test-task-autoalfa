<?php

namespace App\Actions\Genre;

use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreGenreAction
{
    function __invoke(GenreRequest $request): JsonResource
    {
        return new GenreResource(Genre::firstOrCreate($request->validated()));
    }
}
