<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = "produks";

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'stok',
        'foto',
    ];

    // Hapus method deleting()

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_produk');
    }
}
