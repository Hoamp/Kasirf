<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index',compact('pelanggan'));
    }
    public function store(Request $request){
        Pelanggan::create([
            'NamaPelanggan' => $request->nama,
            'Alamat'        => $request->alamat,
            'NomorTelepon'  => $request->telp,
        ]);
        return redirect()->route('pelanggan')->with('success','Data pelanggan berhasil ditambah');
    }
        public function destroy($pelangganID){
            $pelanggan = pelanggan::findOrFail($pelangganID);
            $pelanggan->delete();
            return redirect()->route('pelanggan')->with('success', 'Data pengguna berhasil dihapus');
        }
}
