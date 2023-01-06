<?php

namespace App\Actions\Profile;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Response;

class UpdateProfileAction
{

    function __invoke(ProfileUpdateRequest $request): Response
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return response()->noContent();
    }
}
