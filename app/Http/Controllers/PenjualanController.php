<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = Carbon::now()->format('y-m-d');

        $penjualan = DB::table('penjualans as a')
            ->select('a.*', 'b.*')
            ->leftJoin('pelanggans as b', 'a.PelangganID', '=', 'b.PelangganID')
            ->where('a.TanggalPenjualan', $tanggal)
            ->orderBy('a.TanggalPenjualan', 'DESC')
            ->get();

        $pelanggan = DB::table('pelanggans')
            ->orderBy('NamaPelanggan', 'ASC')
            ->get();

        $data = [
            'judul_halaman' => 'Aplikasi Kasir | Penjualan',
            'penjualan' => $penjualan,
            'pelanggan' => $pelanggan,
        ];

        return view('penjualan.index', $data);
    }

    public function transaksi($PelangganID)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = Carbon::now()->format('Y-m');
        $jumlah  = Penjualan::whereRaw("DATE_FORMAT(TanggalPenjualan, '%Y-%m') = ?", [$tanggal])->count();
        $nota    = date('ymd') . ($jumlah + 1);
        $produk  = DB::table('produks')->where('stok', '>', 0)->orderBy('NamaProduk', 'ASC')->get();
        $namapelanggan = DB::table('pelanggans')->where('PelangganID', $PelangganID)->value('NamaPelanggan');

        $detail = DB::table('detail_penjualans as a')
            ->leftJoin('produks as b', 'a.ProdukID', '=', 'b.ProdukID')
            ->where('a.KodePenjualan', $nota)
            ->get();

        $data = [
            'nota'          => $nota,
            'produk'        => $produk,
            'PelangganID'   => $PelangganID,
            'namapelanggan' => $namapelanggan,
            'detail'        => $detail,
        ];
        return view('penjualan.transaksi', $data)->with(compact('detail'));
    }

    
    public function tambahkeranjang(Request $request, $PelangganID) {
        $produk = Produk::where('ProdukID', $request->produk_id)->first();
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
        if ( $stok_lama >= $request->jumlah) {
            DetailPenjualan::create($data);
            $data2 = [
                'Stok' => $stok_sekarang,
            ];
    
            $where = ['ProdukID' => $request->produk_id];
            Produk::where($where)->update($data2);
            $penjualan = Penjualan::with('detail_penjualans')->where('PelangganID', $PelangganID)->get();
            return redirect()->back()->with(compact('penjualan'))->with('success', 'Produk berhasil ditambah ke keranjang');
        }else{
            return redirect()->back()->with('error', 'Produk yang dipilih tidak mencukupi');
        }

    }
   
    public function hapus($DetailID, $ProdukID)
    {
        $detailPenjualan = DetailPenjualan::find($DetailID);
        $jumlah = $detailPenjualan->Jumlah;
        $produk = Produk::find($ProdukID);
        $stok_lama = $produk->Stok;
        $stok_sekarang = $stok_lama + $jumlah;
        $produk->update(['Stok' => $stok_sekarang]);

        $detailPenjualan->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }
    
    public function bayar(Request $request) {
        $data = [
            'KodePenjualan'    => $request-> KodePenjualan,
            'PelangganID'      => $request-> PelangganID,
            'TotalHarga'       => $request-> TotalHarga,
            'TanggalPenjualan' => Carbon::now()->format('Y-m-d'),
        ];
    
        // Simpan data ke dalam tabel user
        Penjualan::create($data);
        return redirect()->route('invoice', ['KodePenjualan' => $request->KodePenjualan])->with('succes','transaksi berhasil');
    }
    
    public function invoice($KodePenjualan){
        date_default_timezone_set("Asia/Jakarta");
        $penjualan = DB::table('penjualans as a')
        ->select('a.*', 'b.*')
        ->leftJoin('pelanggans as b', 'a.PelangganID', '=', 'b.PelangganID')
        ->where('a.KodePenjualan', $KodePenjualan)
        ->orderBy('a.TanggalPenjualan', 'DESC')
        ->get();

        $detail = DB::table('detail_penjualans as a')
            ->leftJoin('produks as b', 'a.ProdukID', '=', 'b.ProdukID')
            ->where('a.KodePenjualan', $KodePenjualan)
            ->get();
        $data = [
            'nota'             => $KodePenjualan,
            'penjualan'        => $penjualan,
            'detail'           => $detail,
        ];
        return view('penjualan.invoice ', $data )->with(compact('penjualan'));
    }   
    
}    