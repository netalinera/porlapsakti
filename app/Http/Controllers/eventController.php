<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class eventController extends Controller
{
    public function index()
    {
        $event = Event::all();

        return view('adminpus.event.event', compact('event'));
    }

    //add event
    public function add()
    {
    
        // memanggil view tambah
        return view('adminpus.event.add');
    
    }

    //proses insert db
    public function store(Request $request){

        request()->validate([
            'nama_kegiatan'       => 'required|string|min:2|max:100',
            'tahun'      => 'required|numeric|min:2'
        ]);

        // insert data ke table
        $event=Event::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tahun' => $request->tahun,
            'provinsi' => $request->provinsi
        ]);

        if($event){
            return redirect('event')->with('success', 'kegiatan berhasil ditambahkan!');
        }else{
            return redirect('event')->with('failed', 'kegiatan gagal ditambahkan!');
        }
    }

    //update 
    public function update($id){
    	
        $event = Event::findOrFail($id);
        // passing data pegawai yang didapat ke view edit.blade.php
        return view('adminpus.event.update', compact('event'));
 
    }

    //proses update tabel user dan profil user
    public function processupdate(Request $request, $id){

        request()->validate([
            'nama_kegiatan'       => 'required|string|min:2|max:100',
            'tahun'      => 'required|numeric|min:0',
            'provinsi'     =>'required|string|min:2|max:100',
        ]);

        //find user by id
        $event = Event::find($id);
        $event = Event::where('id',$id)->first();
        $event->nama_kegiatan = $request->input('nama_kegiatan');
        $event->tahun = $request->input('tahun');
        $event->provinsi = $request->input('provinsi');

        $event->save();
        if($event){
            return redirect('event')->with('success', 'Your info are updated');
        }else{
            return redirect('event')->with('failed', 'failed info to updated');
        }
    }

    //hapus 
    public function destroy($id){
    	$event=Event::find($id);
    	$event->delete();

    	// return redirect('event');
        if($event){
            return redirect('event')->with('success', 'Your info are deleted');
        }else{
            return redirect('event')->with('failed', 'failed info to deleted');
        }
    }
}
