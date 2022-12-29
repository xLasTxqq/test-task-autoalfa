<?php

namespace App\Actions\Action;

use App\Models\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateActionsAction
{

    function __invoke(Request $request): Model
    {
        $request->validate([
            'book_id'=>'required|exists:books,id'
        ]);

        return Action::firstOrCreate(
            ['book_id'=>$request->book_id],
            ['status_id'=>1, 'user_id'=>auth()->id()]
        );
    }
}
