<?php

namespace App\Actions\Action;

use App\Http\Resources\ActionCollection;
use App\Models\Action;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexActionsAction
{

    function __invoke(): JsonResource
    {
        $action = new Action();
        if (!auth()->user()->hasPermissionTo(User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS))
            $action = $action->where('user_id', auth()->id());
        return ActionCollection::collection($action->with(
            'user',
            'book',
            'status',
            'book.author',
            'book.publisher',
            'book.genre',
            'book.grades',
        )->get());
    }
}
