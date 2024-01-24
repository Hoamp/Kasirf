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
            $pelanggan = Pelanggan::findOrFail($pelangganID);
            $pelanggan->delete();
            return redirect()->route('pelanggan')->with('success', 'Data pengguna berhasil dihapus');
        }
        public function edit($PelangganID){
            $pelanggan = Pelanggan::findOrFail($PelangganID);
            return view('pelanggan.edit', compact('pelanggan'));
        }
        public function update(Request $request, $PelangganID){
            $pelanggan = Pelanggan::findOrFail($PelangganID);
            $pelanggan->update([
                'NamaPelanggan' => $request->nama,
                'Alamat'        => $request->alamat,
                'NomorTelepon'  => $request->telp,
            ]);
            return redirect()->route('pelanggan')->with('success', 'Data pengguna berhasil diperbarui');
        }
}
