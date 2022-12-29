<?php

namespace App\Actions\Book;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class StoreBookAction
{
    function __invoke(BookRequest $request): Model
    {
        return Book::firstOrCreate($request->only('name', 'author_id', 'genre_id', 'publisher_id'));
    }
}
