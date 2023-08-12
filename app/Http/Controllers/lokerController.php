<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Loker;
use RealRashid\SweetAlert\Facades\Alert;


class lokerController extends Controller
{
    public function index()
    {
        $loker = Loker::all();
        return view('admin.loker',[
            'loker' => $loker
        ]);
    }

    public function createIndex()
    {
        $patner = Company::all();
        return view('admin.loker.loker-create',['patner' => $patner]);
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'company' => 'required',
            'judul' => 'required',
            'url' => 'required',
            'description' => 'required',
            'position' => 'required',
            'poster' => 'mimes:jpg,jpeg,png|max:2048'
        ],[
            'company.required' => 'Perusahaan Harus Diisi',
            'judul.required' => 'Judul Harus Diisi',
            'url.required' => 'Link Pendaftaran Harus Diisi',
            'description.required' => 'Deskripsi Harus Diisi',
            'position.required' => 'Posisi Pekerjaan Harus Diisi',
            'poster.mimes' => 'Format Gambar Harus jpg/jpeg/png',
            'poster.max' => 'Ukuran Max 2mb'
        ]);

        if($request->hasFile('poster')){
            $file = $request->file('poster');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('company/poster',$name);
        }else{
            $name = NULL;
        }

        Loker::create([
            'company_id' => $request->company,
            'judul' => $request->judul,
            'url' => $request->url,
            'poster' => $name,
            'position' => $request->position,
            'description' => $request->description,
            'status' => 1,
        ]);

        return response()->json(['success','Berhasil tambah data']);
    }

    public function delete(Request $request)
    {
        $data = Loker::find($request->id)->delete();
        if($data)
        {
            Alert::success('Sukses','Berhasil Menghapus Data');
            return redirect()->back();
        }else{
            Alert::error('Gagal','Gagal Menghapus Data');
            return redirect()->back();   
        }
    }


    public function edit($id)
    {
        $data = Loker::where('id',$id)->get();
        $this->checkData($data);
        $patner = Company::all();
        return view('admin.loker.edit',[
            'data' => $data[0],
            'patner' => $patner
        ]);
    }


    public function editPost(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'company' => 'required',
            'judul' => 'required',
            'url' => 'required',
            'description' => 'required',
            'position' => 'required',
            'poster' => 'mimes:jpg,jpeg,png|max:2048'
        ],[
            'company.required' => 'Perusahaan Harus Diisi',
            'judul.required' => 'Judul Harus Diisi',
            'url.required' => 'Link Pendaftaran Harus Diisi',
            'description.required' => 'Deskripsi Harus Diisi',
            'position.required' => 'Posisi Pekerjaan Harus Diisi',
            'poster.mimes' => 'Format Gambar Harus jpg/jpeg/png',
            'poster.max' => 'Ukuran Max 2mb'
        ]);
        
        
        if($request->hasFile('poster')){
            $file = $request->file('poster');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('company/poster',$name);
        }else{
            $name = $request->oldPoster;
        }

        Loker::where('id',$request->id)->update([
            'company_id' => $request->company,
            'judul' => $request->judul,
            'url' => $request->url,
            'poster' => $name,
            'description' => $request->description,
            'position' => $request->position,
            'status' => $request->status, 
        ]);
    }
}
