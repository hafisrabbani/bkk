<?php

namespace App;
use App\Loker;
Use App\Alumni;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companys';
    protected $guarded = ['id'];

    public static function checkRelations($id)
    {
        $check = Loker::where('company_id',$id)->get();
        $check2 = Alumni::where('instansi',$id)->get();
        if($check->isEmpty() || $check2->isEmpty()){
            return true;
        }else{
            return false;
        }
    }
}
