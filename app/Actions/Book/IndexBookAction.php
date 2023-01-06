<?php

namespace App\Actions\Book;

use App\Http\Resources\BookCollection;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexBookAction
{
    public function __invoke(): JsonResource
    {
        return BookCollection::collection(
            Book::with('author','publisher','genre','action','action.status','grades','subscribers')->paginate(20)
        );
    }
}
