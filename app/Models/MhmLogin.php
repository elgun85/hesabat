<?php

namespace App\Models;



use App\Http\Controllers\Admin\MhmLoginController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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





public function cat()
{
    return $this->hasOne(MhmLoginCategory::class,'id','cat_id');
}

    public function vez()
    {
        return $this->hasMany(vezife::class,'id','vez_id')->orderBy('sira','Desc');
    }







}
