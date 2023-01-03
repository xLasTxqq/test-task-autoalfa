<?php

namespace App\Actions\Book;

use App\Http\Resources\BookResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowBookAction
{
    function __invoke($book): JsonResource
    {
        return new BookResource($book);
    }
}
