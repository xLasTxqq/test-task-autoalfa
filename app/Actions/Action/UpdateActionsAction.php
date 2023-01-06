<?php

namespace App\Actions\Action;

use App\Http\Resources\ActionCollection;
use App\Models\Action;
use App\Models\Status;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateActionsAction
{
    function __invoke(Action $action): JsonResource
    {
        $action->update(['status_id' => Status::TAKEN_STATUS_ID]);
        return new ActionCollection($action);
    }
}
