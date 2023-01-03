<?php

namespace App\Actions\Author;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;

class DestroyAuthorAction
{
    function __invoke(Author $author): JsonResource
    {
        $author->delete();
        return new AuthorResource($author);
    }
}
