<?php

namespace App\Actions\Subscribe;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateSubscribeAction{

    function __invoke(Request $request):Model
    {
        $request->validate(['book_id'=>'required|exists:books,id']);
        $sub = Subscriber::firstOrCreate([
            'user_id'=>auth()->id(),
            'book_id'=>$request->book_id
        ]);
        return $sub;
    }
}