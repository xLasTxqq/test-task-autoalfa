<?php

namespace App\Actions\Book;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

class DestroyBookAction
{
    function __invoke(Book $book): JsonResource
    {
        $book->delete();
        return new BookResource($book);
    }
}
