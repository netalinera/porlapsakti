<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class participantController extends Controller
{
    public function index()
    {
        // $user = User::with('profil_user')->findOrFail(Auth::id());

        // return view('adminpus.event', compact('user'));
        return view('adminpus.participant.participant');
    }

    //add akun
    public function add()
    {
    
        // memanggil view tambah
        return view('adminpus.participant.add');
    
    }
}
