<?php

namespace App\Http\Controllers;

use App\Models\Profiluser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class usersController extends Controller
{
    public function index(){
        // mengambil data dari table
        $user = DB::table('users')
            ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
            ->leftJoin('profilusers', 'users.id','=','profilusers.user_id')
            ->select('users.id', 'users.username', 'roles.nama_role', 'profilusers.nama_pj', 
            'profilusers.alamat', 'profilusers.no_wa')
            ->union(
                DB::table('users')
                    ->rightJoin('roles', 'roles.id', '=', 'users.role_id')
                    ->rightJoin('profilusers', 'users.id','=','profilusers.user_id')
                    ->select('users.id', 'users.username', 'roles.nama_role', 'profilusers.nama_pj', 
                    'profilusers.alamat', 'profilusers.no_wa')
            )
            ->get();


        // mengirim data ke view index
        return view('adminpus.users.users',compact('user'));
    }

    //hapus user
    public function destroy($id){
    	$user=User::find($id);
    	$user->delete();

    	return redirect('users');
    }

    //update 
    public function edit($id){
    	
        $user = User::with('profil_user')->findOrFail($id);
        // passing data pegawai yang didapat ke view edit.blade.php
        return view('adminpus.users.update', compact('user'));
 
    }

    //proses update tabel user dan profil user
    public function update(Request $request, $id){
        //find user by id
        $user = User::find($id);
        $user = User::where('id',$id)->first();
        $user->username = $request->input('username');
        if($user->save())
        {
            $profile = Profiluser::find($id);
            $profile = Profiluser::where('id',$id)->first();
            $profile->nama_pj = $request->input('nama_pj');
            $profile->alamat = $request->input('alamat');
            $profile->no_wa = $request->input('no_wa');
            
            // if ($request->hasFile('photo')) {
            //     $photo = $request->file('photo');
            //     $filename = 'photo' . '-' . time() . '.' . $photo->getClientOriginalExtension();
            //     $location = public_path('images/' . $filename);
            //     Image::make($photo)->resize(1300, 362)->save($location);
            //     $profile->photo = $filename;
    
            //     $oldFilename = $profile->photo;
            //     $profile->photo = $filename;
            //     Storage::delete($oldFilename);
            // }

            $profile->save();
            return redirect('users')->with('success', 'Your info are updated');
        }

        return redirect('users');
    }

     //change password
     public function userchangepassword(Request $request, $id)
     {
         $this->validate($request, [
             'current_password' => 'required|string',
             'new_password' => 'required|confirmed|min:8|string'
         ]);
 
        //  if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
        //      // The passwords matches
        //      return redirect()->back()->with("eror","Password Anda saat ini tidak cocok dengan password yang Anda berikan. Silakan coba lagi.");
        //  }
          
        //  if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
        //      //Current password and new password are same
        //      return redirect()->back()->with("eror","Password Baru tidak boleh sama dengan Password Anda saat ini. Silakan pilih kata sandi lain.");
        //  }
 
        //  if(!(strcmp($request->get('new_password'), $request->get('new_password_confirmation'))) == 0){
        //      //New password and confirm password are not same
        //      return redirect()->back()->with("eror","Password baru harus sama dengan dengan password konfirmasi. Silakan ketik ulang.");
        //  }
 
         //Change Password
         $user =  User::find($id);
         $user =  User::where('id',$id)->first();
         $user -> password = bcrypt($request->get('new_password'));
         $user -> save();
          
         return redirect()->back()->with("sukses","Password Berhasil Diubah !");
     
     }

}
