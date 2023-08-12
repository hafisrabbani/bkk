<?php

namespace App\Http\Controllers;

use App\Loker;
use App\Posts;
use Illuminate\Support\Facades\DB;

class clientsController extends Controller
{
    public function home()
    {
        $alumni = DB::table('alumnis')->count();
        $patner = DB::table('companys')->where('type', '0')->count();
        $loker = DB::table('lokers')->count();
        $config = DB::table('pages')->where('route', '/')->first();
        return view('clients.home', [
            'data' => $config,
            'counter' => [
                'alumni' => $alumni,
                'patner' => $patner,
                'loker' => $loker
            ]
        ]);
    }

    public function lowongan()
    {
        $dataLoker = Loker::orderBy('id', 'desc')->get();
        $config = DB::table('pages')->where('route', '/lowongan')->first();
        return view('clients.loker', [
            'data' => $config,
            'dataLoker' => $dataLoker
        ]);
    }

    public function lowonganDetail($id)
    {
        if (!is_numeric($id)) {
            return '<h3>MAU NGAPAIN BANG?<br>ANTI SQL INJECTION NIH GAN</h3>';
        }
        $data = Loker::where('id', $id)->get();
        if ($data->isEmpty()) {
            return abort(404);
        }
        return view('clients.loker-detail', [
            'detail' => $data[0]
        ]);
    }

    public function patner()
    {
        $data = DB::table('companys')->where('type', '0')->get();
        return view('clients.patner', [
            'data' => $data
        ]);
    }

    public function blog()
    {
        $config = DB::table('pages')->where('route', '/blog')->first();
        // dd($config);
        $post = Posts::where('status', 2)->orderBy('id', 'desc')->get();
        return view('clients.blog', [
            'config' => $config,
            'data' => $post
        ]);
    }

    public function blogDetail($id)
    {
        $data = Posts::where('slug', $id)->get();
        return view('clients.blog-detail', [
            'data' => $data[0]
        ]);
    }
}
