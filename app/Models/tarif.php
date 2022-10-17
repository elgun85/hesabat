<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\esas;

class tarif extends Model
{
    use HasFactory;
        protected $fillable = [
        'kod',
        'name',
        'mebleg',
        'mebleg_q',
        'category',
            'novu',
        'qeyd1',
    ];



public function summa()
{
    return $this->where('mebleg');
}





}
