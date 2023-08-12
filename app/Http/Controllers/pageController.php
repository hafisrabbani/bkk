<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;

class pageController extends Controller
{
    public function index()
    {
        return view('admin.setting-page', [
            'data' => Pages::all()
        ]);
    }


    public function getEdit($id)
    {
        $data = Pages::where('id', $id)->get();
        $data = $data[0];
        return view('admin.page-edit', [
            'data' => $data
        ]);
    }

    public function postEdit(Request $request)
    {
        $request->validate([
            'header' => 'required',
            'content' => 'required',
            'poster' => 'mimes:jpg,jpeg,png|max:2048'
        ], [
            'header.required' => 'Header harus diisi',
            'content.required' => 'Kontent Harus diisi',
            'poster.mimes' => 'Format file harus jpg/jpeg/png',
            'poster.max' => 'Ukuran file max 2mb'
        ]);


        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pages/poster', $name);
        } else {
            $name = $request->oldPoster;
        }

        $data = Pages::where('id', $request->id)->update([
            'header' => $request->header,
            'content_extra' => $request->content_extra,
            'content' => $request->content,
            'image' => $name,
        ]);

        return response()->json(['success', 'Berhasil ubah data']);
    }
}
