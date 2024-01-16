<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MhmLogin;
use App\Models\MhmLoginCategory;
use App\Models\User;
use App\Models\vezife;
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
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use GuzzleHttp\Cookie\CookieJar;


class TestController extends Controller
{

    public function vurma()
    {
return view('back.test.vurma');
    }

    public function api()
    {
        $response = Http::get('https://dailyprayer.abdulrcs.repl.co/api/Baku');
        $response->json();


        return view('back.test.api', compact('response'));
    }

    public function test1()
    {
        $data = MhmLoginCategory::
        with('ata')
            ->withCount('ata')
            ->get();
        return view('back.test.test', compact('data'));
    }
    public function saxeli()
    {
        $data = MhmLoginCategory::
        with('ata')
            ->withCount('ata')
            ->get();

        return view('back.test.istifadeci', compact('data'));
    }

    public function skaf()
    {
               $data = DB::table('nomre as N')
                   ->take(10)
                   ->get();

        return view('test', compact('data'));
    }


//siyahi


}
