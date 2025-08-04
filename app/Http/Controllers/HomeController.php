<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Core\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('welcome');
    }

    public function home()
    {
        return view('home');
    }

}

