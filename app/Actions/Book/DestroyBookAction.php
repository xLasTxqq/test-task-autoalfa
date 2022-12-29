<?php

namespace App\Actions\Book;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class DestroyBookAction
{
    function __invoke(int $id): Model
    {
        return Book::findOrFail($id)->delete();
    }
}
