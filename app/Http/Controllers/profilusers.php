<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profilusers extends Controller
{
    public function index()
    {    
        return view('profiluser');
    }
}
