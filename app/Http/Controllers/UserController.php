<?php

namespace Flisk\Http\Controllers;

use Flisk\User;
use Illuminate\Http\Request;

use Flisk\Http\Requests;
use Flisk\Http\Controllers\Controller;

class UserController extends Controller
{
    public function confirmUser($username, $token)
    {
        $user = User::where('username', '=', $username)->whereToken($token)->first();

        $user->confirmed = 1;

        $user->token = null;

        $user->save();

        return view('auth.confirmed_user', compact('user'));
    }
}
