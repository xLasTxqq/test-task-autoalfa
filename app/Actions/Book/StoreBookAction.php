<?php

namespace App\Actions\Book;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreBookAction
{
    function __invoke(BookRequest $request): JsonResource
    {
        return new BookResource(Book::firstOrCreate($request->validated()));
    }
}
