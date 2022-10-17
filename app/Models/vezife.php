<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MhmLoginCategory;

class vezife extends Model
{
    use HasFactory;
   protected $fillable=['name'];





    public function Categoriler()
    {
        return $this->belongsTo(MhmLoginCategory::class);
    }

}
