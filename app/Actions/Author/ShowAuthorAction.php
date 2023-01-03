<?php

namespace App\Actions\Author;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowAuthorAction
{
    function __invoke(Author $author): JsonResource
    {
        return new AuthorResource($author);
    }
}
