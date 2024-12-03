<?php

namespace App\Http\Controllers;

use App\Models\Profiluser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class profilController extends Controller
{
    public function index()
    {
        $user = User::with('profil_user')->findOrFail(Auth::id());

        return view('adminpus.profiluser', compact('user'));
    }
    //proses update
    public function update(Request $request, $id)
    {
        request()->validate([
            'nama_pj'       => 'required|string|min:2|max:100',
            'alamat'      => 'required|string|min:2|max:100',
            'no_wa'     =>'required|numeric|min:2',
        ]);

        $user = Profiluser::find($id);

        $user->nama_pj = $request->nama_pj;
        $user->alamat = $request->alamat;
        $user->no_wa = $request->no_wa;

        $user->save();

        return back()->with('success', 'Profil berhasil diedit!');
        // return redirect(url()->previous() .'#profile-edit')->with('status', 'Profil berhasil diedit!');
    }

    //proses insert db by self
    public function store(Request $request){

        request()->validate([
                    'nama_pj'       => 'required|string|min:2|max:100',
                    'alamat'      => 'required|string|min:2|max:100',
                    'no_wa'     =>'required|numeric|min:2',
                ]);
        
                $user = new ProfilUser;
                
                $user->user_id = Auth::id();
                $user->nama_pj = $request->nama_pj;
                $user->alamat = $request->alamat;
                $user->no_wa = $request->no_wa;
                $user->fill($request->all());
                $user->save();
        
                return back()->with('sukses', 'Profil berhasil diedit!');
    }

    //change password
    public function changePasswordSave(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("eror","Password Anda saat ini tidak cocok dengan password yang Anda berikan. Silakan coba lagi.");
        }
         
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("eror","Password Baru tidak boleh sama dengan Password Anda saat ini. Silakan pilih kata sandi lain.");
        }

        if(!(strcmp($request->get('new_password'), $request->get('new_password_confirmation'))) == 0){
            //New password and confirm password are not same
            return redirect()->back()->with("eror","Password baru harus sama dengan dengan password konfirmasi. Silakan ketik ulang.");
        }

        //Change Password
        $user =  User::find(Auth::user()->id);
        $user -> password = bcrypt($request->get('new_password'));
        $user -> save();
         
        return redirect()->back()->with("sukses","Password Berhasil Diubah !");
    
    }

    //set photo to null (hapus foto)
    public function destroyImg($id){
    	
        $user = ProfilUser::find($id);

        if($user->photo && file_exists(Storage::path('public/photos/' . $user->photo))){
            Storage::delete('public/photos/'.$user->photo);
        }

    	$user->update(['photo' => null]);

    	return redirect()->back()->with("success","Berhasil !");
    }

        //proses update
        public function updatePhoto(Request $request, $id)
        {
            $user = ProfilUser::find($id);
    
            if ($request->hasFile('photo')) {
                //validasi file
                $request->validate([
                    // 'photo' => 'mimes:kpg,png,jpeg|max:5048'
                    'photo' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
                    ]);
    
                if($user->photo && file_exists(Storage::path('public/photos/' . $user->photo))){
                    Storage::delete('public/photos/'.$user->photo);
                }
    
                $file = $request->file('photo');
                $fileName = $file->hashName() . '.' . $file->getClientOriginalExtension();
                $request->photo->move(Storage::path('public/photos'), $fileName);
                $user->photo = $fileName;
            }
    
    
            $user->save();
    
            return back()->with('status', 'Profil berhasil diedit!');
        }

        //add akun
    public function add($id)
    {
        $user = User::findOrFail($id);
        // memanggil view tambah
        return view('adminpus.users.addprofil', compact('user'));
    
    }

    //proses insert db by admin pusat
    public function storePU(Request $request){

        request()->validate([
                    'nama_pj'       => 'required|string|min:2|max:100',
                    'alamat'      => 'required|string|min:2|max:100',
                    'no_wa'     =>'required|numeric|min:2',
                ]);
        
                $user = new ProfilUser;
                
                $user->user_id = $request->user_id;
                $user->nama_pj = $request->nama_pj;
                $user->alamat = $request->alamat;
                $user->no_wa = $request->no_wa;
                $user->fill($request->all());
                $user->save();
        
                if($user){
                    return redirect('users')->with('success', 'Your info are updated');
                }else{
                    return redirect('users')->with('failed', 'failed info to updated');
                }
    }
}
