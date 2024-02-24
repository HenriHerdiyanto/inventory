<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function UpdateProfile(Request $request, $id)
    {
        $user = User::find($id);
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'posisi' => 'required',
            'foto' => 'file|image|mimes:png,jpg|max:800',
        ]);
        $user = User::findOrFail($id);
        $user->name = $validateData['name'];
        $user->email = $validateData['email'];
        $user->tgl_lahir = $validateData['tgl_lahir'];
        $user->gender = $validateData['gender'];
        $user->phone = $validateData['phone'];
        $user->address = $validateData['address'];
        $user->posisi = $validateData['posisi'];
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'fotouser';
            $file->move(public_path($tujuan_upload), $nama_file);

            // Hapus foto lama jika ada
            if ($user->foto) {
                // Pastikan foto lama ada sebelum menghapus
                if (file_exists(public_path('fotouser/' . $user->foto))) {
                    unlink(public_path('fotouser/' . $user->foto));
                }
            }

            // Set foto baru
            $user->foto = $nama_file;
        } else {
            // Jika tidak ada file gambar yang diunggah, gunakan foto lama
            if (!$user->foto) {
                // Jika tidak ada foto lama, Anda dapat menangani kesalahan di sini
                return redirect()->back()->withErrors(['error' => 'Gagal upload gambar']); // Perbaiki pesan kesalahan
            }
        }
        $user->save();
        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Data Berhasil');
    }
}
