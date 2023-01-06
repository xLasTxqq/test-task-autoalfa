<?php

namespace App\Actions\Book;

use App\Models\Book;
use Illuminate\Http\Response;

class DestroyBookAction
{
    function __invoke(Book $book): Response
    {
        $book->delete();
        return response()->noContent();
    }
}
