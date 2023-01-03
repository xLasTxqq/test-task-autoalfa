<?php

namespace App\Actions\Book;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateBookAction
{

    function __invoke(BookRequest $request, Book $book): JsonResource
    {
        $book->update($request->validated());
        return new BookResource($book);
    }
}
