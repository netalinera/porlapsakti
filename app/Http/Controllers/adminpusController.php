<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminpusController extends Controller
{
    public function index()
    {    
        return view('adminpus.index');
    }
}
