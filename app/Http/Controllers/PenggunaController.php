<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PenggunaController extends Controller
{
    //
    public function index(){
        $pengguna = User::all();
        return view('pengguna.index',compact('pengguna'));
    }
    public function create(Request $request){
        User::create([
            'name'  => $request->name,
            'username'  => $request->username,
            'password'  => $request->password,
            'level'  => $request->level,
        ]);
        return redirect()->route('pengguna')->with('success','Data pengguna berhasil ditambah');
    }
    public function destroy($id){
        $pengguna = User::findOrFail($id);
        $pengguna->delete();
        // dd(session('success'));
        return redirect()->route('pengguna')->with('success', 'Data pengguna berhasil dihapus');
    }
}
