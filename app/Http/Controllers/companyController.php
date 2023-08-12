<?php

namespace App\Http\Controllers;

use App\Company;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class companyController extends Controller
{
    public function patner()
    {
        return view('admin.patner', ['data' => Company::all()]);
    }

    public function patnerPost(Request $request)
    {
        $request->validate([
            'company' => 'required|unique:companys,name',
            'alamat' => 'required',
            'logo' => 'mimes:jpg,jpeg,png|max:2048'
        ], [
            'company.required' => 'Nama Perusahaan / Patner Harus diisi',
            'company.unique' => 'Nama Perusahaan / Patner Sudah Ada',
            'alamat.required' => 'Alamat Harus Diisi',
            'logo.mimes' => 'Format Gambar Harus jpg/jpeg/png',
            'logo.max' => 'Ukuran Max 2mb'
        ]);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('company/logo', $name);
        } else {
            $name = NULL;
        }

        Company::create([
            'name' => $request->company,
            'type' => $request->type,
            'address' => $request->alamat,
            'logo' => $name
        ]);
        return response()->json(['success', 'Berhasil tambah data']);
    }


    public function patnerDel(Request $request)
    {
        $check = Company::checkRelations($request->id);
        if ($check) {
            Alert::error('Gagal', 'Data ini masih digunakan pada tabel lainya');
            return redirect()->back();
        } else {
            $data = Company::find($request->id)->delete();
            Alert::success('Sukses', 'Berhasil Menghapus Data');
            return redirect()->back();
        }
    }

    public function patnerEdit(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'company' => 'required|unique:companys,name,' . $id,
            'alamat' => 'required',
            'logo' => 'mimes:jpg,jpeg,png|max:2048'
        ], [
            'company.required' => 'Nama Perusahaan / Patner Harus diisi',
            'company.unique' => 'Nama Perusahaan / Patner Sudah Ada',
            'alamat.required' => 'Alamat Harus Diisi',
            'logo.mimes' => 'Format Gambar Harus jpg/jpeg/png',
            'logo.max' => 'Ukuran Max 2mb'
        ]);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('company/logo', $name);
        } else {
            $name = $request->oldLogo;
        }

        $data = Company::where('id', $id)->update([
            'name' => $request->company,
            'type' => $request->type,
            'address' => $request->alamat,
            'logo' => $name
        ]);

        return response()->json(['success', 'Berhasil edit data']);
    }
}
