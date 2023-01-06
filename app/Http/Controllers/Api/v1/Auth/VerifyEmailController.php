<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Response;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request): Response
    {
        if ($request->user()->hasVerifiedEmail()) {
            abort(302,'You have already verified your email');
        }
 
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->noContent();
    }
}
