<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Profile\DestroyProfileAction;
use App\Actions\Profile\UpdateProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request, UpdateProfileAction $updateProfileAction): Response
    {
        return $updateProfileAction($request);
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, DestroyProfileAction $destroyProfileAction): Response 
    {
        return $destroyProfileAction($request);
    }
}
