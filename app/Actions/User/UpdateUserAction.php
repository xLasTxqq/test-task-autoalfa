<?php

namespace App\Actions\User;

use App\Events\PasswordCreatedOrUpdatedEvent;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UpdateUserAction
{
    function __invoke(Request $request, User $user): Response
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user->update(['password'=>bcrypt($request->password)]);
        event(new PasswordReset($user));
        event(new PasswordCreatedOrUpdatedEvent($request->password,$user));
        return response()->noContent();
    }
}
