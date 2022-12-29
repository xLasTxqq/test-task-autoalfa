<?php

namespace App\Actions\Book;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CreateBookAction
{
    function __invoke(): Array
    {
        $authors = Cache::rememberForever('authors', function () {
            return Author::all();
        });

        $publishers = Cache::rememberForever('publishers', function () {
            return Publisher::all();
        });

        $genres = Cache::rememberForever('genres', function () {
            return Genre::all();
        });

        // dd(Cache::get('publishers'));

        return compact('authors','publishers','genres');
    }
}
