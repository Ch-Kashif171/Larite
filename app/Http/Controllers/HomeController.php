<?php

namespace App\Http\Controllers;

use Lumite\Support\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }

}

