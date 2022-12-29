<?php

namespace App\Actions\Action;

use App\Http\Requests\ActionRequest;
use App\Models\Action;
use App\Models\Book;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;

class UpdateActionsAction
{

    function __invoke(Action $action): Model
    {
        $action->update(['status_id' => 2]);
        return $action;
    }
}
