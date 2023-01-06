<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): Response
    {
        if ($request->user()->hasVerifiedEmail()) {
            abort(302,'You have already verified your email');
        }
 
        $request->user()->sendEmailVerificationNotification();

        return response()->noContent();
    }
}
