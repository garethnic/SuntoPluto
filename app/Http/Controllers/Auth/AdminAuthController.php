<?php

namespace Flisk\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

use Flisk\Http\Requests;
use Flisk\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Use admin guard
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * The view to be shown
     *
     * @var string
     */
    protected $loginView = 'auth.admin.login';
}
