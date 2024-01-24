<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(){
        $produk = Produk::all();
        return view('produk.index',compact('produk'));
    }
    public function store(Request $request){
        Produk::create([
            'NamaProduk' => $request->nama,
            'Harga'      => $request->harga,
            'Stok'       => $request->stok,
            'KodeProduk' => $request->kode,
        ]);
        return redirect()->route('produk')->with('success','Data produk berhasil ditambah');
    }
    public function destroy($ProdukID){
        $produk = Produk::findOrFail($ProdukID);
        $produk->delete();
        return redirect()->route('produk')->with('success', 'Data pengguna berhasil dihapus');
    }
    public function edit($ProdukID){
        $produk = Produk::findOrFail($ProdukID);
        return view('produk.edit', compact('produk'));
    }
    public function update(Request $request, $ProdukID){
        $produk = Produk::findOrFail($ProdukID);
        $produk->update([
            'KodeProduk' => $request->kode,
            'NamaProduk' => $request->nama,
            'Harga'      => $request->harga,
            'Stok'       => $request->stok,
        ]);
        return redirect()->route('produk')->with('success', 'Data pengguna berhasil diperbarui');
    }

}
