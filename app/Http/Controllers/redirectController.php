<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class redirectController extends Controller
{
    //jika user sudah login maka akan diarahkan ke pagenya
    public function cek() {
        if (auth()->user()->role_id === 1) {
            return redirect('/adminpus');
        } else {
            return redirect('/adminwil');
        }
    }
}
