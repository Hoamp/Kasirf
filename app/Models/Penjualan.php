<?php

namespace App\Models;

use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;
    public function detailProduks()
    {
        return $this->hasMany(DetailPenjualan::class, 'PenjualanID');
    }
}
