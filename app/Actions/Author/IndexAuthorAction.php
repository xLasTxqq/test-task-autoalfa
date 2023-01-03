<?php

namespace App\Actions\Author;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexAuthorAction
{
    function __invoke(): JsonResource
    {
        return AuthorResource::collection(Author::all());
    }
}
