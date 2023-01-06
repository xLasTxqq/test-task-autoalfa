<?php

namespace App\Actions\Action;

use App\Http\Requests\ActionRequest;
use App\Http\Resources\ActionCollection;
use App\Models\Action;
use App\Models\Status;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreActionsAction
{

    function __invoke(ActionRequest $request): JsonResource
    {
        $action = Action::firstOrCreate(
            $request->validated(),
            ['status_id'=>Status::BOOKED_STATUS_ID, 'user_id'=>auth()->id()]
        );
        return new ActionCollection($action);
    }
}
