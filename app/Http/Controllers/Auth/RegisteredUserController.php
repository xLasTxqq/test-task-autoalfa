<?php

namespace App\Http\Controllers\Auth;

use App\Events\PasswordIsReady;
use App\Http\Controllers\Controller;
use App\Mail\NotificationPasswordForm;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $role = Role::all();
        return Inertia::render('Auth/Register', compact('role'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|exists:roles,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        event(new Registered($user));

        // Auth::login($user);
        // Mail::send(['text'=>'mail'],['name'=>'aaaaaaaa'], function($message){
        //     $message->to('xlastx.qq@gmail.com','Gjdkjskfjsdkfjs')->subject('Test');
        //     $message->from('xlastx.qq@gmail.com', 'Gjdkjskfjsdkfjs');
        // });
        event(new PasswordIsReady($request->password,$user));

        return back()->with('status', true);
    }
}
