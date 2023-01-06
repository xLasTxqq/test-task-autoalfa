<?php

namespace App\Actions\Publisher;

use App\Models\Publisher;
use Illuminate\Http\Response;

class DestroyPublisherAction
{
    function __invoke(Publisher $publisher): Response
    {
        $publisher->delete();
        return response()->noContent();
    }
}
