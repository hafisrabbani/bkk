<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Alumni;
use App\Company;
use App\Loker;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Config;


class adminController extends Controller
{
    public function home()
    {
        return view('admin.index');
    }

    public function setIndex(Request $request)
    {
        $id = $request->session()->get('id');
        $data = Admin::where('id', $id)->first();
        return view('admin.settings', [
            'data' => $data
        ]);
    }

    public function setPost(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:admins,username,' . $id,
            'password_confirm' => 'same:password'
        ], [
            'name.required' => 'Nama Harus Diisi',
            'username.required' => 'Username Harus Diisi',
            'username.unique' => 'Username Sudah Ada',
            'password.required' => 'Password Harus Diisi',
            'password_confirm.same' => 'Password Tidak sama',
            'password_confirm.required' => 'Password Harus Diisi'
        ]);
        if (!empty($request->password)) {
            $data = Admin::where('id', $id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);
        } else {
            $data = Admin::where('id', $id)->update([
                'name' => $request->name,
                'username' => $request->username
            ]);
        }
        return response()->json(['success', 'Berhasil tambah data']);
    }

    public function ckeditor(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->storeAs('ckeditor/img', $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/ckeditor/img/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }


    public function dashboard()
    {
        $alumni1 = Alumni::where('status', '0')->count();
        $alumni2 = Alumni::where('status', '1')->count();
        $alumni3 = Alumni::where('status', '2')->count();
        $chart = [$alumni1, $alumni2, $alumni3];
        return view('admin.dashboard', [
            'alumni' => Alumni::count(),
            'mitra' => Company::count(),
            'loker' => Loker::count(),
            'post' => Posts::count(),
            'chart' => $chart
        ]);
    }

    public static function getConfigWeb()
    {
        $data = Config::first();
        return $data;
    }
}
