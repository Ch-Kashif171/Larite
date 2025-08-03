<?php

namespace App\Http\Controllers;

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
        $recodrd = DB::table('contact_us')->limit(10)->offset(20)->get();
        dd($recodrd);
        return view('home');
    }

}

