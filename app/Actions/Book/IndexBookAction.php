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
            Book::paginate(20)
        );
    }
}
