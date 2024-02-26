<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $produk = Produk::orderBy('id', 'asc')->get();
        return view("produkHome", compact("produk", "kategori"));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            "id_kategori" => "required",
            "nama_produk" => "required",
            "harga_beli" => "required",
            "harga_jual" => "required",
            "stok" => "required",
            'foto' => 'file|image|mimes:png,jpg|max:800',
        ]);
        // Tambahkan pengecekan dan penanganan file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            // Cek apakah file foto tidak kosong dan valid
            if ($file->isValid()) {
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'produk';
                $file->move(public_path($tujuan_upload), $nama_file);
            } else {
                return redirect()->back()->withErrors(['error' => 'Gagal upload gambar. File tidak valid.']);
            }
        }
        $produk = new Produk();
        $produk->id_kategori = $validateData['id_kategori'];
        $produk->nama_produk = $validateData['nama_produk'];
        $produk->harga_beli = $validateData['harga_beli'];
        $produk->harga_jual = $validateData['harga_jual'];
        $produk->stok = $validateData['stok'];
        $produk->foto = $nama_file;
        $produk->save();
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $validateData = $request->validate([
            'id_kategori' => 'nullable',
            'nama_produk' => 'nullable',
            'harga_beli' => 'nullable',
            'harga_jual' => 'nullable',
            'stok' => 'nullable',
            'foto' => 'nullable|file|image|mimes:png,jpg|max:800',
        ]);
        $produk = Produk::findOrFail($id);
        $produk->id_kategori = $validateData['id_kategori'];
        $produk->nama_produk = $validateData['nama_produk'];
        $produk->harga_beli = $validateData['harga_beli'];
        $produk->harga_jual = $validateData['harga_jual'];
        $produk->stok = $validateData['stok'];
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'produk';
            $file->move(public_path($tujuan_upload), $nama_file);

            // Hapus foto lama jika ada
            if ($produk->foto) {
                // Pastikan foto lama ada sebelum menghapus
                if (file_exists(public_path('produk/' . $produk->foto))) {
                    unlink(public_path('produk/' . $produk->foto));
                }
            }

            // Set foto baru
            $produk->foto = $nama_file;
        } else {
            // Jika tidak ada file gambar yang diunggah, gunakan foto lama
            if (!$produk->foto) {
                // Jika tidak ada foto lama, Anda dapat menangani kesalahan di sini
                return redirect()->back()->withErrors(['error' => 'Gagal upload gambar']); // Perbaiki pesan kesalahan
            }
        }
        $produk->save();
        return redirect()->back()->with('success', 'Data Berhasil Diperbaharui');
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
