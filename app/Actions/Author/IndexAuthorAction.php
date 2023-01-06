<?php

namespace App\Actions\Author;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class IndexAuthorAction
{
    function __invoke(): JsonResource
    {
        return AuthorResource::collection(Cache::rememberForever('authors', function () {
            return Author::all();
        }));
    }
}
