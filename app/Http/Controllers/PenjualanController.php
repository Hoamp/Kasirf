<?php

namespace App\Http\Controllers;

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
        $penjualan = Penjualan::whereDate('TanggalPenjualan', 'like', $tanggal . '%')->get();
        $jumlah = $penjualan->count()+1;
        dd($jumlah);
        $nota = date('ymd') . $jumlah;
        $pelanggan = Pelanggan::all();
        return view('penjualan.transaksi', compact('penjualan', 'pelanggan', 'tanggal', 'jumlah'));
    }
    
}
