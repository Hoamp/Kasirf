<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $primaryKey = 'DetailID';
    protected $fillable =  [
        'PenjualanID',
        'ProdukID',
        'KodePenjualan',
        'Jumlah',
        'Subtotal',
    ];
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukID');
    }
   
}



