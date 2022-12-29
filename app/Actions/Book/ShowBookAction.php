<?php

namespace App\Actions\Book;

use App\Http\Requests\BookRequest;
use App\Models\Book;

class ShowBookAction
{
    function __invoke($id): Array
    {
        $book = Book::with(['comments'=>fn($query)=>$query->with('user')->orderBy('id', 'desc'),'genres','authors','publishers', 
        'grades'=>fn($query)=>$query->where('user_id',auth()->id())])->withAvg('grades','stars')->findOrFail($id);
        return compact('book');
    }
}
