<?php

namespace Maxfactor\CMS\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maxfactor\CMS\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        return View::make('maxfactor::auth.index');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('maxfactor::auth.login');
    }

    public function redirectTo()
    {
        return route('admin.index');
    }
}
