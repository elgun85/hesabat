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
        $A=DB::
        table('skafes as S')
            ->join('esas as E','S.telefon', '=', 'E.telefon')
           ->join('flabunes as F','S.telefon', '=', 'F.telefon')
            ->join('kuces as K','F.kodkuce', '=', 'K.kod')
            ->select
            (
                'S.telefon',
                'S.ats',
                'S.skaf',
                'E.tarif',
                'E.abonent',
                'E.abonent2',
                'F.adabune',
                'F.kodkuce',
                'K.ad',
                'F.adres'
            )
        ;

          $A1=$A
           ->where('ats',32)
       // ->take(150)
           ->orderBy('telefon','ASC');
        $data=$A1->get();
        $say=$A1->count();

        return view('back.yoxla.xidmet',compact('data','say'));
    }

//    public function xidmet(Request $request)
//    {
//
//
//        $il = $request->il;
//        $ay = $request->ay;
//        $E=DB::table('gelave_2109s as E')
//              ->join('gesas_2109s as A',
//                function ($join) {
//                    $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
//                })
//            ->leftJoin('edvyox_2021 as L',
//                function ($join){
//                    $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
//                }
//            )
//
//            ->select('A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.summa','L.kateqor','A.ay','A.il');
//
//        $E1=DB::table(DB::raw("({$E->toSql()}) as E"));
//
//        $T=DB::table('gesas_2109s as A')
//            ->leftJoin('edvyox_2021 as L',
//                function ($join){
//                    $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
//                }
//            )
//            ->select('A.kodqurum','abonent','abonent2','kodtarif','summa','L.kateqor','A.ay','A.il')->
//            unionAll($E1);
//
//        $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));
//
//        $T1=$T1->select('T1.*',
//            $T1->raw('
//        CASE
//    		WHEN T1.abonent IN (1, 8) THEN "MENZIL"
//    		ELSE "IDERE"
//    		END AS "categoriya",
//
//	    CASE
// 		   	WHEN T1.kodtarif IN (701,707,708,721,723)                                         THEN "GPON"
// 		    WHEN T1.kodtarif IN (1,2,7,21,111)                                                THEN "Mis"
//    		WHEN T1.kodtarif IN (272,273,274,275,276,277,278,279,281,282,283,285,286,293,295) THEN "Servis"
//    		WHEN T1.kodtarif IN (6,8,36,49,61,235,289,349,907,920,925,926,928)                THEN "sair"
//
//
//    		WHEN T1.kodtarif IN (410,924,927,930,411)                                         THEN "ATS-lərdə qur.avad."
//    		WHEN T1.kodtarif IN (31,32,93,94,96,97)                                           THEN "BRX-dən ist.haqqı"
//    		WHEN T1.kodtarif IN (324,325,326)                                                 THEN "Ethernet"
//    		WHEN T1.kodtarif IN (543)                                                         THEN "Digər prov"
//    		WHEN T1.kodtarif IN (929)                                                         THEN "KTX"
//    		WHEN T1.kodtarif IN (39,46,48,51,53,54,58,59,60)                                  THEN "Rəqəmsal kanal"
//    		WHEN T1.kodtarif IN (391,392,396,397,398,399)                                     THEN "Kabel kan.icare"
//    		WHEN T1.kodtarif IN (368,369)                                                     THEN "FO lif"
//
//    		ELSE "basqa"
//   		END AS "xidmetin_novu"
//
//
//'));
//        $T2=DB::table(DB::raw("({$T1->toSql()}) as T2"));
//
//
//
////      return  $t2=$T2
////            ->take(15)
////            ->get();
//
//
//
//        $gelirler=$T2
//            ->select('T2.xidmetin_novu',
//                DB::raw('COALESCE( T2.xidmetin_novu,"Cəmi") as xidmetin_novu'),
//                $T2->raw('
//
//    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
//    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN T2.summa ELSE 0 END) as menzil_summa,
//
//    SUM( CASE WHEN T2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
//    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (23,33) THEN T2.summa ELSE 0 END) as idere_edv,
//    SUM( CASE WHEN T2.categoriya = "IDERE" THEN T2.summa ELSE 0 END) as idere_summa,
//
//    COUNT(*) as cemi_say,
//    SUM(T2.summa) as cemi_hesab
//
//     '));
//
//        $gelirler=$gelirler
//            ->where('ay',$ay)
//            ->where('il',$il)
//            ->where('xidmetin_novu', '!=', 'basqa')
//            ->groupBy(DB::raw('T2.xidmetin_novu WITH ROLLUP'))
//            ->take(150)
//            ->get();
//
//
//
//
//
//
//
//        return view('back.yoxla.xidmet', compact('gelirler'));
//    }





}
