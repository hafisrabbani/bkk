<?php

namespace App;
use App\Tahun;
use App\Company;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumnis';
    protected $guarded = ['id'];

    public function tahun()
    {
        return $this->belongsTo(Tahun::class,'lulusan');
    }

    public function instansis()
    {
        return $this->belongsTo(Company::class,'instansi','id');
    }
}
