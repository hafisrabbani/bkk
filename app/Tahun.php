<?php

namespace App;
use App\Alumni;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    protected $table = 'tahuns';
    protected $guarded = ['id'];

    public function check($id)
    {
        $check = Alumni::where('lulusan',$id)->get();
        if($check->isEmpty()){
            return true;
        }else{
            return false;
        }
    }
}
