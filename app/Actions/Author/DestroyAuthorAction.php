<?php

namespace App\Actions\Author;

use App\Models\Author;
use Illuminate\Http\Response;

class DestroyAuthorAction
{
    function __invoke(Author $author): Response
    {
        $author->delete();
        return response()->noContent();
    }
}
