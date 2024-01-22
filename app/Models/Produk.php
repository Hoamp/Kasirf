<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $primaryKey = 'ProdukID';
    protected $fillable = [
        'KodeProduk',
        'NamaProduk',
        'Harga',
        'Stok',
    ];
    protected $table = 'produks';
}
