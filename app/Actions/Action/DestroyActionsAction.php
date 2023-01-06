<?php

namespace App\Actions\Action;

use App\Models\Action;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Response;

class DestroyActionsAction
{
    function __invoke(Action $action): Response
    {
        $hasPermissionLendOutAndAcceptBooks = auth()->user()->hasPermissionTo(User::PERMISSION_LEND_OUT_AND_ACCEPT_BOOKS);
        abort_if(
            $hasPermissionLendOutAndAcceptBooks &&
                $action->status_id != Status::TAKEN_STATUS_ID &&
                $action->user_id != auth()->id(),
            403,
            "You can't do this"
        );
        abort_if(
            !$hasPermissionLendOutAndAcceptBooks &&
                ($action->user_id != auth()->id() ||
                    $action->status_id == Status::BOOKED_STATUS_ID),
            403,
            "You can't do this"
        );
        $action->delete();
        return response()->noContent();
    }
}
