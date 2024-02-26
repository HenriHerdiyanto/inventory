<?php

namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenjualanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil semua data penjualan
        $penjualan = Penjualan::all();

        // Membuat koleksi baru untuk data yang akan diekspor
        $exportData = [];

        // Iterasi setiap item penjualan
        foreach ($penjualan as $item) {
            // Ambil nama produk dari relasi dengan model Produk
            $namaProduk = $item->produk->nama_produk;

            // Hitung stok sisa dengan mengurangkan stok produk dengan unit terjual
            $stokSisa = $item->produk->stok - $item->unit_terjual;

            // Tambahkan data ke koleksi untuk diekspor
            $exportData[] = [
                'Nama Produk' => $namaProduk,
                'Unit Terjual' => $item->unit_terjual,
                'Stok Awal' => $item->produk->stok,
                'Stok Sisa' => $stokSisa,
            ];
        }

        // Kembalikan koleksi data yang akan diekspor
        return collect($exportData);
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Unit Terjual',
            'Stok Awal',
            'Stok Sisa',
        ];
    }
}
