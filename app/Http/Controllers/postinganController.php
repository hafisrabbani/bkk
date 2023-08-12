<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class postinganController extends Controller
{
    public function index()
    {
        $data = Posts::get();
        return view('admin.post',[
            'data' => $data
        ]);
    }

    public function createIndex()
    {
        return view('admin.postingan.create',[
            'data' => Posts::get()
        ]);
    }

    public function delete(Request $request)
    {
        $data = Posts::find($request->id)->delete();
        if($data)
        {
            Alert::success('Sukses','Berhasil Menghapus Data');
            return redirect()->back();
        }else{
            Alert::error('Gagal','Gagal Menghapus Data');
            return redirect()->back();   
        }
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'status' => 'required',
            'body' => 'required',
        ],[
            'judul.required' => 'Judul harus diisi',
            'penulis.required' => 'Penulis harus diisi',
            'status.required' => 'Status harus diisi',
            'body.required' => 'Tulisan harus diisi'
        ]);
        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('blog/thumbnail',$name);
        }else{
            $name = NULL;
        }
        $slug = $request->judul.' '.time();
        $slug = Str::slug($slug,'-');
        $data = Posts::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'meta' => $request->meta,
            'thumbnail' => $name,
            'slug' => $slug,
            'body' => $request->body,
            'status' => $request->status
        ]);

        return response()->json(['success','Berhasil tambah data']);
    }
    
    public function editIndex($id)
    {
        $data = Posts::where('id',$id)->get();
        $this->checkData($data);
        return view('admin.postingan.edit',[
            'data' => $data[0]
        ]);
    }

    public function editPost(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'status' => 'required',
            'body' => 'required',
        ],[
            'judul.required' => 'Judul harus diisi',
            'penulis.required' => 'Penulis harus diisi',
            'status.required' => 'Status harus diisi',
            'body.required' => 'Tulisan harus diisi'
        ]);

        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('blog/thumbnail',$name);
        }else{
            $name = $request->oldThumbnail;
        }

        $data = Posts::where('id',$request->id)->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'meta' => $request->meta,
            'thumbnail' => $name,
            'body' => $request->body,
            'status' => $request->status
        ]);

        return response()->json(['success','Berhasil tambah data']);
    }
}
