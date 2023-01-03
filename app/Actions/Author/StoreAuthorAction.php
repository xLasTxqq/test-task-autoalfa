<?php

namespace App\Actions\Author;

use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreAuthorAction
{
    function __invoke(AuthorRequest $request): JsonResource
    {
        return new AuthorResource(Author::firstOrCreate($request->validated()));
    }
}
