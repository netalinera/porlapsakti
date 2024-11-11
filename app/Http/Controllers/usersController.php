<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // $user = User::all();

        // mengirim data ke view index
        return view('adminpus.users.users',compact('user'));
    }

    //hapus
    public function destroy($id){
    	$user=User::find($id);
    	$user->delete();

    	return redirect('users');
    }
}
