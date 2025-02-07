<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class participant_wlyhController extends Controller
{
    public function index()
    {
        // $user = User::with('profil_user')->findOrFail(Auth::id());

        // return view('adminpus.event', compact('user'));
        return view('adminwil.participants.participant');
    }

    public function add($id)
    {
        // $user = User::findOrFail($id);
        // memanggil view tambah
        // return view('adminpus.users.addprofil', compact('user'));
    
    }
}
