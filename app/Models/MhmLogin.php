<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\vezife;

class MhmLogin extends Model
{
    use HasFactory;
                protected $fillable=['cat_id','vez_id','login','password','name','qeyd'];



public function category()
{
            return   $this->hasMany('App\Models\MhmLoginCategory','id','cat_id');

}


public function vezife()
{
            return   $this->hasMany('App\Models\vezife','id','vez_id');

}

}
