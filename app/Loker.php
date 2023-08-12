<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;
class Loker extends Model
{
    protected $table = 'lokers';
    protected $guarded = ['id'];


    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
}
