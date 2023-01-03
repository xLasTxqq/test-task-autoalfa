<?php

namespace App\Actions\Action;

use App\Http\Resources\ActionCollection;
use App\Models\Action;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexActionsAction
{

    function __invoke(): JsonResource
    {
        $action = new Action();
        if (!auth()->user()->hasPermissionTo('give_and_take_books'))
            $action = $action->where('user_id', auth()->id());
        return ActionCollection::collection($action->get());
    }
}
