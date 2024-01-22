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
            $product = Produk::findOrFail($ProdukID);
            $product->delete();
            return redirect()->route('produk')->with('success', 'Data pengguna berhasil dihapus');
        }
}
