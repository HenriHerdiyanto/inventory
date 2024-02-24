<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $produk = Produk::all();
        $penjualan = Penjualan::all();
        return view("penjualan", compact("penjualan", "kategori", "produk"));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            "id_produk" => "required",
            "unit_terjual" => "required",
        ]);
        $penjualan = new Penjualan();
        $penjualan->id_produk = $validateData["id_produk"];
        $penjualan->unit_terjual = $validateData["unit_terjual"];
        $penjualan->save();
        return redirect()->back()->with("success", "Data Berhasil Disimpan");
    }

    public function edit(Penjualan $penjualan)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::find($id);
        $validateData = $request->validate([
            "id_produk" => "required",
            "unit_terjual" => "required",
        ]);
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->id_produk = $validateData["id_produk"];
        $penjualan->unit_terjual = $validateData["unit_terjual"];
        $penjualan->save();
        return redirect()->back()->with("success", "Data Berhasil Diupdate");
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);
        $penjualan->delete();
        return redirect()->back()->with("success", "Data Berhasil Dihapus");
    }
}
