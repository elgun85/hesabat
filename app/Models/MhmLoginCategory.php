<?php

namespace App\Models;

use App\Models\MhmLogin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vezife;


class MhmLoginCategory extends Model
{
    use HasFactory;
            protected $fillable=['sobe'];


public function cat()
{
    return $this->hasMany(MhmLogin::class,'cat_id','id')->where('qeyd',1);
}


    public function vezifem()
    {
        return   $this->hasMany(vezife::class,'cat_id','id');

    }





public function vezim()
{
    return $this->belongsTo(vezife::class);
}
public function login()
{
    return $this->belongsTo(MhmLogin::class);
}


public function ata()
{
    return $this->hasMany(MhmLogin::class,'cat_id')->with('vez')->where('qeyd',1);
}





}
