<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tarif;
use App\Models\esas;
use App\Models\elave;
use Illuminate\Support\Facades\DB;
use App\Models\edvyox;
use App\Models\gh_aet;
use App\Models\gelave_2109;
use App\Models\gesas_2109;
use App\Models\lstarif_2109;
use App\Models\bank_2021;
use App\Models\skaf;
use App\Models\kuce;
use App\Models\flabunes;


class TestController extends Controller
{
    public function skaf()
    {
 //   return
    $data=DB::table('nomre as N')
    //    ->where('rayon',1)
    //    ->where('herf','A')
    ->take(10)
    ->get();

        return view('test',compact('data'));
    }







}
