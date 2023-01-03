<?php

namespace App\Actions\Action;

use App\Http\Resources\ActionCollection;
use App\Models\Action;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateActionsAction
{
    function __invoke(Action $action): JsonResource
    {
        $action->update(['status_id' => 2]);
        return new ActionCollection($action);
    }
}
