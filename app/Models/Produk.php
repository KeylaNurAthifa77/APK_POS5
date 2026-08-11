<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 1. Import Trait SoftDeletes

class Produk extends Model
{
    use HasFactory, SoftDeletes; // 2. Gunakan SoftDeletes di dalam Class

    protected $table = 'produk';

    protected $fillable = [
    'user_id',
    'nama',
    'jenis_makanan',
    'harga_beli',
    'harga_jual',
    'stok',
    'foto',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'produk_id');
    }
}