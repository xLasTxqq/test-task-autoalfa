<?php

namespace App\Actions\Action;

use App\Events\BookIsFree;
use App\Models\Action;
use Illuminate\Http\Resources\Json\JsonResource;

class DestroyActionsAction
{
    function __invoke(Action $action): JsonResource
    {
        if (
            auth()->user()->hasPermissionTo('give_and_take_books') &&
            $action->status_id != 2 &&
            $action->user_id != auth()->id()
        ) abort(403, "You can't do this");
        else if (
            !auth()->user()->hasPermissionTo('give_and_take_books') &&
            $action->user_id != auth()->id()
        )
            abort(403, "You can't do this");
        $action->delete();
        event(new BookIsFree($action->book_id));
        return new JsonResource($action);
    }
}
