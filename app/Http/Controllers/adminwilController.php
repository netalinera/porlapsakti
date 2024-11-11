<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminwilController extends Controller
{
    public function index()
    {    
        return view('adminwil.index');
    }
}
