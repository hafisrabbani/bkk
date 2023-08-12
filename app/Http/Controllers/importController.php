<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tahun;
use App\Imports\AlumnisImport;
use Maatwebsite\Excel\Excel;

class importController extends Controller
{
    public function index()
    {
        return view('admin.import', [
            'angkatan' => Tahun::all()
        ]);
    }
    public function post(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx',
            'angkatan' => 'required'
        ], [
            'excel.required' => 'File tidak boleh kosong',
            'excel.mimes' => 'File harus berformat .xls atau .xlsx',
            'angkatan.required' => 'Angkatan tidak boleh kosong'
        ]);

        $file = $request->file('excel');
        $import = new AlumnisImport();
        $import->lulusan($request->angkatan);
        $import->import($file);
        if (isset($import->failures()[0])) {
            return response(json_encode($import->failures()), 500);
        }
        return response(json_encode('Berhasil Import Data'), 200);
    }

    public function format()
    {
        return response()->download('files/format.xlsx');
    }
}
