<?php

namespace App\Http\Controllers;

use App\Imports\YourImportClass;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');

        // Lakukan validasi file, pastikan itu file Excel

        Excel::import(new YourImportClass, $file);

        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }
}
