<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DetailPenjualan;

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
        $detail = DetailPenjualan::select('detail_penjualans.*', 'produks.*')
        ->leftJoin('produks', 'detail_penjualans.ProdukID', '=', 'produks.ProdukID')
        ->where('detail_penjualans.KodePenjualan', $nota)
        ->get();

        return view('penjualan.transaksi', compact('produk', 'penjualan', 'pelanggan', 'tanggal', 'jumlah', 'nota','detail', 'PelangganID'));
    }
    
    public function tambahkeranjang(Request $request, $PelangganID) {
        $produk = Produk::where('ProdukID', $request->produk_id)->first();
        if ($produk) {
            $harga = $produk->Harga;
            $stok_lama = $produk->Stok;
            $stok_sekarang = $stok_lama - $request->jumlah;
            $sub_total = $request->jumlah * $harga;
    
            $data = [
                'KodePenjualan' => $request->kode_penjualan,
                'ProdukID'      => $request->produk_id,
                'Jumlah'        => $request->jumlah,
                'Subtotal'      => $sub_total,
                'PelangganID'   => $PelangganID,
            ];
    
            DetailPenjualan::create($data);
            $data2 = [
                'Stok' => $stok_sekarang,
            ];
    
            $where = ['ProdukID' => $request->produk_id];
            Produk::where($where)->update($data2);
            $penjualan = Penjualan::with('detailPenjualans')->where('PelangganID', $PelangganID)->get();
            return redirect()->route('transaksi', ['PelangganID' => $PelangganID])->with(compact('penjualan'))->with('success', 'Data produk berhasil ditambah');
        } else {
            return redirect()->route('transaksi', ['PelangganID' => $PelangganID])->with('error', 'Produk not found');
        }
    }

    

}    