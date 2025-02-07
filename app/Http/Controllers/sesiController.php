<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sesiController extends Controller
{
    function index()
    {    
        return view('auth.login');
    }

    function login(Request $request){
        $credential = $request->validate([
                    'username'=>'required',
                    'password'=>'required',
                    ]
        // [   
        //     'email.required'=>'harus diisi',
        //     'password.required'=>'harus diisi',
        // ]
        );

        if (Auth::attempt($credential)) {

            // buat ulang session login
            $request->session()->regenerate();

            if (auth()->user()->role_id === 1) {
                // jika user admin pusat
                return redirect()->intended('/adminpus');
            } else {
                // jika user admin wilayah
                return redirect()->intended('/adminwil');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'Username atau Password salah');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
