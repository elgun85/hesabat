<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class elave extends Model
{
    use HasFactory;

    public function say()
    {
        $this->where('kod');
    }
}
