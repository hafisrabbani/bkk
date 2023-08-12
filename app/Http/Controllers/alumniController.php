<?php

namespace App\Http\Controllers;

use App\Alumni;
use Illuminate\Http\Request;
use App\Tahun;
use App\Company;
use RealRashid\SweetAlert\Facades\Alert;

class alumniController extends Controller
{
    public function alumniIndex()
    {
        if (request()->search) {
            $data = Alumni::where('name', 'like', '%' . request()->search . '%')->orWhere('nis', 'like', '%' . request()->search . '%')->paginate(15);
        } else {
            $data = Alumni::paginate(15);
        }
        return view('admin.alumni', [
            'data' => $data,
            'kelas' => $this->lisKelas(),
            'lulusan' => Tahun::get(),
            'instansi' => Company::get()
        ]);
    }

    public function alumniCreate(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:alumnis,nis|integer',
            'name' => 'required',
            'kelas' => 'required',
            'tahun' => 'required',
            'status' => 'required',
        ], [
            'nis.required' => 'NIS Harus Diisi',
            'nis.unique' => 'NIS Sudah Ada',
            'nis.integer' => 'NIS Harus Berupa angka',
            'name.required' => 'Nama Harus Diisi',
            'kelas.required' => 'Kelas Harus Diisi',
            'tahun.required' => 'Tahun Lulus Harus Diisi',
            'status.required' => 'Status Harus Diisi'
        ]);

        $data = Alumni::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'jurusan' => $request->kelas,
            'lulusan' => $request->tahun,
            'status' => $request->status,
            'instansi' => $request->instansi,
            'position' => $request->position
        ]);

        return response()->json(['success', 'Berhasil tambah data']);
    }

    public function alumniEdit(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:alumnis,nis,' . $request->id,
            'name' => 'required',
            'kelas' => 'required',
            'tahun' => 'required',
            'status' => 'required',
        ], [
            'nis.required' => 'NIS Harus Diisi',
            'nis.unique' => 'NIS Sudah Ada',
            'name.required' => 'Nama Harus Diisi',
            'kelas.required' => 'Kelas Harus Diisi',
            'tahun.required' => 'Tahun Lulus Harus Diisi',
            'status.required' => 'Status Harus Diisi'
        ]);

        Alumni::where('id', $request->id)->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'jurusan' => $request->kelas,
            'lulusan' => $request->tahun,
            'status' => $request->status,
            'instansi' => $request->instansi,
            'position' => $request->position
        ]);

        return response()->json(['success' => 'Berhasil ubah data']);
    }

    public function alumniDelete(Request $request)
    {
        $check = Alumni::where('id', $request->id)->delete();
        if ($check) {
            Alert::success('Sukses', 'Berhasil Menghapus Data');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Data ini masih digunakan pada tabel lainya');
            return redirect()->back();
        }
    }

    public function lisKelas(): array
    {
        return [
            'KI',
            'PTU',
            'TITL',
            'TKJ',
            'APL',
            'MM',
            'TOI',
            'KA',
            'TB'
        ];
    }
}
