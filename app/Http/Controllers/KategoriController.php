<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $kategori = Kategori::all();
        return view("kategori", compact("kategori", "user"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "jenis_kategori" => "required",
            "nama_kategori" => "required",
        ]);
        Kategori::create($request->all());
        return redirect()->back()->with("success", "Data Berhasil Input");
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedata = $request->validate([
            "jenis_kategori" => "required",
            "nama_kategori" => "required",
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->jenis_kategori = $validatedata["jenis_kategori"];
        $kategori->nama_kategori = $validatedata["nama_kategori"];
        $kategori->save();

        return redirect()->back()->with("success", "Data Berhasil Diupdate");
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->back()->with("success", "Databerhasil Dihapus");
    }
}
