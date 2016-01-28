<?php

namespace Flisk\Http\Controllers;

use Illuminate\Http\Request;

use Flisk\Http\Requests;
use Flisk\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Show dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDashboard()
    {
        return view('admin.dashboard');
    }
}
