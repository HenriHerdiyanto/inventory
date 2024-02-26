<?php

namespace App\Imports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class YourImportClass implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Produk([
            'id_kategori' => null, // Sesuai permintaan Anda, id_kategori dikosongkan saja
            'nama_produk' => $row['nama_produk'],
            'harga_beli' => $row['harga_beli'],
            'harga_jual' => $row['harga_jual'],
            'stok' => $row['stok'],
            'foto' => null, // Sesuai permintaan Anda, foto dikosongkan saja
        ]);
    }
}
