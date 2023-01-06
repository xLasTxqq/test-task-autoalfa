<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\Response;

class DestroyUserAction
{
    function __invoke(User $user): Response
    {
        $user->delete();
        return response()->noContent();
    }
}
