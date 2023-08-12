<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Config;

class authAdminController extends Controller
{
    public function index()
    {
        $data = Config::first();
        return view('admin.login', compact('data'));
    }

    public function post(Request $request)
    {
        $data = Admin::where('username', $request->username)->first();
        if ($data) {
            if (Hash::check($request->password, $data->password)) {
                $request->session()->put('authAdmin', true);
                $request->session()->put('id', $data->id);
                Alert::success('Sukses', 'Berhasil Login');
                return redirect(route('admin.dashboard'));
            }
        }
        Alert::error('Gagal', 'Username atau Password salah');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Alert::success('Sukses', 'Berhasil Logout');
        return redirect(route('login'));
    }
}
