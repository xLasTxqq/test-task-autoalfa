<?php

namespace App\Actions\Genre;

use App\Models\Genre;
use Illuminate\Http\Response;

class DestroyGenreAction
{
    function __invoke(Genre $genre): Response
    {
        $genre->delete();
        return response()->noContent();
    }
}
