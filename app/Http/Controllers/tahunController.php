<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tahun;
use RealRashid\SweetAlert\Facades\Alert;

class tahunController extends Controller
{
    public function tahunIndex()
    {
        $data = Tahun::all();
        $result = [];
        foreach ($data as $item) {
            $word = explode('/', $item->tahun);
            $result[] = [
                'id' => $item->id,
                'tahun' => $item->tahun,
                'tahun1' => $word[0],
                'tahun2' => $word[1]
            ];
        }
        return view('admin.tahun',[
            'data' => $result
        ]);
    }


    public function tahunCreate(Request $request)
    {
        $request->validate([
            'tahun1' => 'required',
            'tahun2' => 'required'
        ],[
            'tahun1.required' => 'Tahun Harus diisi',
            'tahun2.required' => 'Tahun Harus diisi'
        ]);
        $tahun = $request->tahun1.'/'.$request->tahun2;

        $check = Tahun::where('tahun',$tahun)->get();
        if($check->isEmpty()){
            $data = Tahun::create([
                'tahun' => $tahun,
            ]);
        }else{
            return response()->json(['error2' => $check],502);
        };
    }

    public function tahunDelete(Request $request)
    {
        $data = Tahun::find($request->id)->delete();
        if($data)
        {
            Alert::success('Sukses','Berhasil Menghapus Data');
            return redirect()->back();
        }else{
            Alert::error('Gagal','Gagal Menghapus Data');
            return redirect()->back();   
        }
    }


    public function tahunEdit(Request $request)
    {
        $request->validate([
            'tahun1' => 'required',
            'tahun2' => 'required'
        ],[
            'tahun1.required' => 'Tahun Harus diisi',
            'tahun2.required' => 'Tahun Harus diisi'
        ]);
        $tahun = $request->tahun1.'/'.$request->tahun2;
        $id = $request->id;

        $data = Tahun::where('id',$id)->update([
            'tahun' => $tahun
        ]);
        // return $data;
        if($data > 0){
            return response()->json(['success' => 'Berhasil Ubah data'],200);
        }else{
            return response()->json(['error' => 'Gagal Ubah Data'],502);
        }
    }
}
