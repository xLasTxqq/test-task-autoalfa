<?php

namespace App\Actions\Action;

use App\Models\Action;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ReadActionsAction
{

    function __invoke(): Model|Collection
    {
        $action = new Action();
        if(!auth()->user()->hasPermissionTo('give_and_take_books'))
        $action = $action->where('user_id', auth()->id());  
        $action = $action->with('status','book.genres','book.publishers','book.authors')->get();
        return $action;
    }
}
