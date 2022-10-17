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


class TestController extends Controller
{
    public function test1()
    {
   //   return





          $data=MhmLoginCategory::
                with('ata')
              ->withCount('ata')
              ->get()
        ;



        return view('back.yoxla.test',compact('data'));
    }




    public function saxeli()
    {

   //     return

        $data=MhmLogin::
          with('cat')
          ->with('vez')
                    ->    selectRaw(
                        '
SUM( CASE WHEN cat_id = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,

                        cat_id,
                        vez_id,
                        login,
                        name,
                        qeyd'

                    )
            ->  groupBy('cat_id','vez_id','name')
            ->where('qeyd',1)
            ->orderBy('cat_id','ASC')
            ->get()
        ;

      //  return$count = $data->count();


        return view('back.yoxla.istifadeci',compact('data'));
    }

    public function skaf()
    {
 //   return
    $data=DB::table('nomre as N')
    //    ->where('rayon',1)
    //    ->where('herf','A')
    ->take(10)
    ->get();

        return view('test',compact('data'));


//        qruplamaq ve qrup sayi tapmaq + istenilen sutunlari cagirmaq

/*
      $T=DB::table('mhm_logins as log');
        $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));
        $T1=$T1->select('vez_id',
            'name',
            'login',
            $T1->raw('count(vez_id) as  vez_say')
        );
        return $T1=$T1
            ->groupBy('vez_id')
            ->take(150)->get();

tek stuna gore qruplamaq


       return $T=DB::table('mhm_logins as log')
        ->select('vez_id',
            DB::raw('count(vez_id) as  vez_say')
        )
            ->groupBy('vez_id')
            ->take(150)->get();
*/

        /*
              $T=DB::table('mhm_logins as log');
                $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));
                $T1=$T1->select('vez_id',
                    'name',
                    'login',
                    $T1->raw('count(vez_id) as  vez_say')
                );
                return $T1=$T1
                    ->groupBy('vez_id')
                    ->take(150)->get();

        tek stuna gore qruplamaq


               return $T=DB::table('mhm_logins as log')
                ->select('vez_id',
                    DB::raw('count(vez_id) as  vez_say')
                )
                    ->groupBy('vez_id')
                    ->take(150)->get();
        */





        /*

        $T = DB::table('mhm_logins as L')
            ->leftJoin('vezives as V', 'L.vez_id', '=', 'V.id')
            ->leftJoin('mhm_login_categories as C', 'L.cat_id', '=', 'C.id')
            ->select(
                'L.cat_id',
                'L.vez_id',
                'C.sobe as sobeler',
                'V.name as vezife',

                'L.login',
                'L.name as user',
                'L.qeyd'
            );
        $T1 = DB::table(DB::raw("({$T->toSql()}) as T1"));




        $T1 = $T1->select('T1.*',
            $T1->raw('
                    CASE
                    WHEN T1.qeyd IN(1) THEN "İstifadə edilir"
                    WHEN T1.qeyd IN(2) THEN "Müvəqqəti İstifadə edilmir"
                    ELSE "İşdən çıxıb"
                    END AS "Status",

                        	CASE
 		   	WHEN T1.cat_id IN (1)                        THEN "Rəhbər heyəti"
 		   	WHEN T1.cat_id IN (2)                        THEN "Müştəri xidmətləri satışı"
 		   	WHEN T1.cat_id IN (9)                        THEN "İnformasiya Texnologiyaları şöbəsi"
 		   	WHEN T1.cat_id IN (4)                        THEN "Texniki uçot və ekspertiza şöbəsi"
 		   	WHEN T1.cat_id IN (5)                        THEN "Marketinq və satış şöbəsi"
 		   	WHEN T1.cat_id IN (8)                        THEN "Mühasibat uçotu şöbəsi"
    	ELSE "Diger"
   		END AS "sobelerim"




                    '));

        $T2 = DB::table(DB::raw("({$T1->toSql()}) as T2"));

        $T3=$T2->select('T2.*',$T2->raw(
            '
SUM( CASE WHEN T2.sobelerim = "Mühasibat uçotu şöbəsi" THEN 1 ELSE 0 END ) as Mus_say,
SUM( CASE WHEN T2.sobelerim = "Rəhbər heyəti" THEN 1 ELSE 0 END ) as Reh_say,
SUM( CASE WHEN T2.sobelerim = "İnformasiya Texnologiyaları şöbəsi" THEN 1 ELSE 0 END ) as ITS_say

            '
        ));

return $T3=$T3->get();



        return  $T2=$T2
              ->groupBy('sobeler')
              ->orderBy('sobeler','ASC')
              ->get();
*/

        /*        $T4=$T3

                ->groupBy('Qrup')
                ->groupBy('T2.xidmetin_novu')
                ->groupBy(DB::raw('T2.tarif WITH ROLLUP'))
                //->orderBy('Qrup','DESC')
                ->take(150)
                ->get();*/




    }








//siyahi








}
