<?php

namespace App\Actions\Book;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class UpdateBookAction
{

    function __invoke(BookRequest $request, $id): Model
    {
        return Book::findOrFail($id)
            ->update($request->only('name', 'author_id', 'genre_id', 'publisher_id', 'status_id'));
    }
}
