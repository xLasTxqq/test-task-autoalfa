<?php

namespace App\Actions\Action;

use App\Events\BookIsFree;
use App\Http\Requests\ActionRequest;
use App\Models\Action;
use App\Models\Book;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Integer;

class DestroyActionsAction
{

    function __invoke(Integer|String $id): Model
    {
        $action = new Action();
        if (auth()->user()->hasPermissionTo('give_and_take_books'))
            $action = $action->where('status_id', 2)->findOrFail($id);
        else {
            $action = $action->where('user_id', auth()->id())->findOrFail($id);
        }
        $action->delete();
        event(new BookIsFree($action->book_id));
        return $action;
    }
}
