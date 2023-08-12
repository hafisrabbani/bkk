<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;

class configController extends Controller
{
    public function index()
    {
        return view('admin.setting-config', [
            'data' => Config::first()
        ]);
    }

    public function post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'mimes:jpg,jpeg,png|max:2048',
            'favicon' => 'mimes:jpg,jpeg,png|max:2048',
            'description' => 'required',
        ], [
            'name.required' => 'Nama harus diisi',
            'logo.mimes' => 'Format file harus jpg/jpeg/png',
            'logo.max' => 'Ukuran file max 2mb',
            'favicon.mimes' => 'Format file harus jpg/jpeg/png',
            'favicon.max' => 'Ukuran file max 2mb',
            'description.required' => 'Deskripsi harus diisi'
        ]);

        if ($request->hasFile('logo')) {
            $fileLogo = $request->file('logo');
            $nameLogo = time() . '.' . $fileLogo->getClientOriginalExtension();
            $fileLogo->storeAs('config/logo', $nameLogo);
        } else {
            $nameLogo = $request->oldLogo;
        }
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $nameFavicon = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('config/favicon', $nameFavicon);
        } else {
            $nameFavicon = $request->oldFavicon;
        }

        $data = Config::where('id', $request->id)->update([
            'name' => $request->name,
            'logo' => $nameLogo,
            'favicon' => $nameFavicon,
            'description' => $request->description,
        ]);
        return response()->json(['success', 'Berhasil ubah data']);
    }
}
