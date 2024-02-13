<?php

namespace App\Models;

use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $primaryKey = 'PenjualanID';
    protected $fillable = [
        'KodePenjualan',
        'TanggalPenjualan',
        'TotalHarga',
        'PelangganID',
    ];
    public function detail_penjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'DetailID');
    }
    public function pelanggans()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID');
    }
}
