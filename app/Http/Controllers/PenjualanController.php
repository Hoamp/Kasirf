<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal   = date('y-m-d');
        $penjualan = Penjualan::orderBy('TanggalPenjualan', 'desc')->where('TanggalPenjualan',$tanggal);
        $pelanggan = Pelanggan::all();
        return view('penjualan.index', compact('penjualan','pelanggan','tanggal'));
    }

    public function transaksi($PelangganID) {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m');
        $penjualan = Penjualan::whereDate('TanggalPenjualan', 'like', $tanggal . '%')->with('detailProduks.produk')->get();
        $jumlah = $penjualan->count() + 1;
        $produk = Produk::all();
        $nota = date('ymd') . $jumlah;
        $pelanggan = Pelanggan::all();
        return view('penjualan.transaksi', compact('produk', 'penjualan', 'pelanggan', 'tanggal', 'jumlah', 'nota', 'PelangganID'));
    }
    public function tambahkeranjang(){
        DetailPenjualan::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'password'  => $request->password,
            'level'     => $request->level,
        ]);
    } 
}
