<?php

namespace Maxfactor\CMS\Http\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maxfactor\CMS\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return View::make('maxfactor::admin');
    }
}
