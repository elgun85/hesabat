<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\elave;

class esas extends Model
{
    use HasFactory;

//
public function menzil()
{
    return esas::where('abonent',1);

}

}
