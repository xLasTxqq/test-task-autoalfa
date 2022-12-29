<?php

namespace App\Actions\Book;

use App\Http\Requests\BookRequest;
use App\Models\Book;

class ReadBookAction
{
    function __invoke(): Array
    {
        $books = Book::with('genres','publishers','authors','action.status')->get();
        return compact('books');
    }
}
