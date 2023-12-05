<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flkart;
use App\Models\mhmhes;
use Carbon\Carbon;
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
use App\Models\mhm_ad;
use App\Models\flkart_x8;
use App\Models\lsqurum;
use Illuminate\Support\Benchmark;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = tarif::orderBy('id', 'DESC')->paginate(10);
        return view('back.yoxla.tarif', compact('data'));
    }

// *******************      aciqlama basla *****************************************************
public function aciqlama(Request $request)
{
    ini_set('max_execution_time', 180);


    $il = $request->il;
    $ay = $request->ay;
    $aylar=DB::table('flkart8 as B')
        -> select('ay', DB::raw('count(*) as total'))
        ->groupBy('ay')
        ->get();

    $iller=DB::table('flkart8 as B')
        -> select('il', DB::raw('count(*) as total'))
        ->groupBy('il')
        ->get();







    $E=DB::table('flkart_x8 as E')
        ->join('flkart8 as A',
            function ($join) {
                $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
            })
        ->leftJoin('edvyoxes as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )

        ->leftJoin('lstarif_2021 as T',
            function ($join){
                $join->on('E.kodtarif', '=', 'T.kodtarif');
            }
        )

        ->select('A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.summa','L.kateqor','T.adtarif','A.ay','A.il');

    $E1=DB::table(DB::raw("({$E->toSql()}) as E"));

   // return$T1=$E1->take(50)->get();

    $T=DB::table('flkart8 as A')
        ->leftJoin('edvyoxes as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )

        ->leftJoin('lstarif_2021 as T',
            function ($join){
                $join->on('A.kodtarif', '=', 'T.kodtarif');
            }
        )
        ->select('A.kodqurum','abonent','abonent2','A.kodtarif','summa','L.kateqor','adtarif','A.ay','A.il')->
        unionAll($E1);

    $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

   // return$T1=$T1->take(50)->get();

    $T1=$T1->select('T1.*',
        $T1->raw('
   /*     CASE
    		WHEN T1.abonent IN (1, 8) THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",*/

	    CASE
 		   	WHEN T1.kodtarif IN (707,708,721,723)                                         THEN "1.1 GPON"
 		    WHEN T1.kodtarif IN (1,2,7,10,21,111,349)                                            THEN "1.2 Mis"



    		WHEN T1.kodtarif IN (324,325,326,328,329)                                                 THEN "4.1.1 Ethernet"
    		WHEN T1.kodtarif IN (543,546)                                                     THEN "4.1.2 ISP-lərdən"
    		WHEN T1.kodtarif IN (39,46,48,51,53,54,58,59,60,321)                                  THEN "4.1.3 Rəqəmsal kanallar"

            WHEN T1.kodtarif IN (410,411)                                                         THEN "4.2.1 ATS-lərdə qur.avad."



    		WHEN T1.kodtarif IN (368,369)                                                     THEN "4.3.1 Fiber-optik lifdən istifadə"
    		WHEN T1.kodtarif IN (391,392,396,397,398,399,407)                                     THEN "4.3.2 Kabel kan.icare"
    		WHEN T1.kodtarif IN (929,924)                                                         THEN "4.3.3 KTX"
    		WHEN T1.kodtarif IN (31,32,93,94,96,97)                                           THEN "4.3.4 BRX-dən ist.haqqı"

    		WHEN T1.kodtarif IN (272,273,274,275,276,277,278,279,281,282,283,285,286,293,295) THEN "5.1.2 Servis haqqı"
    		WHEN T1.kodtarif IN (4,6,36,49,61,235,907,920,925,926,928)                          THEN "5.1.5 Mini ATS,3 rəqəmli pre.,NGN və s "
    		WHEN T1.kodtarif IN (8)                                                           THEN "5.1.6 Taksafon  dan."
    		WHEN T1.kodtarif IN (289)                                                         THEN "5.1.7 Texniki xidmət"

    		WHEN T1.kodtarif IN (927,930,931)                                                 THEN "6.2 Elektrik enerjisi"

    		ELSE "basqa"
   		END AS "xidmetin_novu"
'));
    $T2=DB::table(DB::raw("({$T1->toSql()}) as T2"));

   // return$T1=$T2->take(50)->get();
    $gelirler=$T2
        ->select('T2.xidmetin_novu','T2.kodtarif','T2.adtarif','summa',
            DB::raw('COALESCE( T2.xidmetin_novu," ") as xidmetin_novu'),
            $T2->raw('
   		CASE
   		WHEN T2.xidmetin_novu = "1.1 GPON"
   		  or T2.xidmetin_novu = "1.2 Mis"
   		    THEN    "1.0 Telefon xidmətləri"

   		WHEN T2.xidmetin_novu = "4.1.1 Ethernet"
   		  or T2.xidmetin_novu = "4.1.2 ISP-lərdən"
   		  or T2.xidmetin_novu = "4.1.3 Rəqəmsal kanallar"
   		    THEN    "4.1 İcarə haqqı (Portların  icarəsi)"

   		WHEN T2.xidmetin_novu = "4.2.1 ATS-lərdə qur.avad."
   		    THEN    "4.2 İcarə haqqı (Avadanlıqların icarəsi)"


   		WHEN T2.xidmetin_novu = "4.3.1 Fiber-optik lifdən istifadə"
   		  or T2.xidmetin_novu = "4.3.2 Kabel kan.icare"
   		  or T2.xidmetin_novu = "4.3.3 KTX"
   		  or T2.xidmetin_novu = "4.3.4 BRX-dən ist.haqqı"
   		    THEN    "4.3 İcarə haqqı (Kabellərin  icarəsi)"

   		WHEN T2.xidmetin_novu = "5.1.2 Servis haqqı"
   		  or T2.xidmetin_novu = "5.1.5 Mini ATS,3 rəqəmli pre.,NGN və s "
   		  or T2.xidmetin_novu = "5.1.6 Taksafon  dan."
   		  or T2.xidmetin_novu = "5.1.7 Texniki xidmət"
   		    THEN    "5. Servis (ƏDX)"

   		    WHEN T2.xidmetin_novu = "6.2 Elektrik enerjisi"
   		    THEN    "6. Digər"


   	 		ELSE "Sair xidmət başlıq"
   		END AS "Başlıq",

/*    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN T2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN T2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (21,31,71,23,33,73) THEN T2.summa ELSE 0 END) as idere_edv,
    SUM( CASE WHEN T2.categoriya = "IDERE" THEN T2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,*/

    /*SUM( CASE WHEN T2.xidmetin_novu = "5.1.2 Servis haqqı" THEN T2.summa ELSE 0 END) as Servis_haqqı_summa,*/
    SUM(T2.summa) as cemi_hesab

     '));
  //  return$T1=$gelirler->take(50)->get();


   $gelirler=$gelirler
        ->where('ay',$ay)
        ->where('il',$il)
        ->where('xidmetin_novu', '!=', 'basqa')
        ->groupByRaw('kodtarif')
       // ->groupBy(DB::raw('xidmetin_novu WITH ROLLUP'))
        ->orderBy('xidmetin_novu','asc')
        ->take(150)
        ->get()
      ->groupBy(function ($data)
      {
          return $data->xidmetin_novu;


      });



/*    $gelirler=$gelirler
        ->where('ay',$ay)
        ->where('il',$il)
        ->where('xidmetin_novu', '!=', 'basqa')
        ->groupBy('kodtarif')
      // ->groupBy('xidmetin_novu')
      //  ->groupBy(DB::raw('T2.xidmetin_novu WITH ROLLUP'))
       ->orderBy('xidmetin_novu','ASC')
        ->take(150)
        ->get()
      ->groupBy(function ($data)
      {
          return $data->xidmetin_novu;


      })
     ;*/


    return view('back.yoxla.aciqlama', compact('gelirler','aylar','iller'));
}
// *******************      aciqlama son *****************************************************
// *******************      Data_monthly basla *****************************************************
public function Data_monthly(Request $request)
{
    ini_set('max_execution_time', 180);


    $il = $request->il;
    $ay = $request->ay;
/*    $aylar=DB::table('bank_2021 as B')
        -> select('ay', DB::raw('count(*) as total'))
        ->groupBy('ay')
        ->get();

    $iller=DB::table('bank_2021 as B')
        -> select('il', DB::raw('count(*) as total'))
        ->groupBy('il')
        ->get();*/
if ($il)
{
    $E=DB::table('gelave_'.$il.' as E')
        ->join('gesas_'.$il.' as A',
            function ($join) {
                $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
            })
        ->leftJoin('edvyox_'.$il.' as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )

        ->select('A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.summa','L.kateqor','A.ay','A.il');

    $E1=DB::table(DB::raw("({$E->toSql()}) as E"));

    $T=DB::table('gesas_'.$il.' as A')
        ->leftJoin('edvyox_'.$il.' as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )
        ->select('A.kodqurum','abonent','abonent2','kodtarif','summa','L.kateqor','A.ay','A.il')->
        unionAll($E1);

    $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

    $T1=$T1->select('T1.*',
        $T1->raw('
        CASE
    		WHEN T1.abonent IN (1, 8) THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

	    CASE
	    	    /*701 tarif kodunu 01.06.2023-tarixden legv eledim   WHEN T1.kodtarif IN (707,708,721,723)    THEN "1.1 GPON"*/

 		   	WHEN T1.kodtarif IN (707,708,721,723)                                         THEN "1.1 GPON"
 		    WHEN T1.kodtarif IN (1,2,7,10,21,111,349)                                            THEN "1.2 Mis"



    		WHEN T1.kodtarif IN (324,325,326,328,329)                                                 THEN "4.1.1 Ethernet"
    		WHEN T1.kodtarif IN (543,546)                                                     THEN "4.1.2 ISP-lərdən"
    		WHEN T1.kodtarif IN (39,46,48,51,53,54,58,59,60,321)                                  THEN "4.1.3 Rəqəmsal kanallar"

            WHEN T1.kodtarif IN (410,411)                                                         THEN "4.2.1 ATS-lərdə qur.avad."



    		WHEN T1.kodtarif IN (368,369)                                                     THEN "4.3.1 Fiber-optik lifdən istifadə"
    		WHEN T1.kodtarif IN (391,392,396,397,398,399,407)                                     THEN "4.3.2 Kabel kan.icare"
    		WHEN T1.kodtarif IN (929,924)                                                         THEN "4.3.3 KTX"
    		WHEN T1.kodtarif IN (31,32,93,94,96,97)                                           THEN "4.3.4 BRX-dən ist.haqqı"

    		WHEN T1.kodtarif IN (272,273,274,275,276,277,278,279,281,282,283,285,286,293,295) THEN "5.1.2 Servis haqqı"
    		WHEN T1.kodtarif IN (4,6,36,49,61,235,907,920,925,926,928)                          THEN "5.1.5 Mini ATS,3 rəqəmli pre.,NGN və s "
    		WHEN T1.kodtarif IN (8)                                                           THEN "5.1.6 Taksafon  dan."
    		WHEN T1.kodtarif IN (289)                                                         THEN "5.1.7 Texniki xidmət"

    		WHEN T1.kodtarif IN (927,930,931)                                                 THEN "6.2 Elektrik enerjisi"

    		ELSE "basqa"
   		END AS "xidmetin_novu"
'));
    $T2=DB::table(DB::raw("({$T1->toSql()}) as T2"));


    $gelirler=$T2
        ->select('T2.xidmetin_novu',
            DB::raw('COALESCE( T2.xidmetin_novu," ") as xidmetin_novu'),
            $T2->raw('
   		CASE
   		WHEN T2.xidmetin_novu = "1.1 GPON"
   		  or T2.xidmetin_novu = "1.2 Mis"
   		    THEN    "1.0 Telefon xidmətləri"

   		WHEN T2.xidmetin_novu = "4.1.1 Ethernet"
   		  or T2.xidmetin_novu = "4.1.2 ISP-lərdən"
   		  or T2.xidmetin_novu = "4.1.3 Rəqəmsal kanallar"
   		    THEN    "4.1 İcarə haqqı (Portların  icarəsi)"

   		WHEN T2.xidmetin_novu = "4.2.1 ATS-lərdə qur.avad."
   		    THEN    "4.2 İcarə haqqı (Avadanlıqların icarəsi)"


   		WHEN T2.xidmetin_novu = "4.3.1 Fiber-optik lifdən istifadə"
   		  or T2.xidmetin_novu = "4.3.2 Kabel kan.icare"
   		  or T2.xidmetin_novu = "4.3.3 KTX"
   		  or T2.xidmetin_novu = "4.3.4 BRX-dən ist.haqqı"
   		    THEN    "4.3 İcarə haqqı (Kabellərin  icarəsi)"

   		WHEN T2.xidmetin_novu = "5.1.2 Servis haqqı"
   		  or T2.xidmetin_novu = "5.1.5 Mini ATS,3 rəqəmli pre.,NGN və s "
   		  or T2.xidmetin_novu = "5.1.6 Taksafon  dan."
   		  or T2.xidmetin_novu = "5.1.7 Texniki xidmət"
   		    THEN    "5. Servis (ƏDX)"

   		    WHEN T2.xidmetin_novu = "6.2 Elektrik enerjisi"
   		    THEN    "6. Digər"


   	 		ELSE "Sair xidmət başlıq"
   		END AS "Başlıq",

    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN T2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN T2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (21,31,71,23,33,73) THEN T2.summa ELSE 0 END) as idere_edv,
    SUM( CASE WHEN T2.categoriya = "IDERE" THEN T2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(T2.summa) as cemi_hesab

     '));

    $gelirler=$gelirler
        ->where('ay',$ay)
        ->where('il',$il)
        ->where('xidmetin_novu', '!=', 'basqa')
        ->groupBy('Başlıq')
        ->groupBy(DB::raw('T2.xidmetin_novu WITH ROLLUP'))
        //->orderBy('xidmetin_novu','DESC')
        ->take(150)
        ->get();

    //SEnedlesme

    $Ts=DB::table('bank_'.$il.' as Es')
        ->leftJoin('edvyox_'.$il.' as Ls',
            function ($join){
                $join->on('Es.kodqurum', '=', 'Ls.kodqurum')->on('Es.ay', '=', 'Ls.ay')->on('Es.il', '=', 'Ls.il');
            })
        ->select('Es.notel','Es.kodqurum','Es.kodxidmet','Es.summa','Ls.kateqor','Ls.kodmhm','Es.ay','Es.il');
    $Ts1=DB::table(DB::raw("({$Ts->toSql()}) as Ts1"));

    $Ts1=$Ts1->select('Ts1.*',
        $Ts1->raw('
        CASE
    		WHEN Ts1.kodqurum = 0 THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

	    CASE
 		   	WHEN Ts1.kodxidmet IN (101,102,103,104,105,107)                                         THEN "1. Telefon çəkilişi"
 		   	WHEN Ts1.kodxidmet IN (382,581,582,584,602,378)                                                 THEN "3. Avadanlıq satışı(GPON,LTE və s.)"
 		   	WHEN Ts1.kodxidmet IN (
5,121,123,131,135,136,151,171,262,299,342,345,521,533,542,545
 		   	)                                             THEN "2. Bərpa,A-Ada,nömrə dəy. və s."
 		   	WHEN Ts1.kodxidmet IN (109,372,373,374)                                         THEN "4. Smeta,Kabelləşmə və s."



    		ELSE "Digər"
   		END AS "xidmetin_novu"
'));
    $Ts2=DB::table(DB::raw("({$Ts1->toSql()}) as Ts2"));

    $senedlesme=$Ts2
        ->select('Ts2.xidmetin_novu',
            DB::raw('COALESCE( Ts2.xidmetin_novu,"Cəmi") as xidmetin_novu'),
            $Ts2->raw('

    SUM( CASE WHEN Ts2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN Ts2.categoriya = "MENZIL" THEN Ts2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN Ts2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN Ts2.categoriya = "IDERE" AND Ts2.kateqor IN (21,31,71,23,33,73) THEN Ts2.summa ELSE 0 END) as idere_edv,
    SUM( CASE WHEN Ts2.categoriya = "IDERE" THEN Ts2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(Ts2.summa) as cemi_hesab

     '));

    $senedlesme=$senedlesme
        ->where('ay',$ay)
        ->where('il',$il)
//        ->where('xidmetin_novu', '!=', '2. Bərpa,A-Ada,Sair')
        ->groupBy(DB::raw('Ts2.xidmetin_novu WITH ROLLUP'))
        ->take(150)
        ->get();




    return view('back.yoxla.Data_monthly', compact('gelirler','senedlesme'));
}else{
    return view('back.yoxla.Data_monthly');
}


  //  return view('back.yoxla.Data_monthly');
}

// *******************      Data_monthly son *****************************************************

// *******************      data_cari basla *****************************************************
    public function data_cari(Request $request)
    {
        ini_set('max_execution_time', 360);


        $il = $request->il;
        $ay = $request->ay;
        $aylar=DB::table('flkart8 as B')
            -> select('ay', DB::raw('count(*) as total'))
            ->groupBy('ay')
            ->get();

        $iller=DB::table('flkart8 as B')
            -> select('il', DB::raw('count(*) as total'))
            ->groupBy('il')
            ->get();

        $E=DB::table('flkart_x8 as E')
            ->join('flkart8 as A',
                function ($join) {
                    $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
                })
            ->leftJoin('edvyoxes as L',
                function ($join){
                    $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
                }
            )

            ->select('A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.summa','L.kateqor','A.ay','A.il');

        $E1=DB::table(DB::raw("({$E->toSql()}) as E"));

        $T=DB::table('flkart8 as A')
            ->leftJoin('edvyoxes as L',
                function ($join){
                    $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
                }
            )
            ->select('A.kodqurum','abonent','abonent2','kodtarif','summa','L.kateqor','A.ay','A.il')->
            unionAll($E1);

        $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

        $T1=$T1->select('T1.*',
            $T1->raw('
        CASE
    		WHEN T1.abonent IN (1, 8) THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

	    CASE
	    /*701 tarif kodunu 01.06.2023-tarixden legv eledim   WHEN T1.kodtarif IN (707,708,721,723)    THEN "1.1 GPON"*/
 		   	WHEN T1.kodtarif IN (707,708,721,723)                                         THEN "1.1 GPON"
 		    WHEN T1.kodtarif IN (1,2,7,10,21,111,349)                                            THEN "1.2 Mis"



    		WHEN T1.kodtarif IN (324,325,326,328,329)                                                 THEN "4.1.1 Ethernet"
    		WHEN T1.kodtarif IN (543,546)                                                     THEN "4.1.2 ISP-lərdən"
    		WHEN T1.kodtarif IN (39,46,48,51,53,54,58,59,60,321)                                  THEN "4.1.3 Rəqəmsal kanallar"

            WHEN T1.kodtarif IN (410,411)                                                         THEN "4.2.1 ATS-lərdə qur.avad."



    		WHEN T1.kodtarif IN (368,369)                                                     THEN "4.3.1 Fiber-optik lifdən istifadə"
    		WHEN T1.kodtarif IN (391,392,396,397,398,399,407)                                     THEN "4.3.2 Kabel kan.icare"
    		WHEN T1.kodtarif IN (929,924)                                                         THEN "4.3.3 KTX"
    		WHEN T1.kodtarif IN (31,32,93,94,96,97)                                           THEN "4.3.4 BRX-dən ist.haqqı"

    		WHEN T1.kodtarif IN (272,273,274,275,276,277,278,279,281,282,283,285,286,293,295) THEN "5.1.2 Servis haqqı"
    		WHEN T1.kodtarif IN (4,6,36,49,61,235,907,920,925,926,928)                          THEN "5.1.5 Mini ATS,3 rəqəmli pre.,NGN və s "
    		WHEN T1.kodtarif IN (8)                                                           THEN "5.1.6 Taksafon  dan."
    		WHEN T1.kodtarif IN (289)                                                         THEN "5.1.7 Texniki xidmət"

    		WHEN T1.kodtarif IN (927,930,931)                                                 THEN "6.2 Elektrik enerjisi"

    		ELSE "basqa"
   		END AS "xidmetin_novu"
'));
        $T2=DB::table(DB::raw("({$T1->toSql()}) as T2"));


        $gelirler=$T2
            ->select('T2.xidmetin_novu',
                DB::raw('COALESCE( T2.xidmetin_novu," ") as xidmetin_novu'),
                $T2->raw('
   		CASE
   		WHEN T2.xidmetin_novu = "1.1 GPON"
   		  or T2.xidmetin_novu = "1.2 Mis"
   		    THEN    "1.0 Telefon xidmətləri"

   		WHEN T2.xidmetin_novu = "4.1.1 Ethernet"
   		  or T2.xidmetin_novu = "4.1.2 ISP-lərdən"
   		  or T2.xidmetin_novu = "4.1.3 Rəqəmsal kanallar"
   		    THEN    "4.1 İcarə haqqı (Portların  icarəsi)"

   		WHEN T2.xidmetin_novu = "4.2.1 ATS-lərdə qur.avad."
   		    THEN    "4.2 İcarə haqqı (Avadanlıqların icarəsi)"


   		WHEN T2.xidmetin_novu = "4.3.1 Fiber-optik lifdən istifadə"
   		  or T2.xidmetin_novu = "4.3.2 Kabel kan.icare"
   		  or T2.xidmetin_novu = "4.3.3 KTX"
   		  or T2.xidmetin_novu = "4.3.4 BRX-dən ist.haqqı"
   		    THEN    "4.3 İcarə haqqı (Kabellərin  icarəsi)"

   		WHEN T2.xidmetin_novu = "5.1.2 Servis haqqı"
   		  or T2.xidmetin_novu = "5.1.5 Mini ATS,3 rəqəmli pre.,NGN və s "
   		  or T2.xidmetin_novu = "5.1.6 Taksafon  dan."
   		  or T2.xidmetin_novu = "5.1.7 Texniki xidmət"
   		    THEN    "5. Servis (ƏDX)"

   		    WHEN T2.xidmetin_novu = "6.2 Elektrik enerjisi"
   		    THEN    "6. Digər"


   	 		ELSE "Sair xidmət başlıq"
   		END AS "Başlıq",

    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN T2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN T2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (21,31,71,23,33,73) THEN T2.summa ELSE 0 END) as idere_edv,
    SUM( CASE WHEN T2.categoriya = "IDERE" THEN T2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(T2.summa) as cemi_hesab

     '));

        $gelirler=$gelirler
            ->where('ay',$ay)
            ->where('il',$il)
            ->where('xidmetin_novu', '!=', 'basqa')
            ->groupBy('Başlıq')
            ->groupBy(DB::raw('T2.xidmetin_novu WITH ROLLUP'))
            //->orderBy('xidmetin_novu','DESC')
            ->take(150)
            ->get();

        //SEnedlesme

        $Ts=DB::table('bankes as Es')
            ->leftJoin('edvyoxes as Ls',
                function ($join){
                    $join->on('Es.kodqurum', '=', 'Ls.kodqurum')->on('Es.ay', '=', 'Ls.ay')->on('Es.il', '=', 'Ls.il');
                })
            ->select('Es.notel','Es.kodqurum','Es.kodxidmet','Es.summa','Ls.kateqor','Ls.kodmhm','Es.ay','Es.il');
        $Ts1=DB::table(DB::raw("({$Ts->toSql()}) as Ts1"));

        $Ts1=$Ts1->select('Ts1.*',
            $Ts1->raw('
        CASE
    		WHEN Ts1.kodqurum = 0 THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

	    CASE
 		   	WHEN Ts1.kodxidmet IN (101,102,103,104,105,107)                                         THEN "1. Telefon çəkilişi"
 		   	WHEN Ts1.kodxidmet IN (382,581,582,584,602,378)                                                 THEN "3. Avadanlıq satışı(GPON,LTE və s.)"
 		   	WHEN Ts1.kodxidmet IN (
5,121,123,131,135,136,151,171,262,299,342,345,521,533,542,545
 		   	)                                             THEN "2. Bərpa,A-Ada,nömrə dəy. və s."
 		   	WHEN Ts1.kodxidmet IN (109,372,373,374)                                         THEN "4. Smeta,Kabelləşmə və s."



    		ELSE "Digər"
   		END AS "xidmetin_novu"
'));
        $Ts2=DB::table(DB::raw("({$Ts1->toSql()}) as Ts2"));

        $senedlesme=$Ts2
            ->select('Ts2.xidmetin_novu',
                DB::raw('COALESCE( Ts2.xidmetin_novu,"Cəmi") as xidmetin_novu'),
                $Ts2->raw('

    SUM( CASE WHEN Ts2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN Ts2.categoriya = "MENZIL" THEN Ts2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN Ts2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN Ts2.categoriya = "IDERE" AND Ts2.kateqor IN (21,31,71,23,33,73) THEN Ts2.summa ELSE 0 END) as idere_edv,
    SUM( CASE WHEN Ts2.categoriya = "IDERE" THEN Ts2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(Ts2.summa) as cemi_hesab

     '));

        $senedlesme=$senedlesme
            ->where('ay',$ay)
            ->where('il',$il)
//        ->where('xidmetin_novu', '!=', '2. Bərpa,A-Ada,Sair')
            ->groupBy(DB::raw('Ts2.xidmetin_novu WITH ROLLUP'))
            ->take(150)
            ->get();




        return view('back.yoxla.data_cari', compact('gelirler','senedlesme','aylar','iller'));

        //  return view('back.yoxla.Data_monthly');
    }

// *******************      data_cari son *****************************************************
// *******************      data_naz start *****************************************************
public function data_naz( Request $request)
{
    ini_set('max_execution_time', 180);


    $il = $request->il;
    $ay = $request->ay;
/*    $aylar=DB::table('bank_2021 as B')
        -> select('ay', DB::raw('count(*) as total'))
        ->groupBy('ay')
        ->get();

    $iller=DB::table('bank_2021 as B')
        -> select('il', DB::raw('count(*) as total'))
        ->groupBy('il')
        ->get();*/
if ($il or $ay)
{
    $E=DB::table('gelave_'.$il.' as E')
        ->join('gesas_'.$il.' as A',
            function ($join) {
                $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
            })
        ->leftJoin('edvyox_'.$il.' as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )

        ->select('A.kodqurum','A.notel','A.abonent','A.abonent2','E.kodtarif','E.hesab','E.summa','L.kateqor','A.ay','A.il');

    $E1=DB::table(DB::raw("({$E->toSql()}) as E"));


    $T=DB::table('gesas_'.$il.' as A')
        ->leftJoin('edvyox_'.$il.' as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )
        ->select('A.kodqurum','notel','abonent','abonent2','kodtarif','hesab','summa','L.kateqor','A.ay','A.il')->
        unionAll($E1);



    $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

/*    return $t=$T1
    ->where('hesab',98139)->take(150)->toSql();*/


    $T1=$T1->select('T1.*',
        $T1->raw('
        CASE
    		WHEN T1.abonent IN (1, 8) THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

	    CASE
	    	    /*701 tarif kodunu 01.06.2023-tarixden legv eledim   WHEN T1.kodtarif IN (707,708,721,723)    THEN "1.1 GPON"*/

 		   	WHEN T1.abonent IN (2) AND T1.kodtarif IN (707,708,721,723) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                      THEN "1.1 GPON"
 		    WHEN T1.abonent IN (2) AND T1.kodtarif IN (1,2,7,10,21,111,349) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                            THEN "1.2 Mis"


    		WHEN T1.abonent IN (2) AND T1.kodtarif IN (324,325,326,328,329)  AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                                THEN "4.1.1 Ethernet"
    		WHEN T1.abonent IN (1,2) AND  T1.hesab IN (98139)  AND T1.kodtarif IN (543,546)                                                  THEN "4.1.2 ISP-lərdən"
    		WHEN T1.kodtarif IN (39,46,48,51,53,54,58,59,60,321) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                  THEN "4.1.3 Rəqəmsal kanallar"

            WHEN T1.abonent IN (2) AND T1.kodtarif IN (410,411) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                                         THEN "4.2.1 ATS-lərdə qur.avad."



    		WHEN T1.abonent IN (2) AND T1.kodtarif IN (368,369) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                                     THEN "4.3.1 Fiber-optik lifdən istifadə"
    		WHEN T1.abonent IN (2) AND T1.kodtarif IN (391,392,396,397,398,399,407) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                     THEN "4.3.2 Kabel kan.icare"
    		WHEN T1.abonent IN (2) AND T1.kodtarif IN (929,924) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                                         THEN "4.3.3 KTX"
    		WHEN T1.abonent IN (2) AND T1.kodtarif IN (31,32,93,94,96,97) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                           THEN "4.3.4 BRX-dən ist.haqqı"

    		WHEN T1.abonent IN (2) AND T1.kodtarif IN (272,273,274,275,276,277,278,279,281,282,283,285,286,293,295) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014) THEN "5.1.2 Servis haqqı"
    		WHEN T1.abonent IN (2) AND T1.kodtarif IN (4,6,36,49,61,235,907,920,925,926,928) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                          THEN "5.1.5 Mini ATS,3 rəqəmli pre.,NGN və s "
    		WHEN T1.abonent IN (2) AND T1.kodtarif IN (8) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                                           THEN "5.1.6 Taksafon  dan."
    		WHEN T1.abonent IN (2) AND T1.kodtarif IN (289) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                                         THEN "5.1.7 Texniki xidmət"

    		WHEN T1.abonent IN (2) AND T1.kodtarif IN (927,930,931) AND T1.kodqurum IN (98088,98013,3956,98083,98039,98139,98014)                                                THEN "6.2 Elektrik enerjisi"

    		ELSE "basqa"
   		END AS "xidmetin_novu"
'));
    $T2=DB::table(DB::raw("({$T1->toSql()}) as T2"));



    $gelirler=$T2
        ->select('T2.xidmetin_novu',
            DB::raw('COALESCE( T2.xidmetin_novu," ") as xidmetin_novu'),
            $T2->raw('
   		CASE
   		WHEN T2.xidmetin_novu = "1.1 GPON"
   		  or T2.xidmetin_novu = "1.2 Mis"
   		    THEN    "1.0 Telefon xidmətləri"

   		WHEN T2.xidmetin_novu = "4.1.1 Ethernet"
   		  or T2.xidmetin_novu = "4.1.2 ISP-lərdən"
   		  or T2.xidmetin_novu = "4.1.3 Rəqəmsal kanallar"
   		    THEN    "4.1 İcarə haqqı (Portların  icarəsi)"

   		WHEN T2.xidmetin_novu = "4.2.1 ATS-lərdə qur.avad."
   		    THEN    "4.2 İcarə haqqı (Avadanlıqların icarəsi)"


   		WHEN T2.xidmetin_novu = "4.3.1 Fiber-optik lifdən istifadə"
   		  or T2.xidmetin_novu = "4.3.2 Kabel kan.icare"
   		  or T2.xidmetin_novu = "4.3.3 KTX"
   		  or T2.xidmetin_novu = "4.3.4 BRX-dən ist.haqqı"
   		    THEN    "4.3 İcarə haqqı (Kabellərin  icarəsi)"

   		WHEN T2.xidmetin_novu = "5.1.2 Servis haqqı"
   		  or T2.xidmetin_novu = "5.1.5 Mini ATS,3 rəqəmli pre.,NGN və s "
   		  or T2.xidmetin_novu = "5.1.6 Taksafon  dan."
   		  or T2.xidmetin_novu = "5.1.7 Texniki xidmət"
   		    THEN    "5. Servis (ƏDX)"

   		    WHEN T2.xidmetin_novu = "6.2 Elektrik enerjisi"
   		    THEN    "6. Digər"


   	 		ELSE "Sair xidmət başlıq"
   		END AS "Başlıq",

    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN T2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN T2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (21,31,71,23,33,73) THEN T2.summa ELSE 0 END) as idere_edv,
    SUM( CASE WHEN T2.categoriya = "IDERE" THEN T2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(T2.summa) as cemi_hesab

     '));

    $gelirler=$gelirler
        ->where('ay',$ay)
        ->where('il',$il)
        ->where('xidmetin_novu', '!=', 'basqa')
        ->groupBy('Başlıq')
        ->groupBy(DB::raw('T2.xidmetin_novu WITH ROLLUP'))
        ->take(150)
        ->get();

    //SEnedlesme

    $Ts=DB::table('bank_'.$il.' as Es')
        ->leftJoin('edvyox_'.$il.' as Ls',
            function ($join){
                $join->on('Es.kodqurum', '=', 'Ls.kodqurum')->on('Es.ay', '=', 'Ls.ay')->on('Es.il', '=', 'Ls.il');
            })
        ->select('Es.notel','Es.kodqurum','Es.kodxidmet','Es.summa','Ls.kateqor','Ls.kodmhm','Es.ay','Es.il');
    $Ts1=DB::table(DB::raw("({$Ts->toSql()}) as Ts1"));

    $Ts1=$Ts1->select('Ts1.*',
        $Ts1->raw('
        CASE
    		WHEN Ts1.kodqurum = 0 THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

	    CASE
 		   	WHEN Ts1.kodxidmet IN (101,102,103,104,105,107)                                         THEN "1. Telefon çəkilişi"
 		   	WHEN Ts1.kodxidmet IN (382,581,582,584,602,378)                                                 THEN "3. Avadanlıq satışı(GPON,LTE və s.)"
 		   	WHEN Ts1.kodxidmet IN (
5,121,123,131,135,136,151,171,262,299,342,345,521,533,542,545
 		   	)                                             THEN "2. Bərpa,A-Ada,nömrə dəy. və s."
 		   	WHEN Ts1.kodxidmet IN (109,372,373,374)                                         THEN "4. Smeta,Kabelləşmə və s."



    		ELSE "Digər"
   		END AS "xidmetin_novu"
'));
    $Ts2=DB::table(DB::raw("({$Ts1->toSql()}) as Ts2"));

    $senedlesme=$Ts2
        ->select('Ts2.xidmetin_novu',
            DB::raw('COALESCE( Ts2.xidmetin_novu,"Cəmi") as xidmetin_novu'),
            $Ts2->raw('

    SUM( CASE WHEN Ts2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN Ts2.categoriya = "MENZIL" THEN Ts2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN Ts2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN Ts2.categoriya = "IDERE" AND Ts2.kateqor IN (21,31,71,23,33,73) THEN Ts2.summa ELSE 0 END) as idere_edv,
    SUM( CASE WHEN Ts2.categoriya = "IDERE" THEN Ts2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(Ts2.summa) as cemi_hesab

     '));

    $senedlesme=$senedlesme
        ->where('ay',$ay)
        ->where('il',$il)
        ->whereIn('kodqurum',array(98088,98013,3956,98083,98039,98139,98014))
//        ->where('xidmetin_novu', '!=', '2. Bərpa,A-Ada,Sair')
        ->groupBy(DB::raw('Ts2.xidmetin_novu WITH ROLLUP'))
        ->take(150)
        ->get();


    return view('back.yoxla.data_naz', compact('gelirler','senedlesme'));
}
else{
    return view('back.yoxla.data_naz');
}
}
// *******************      data_naz son *****************************************************

// *******************     sen_edv start  *****************************************************
    public function sen_edv(Request $request)
    {
        $il = $request->il;
        $ay = $request->ay;

/*        $aylar=DB::table('bank_'.$il.' as B')
            -> select('ay', DB::raw('count(*) as total'))
            ->groupBy('ay')
            ->get();

        $iller=DB::table('bank_'.$il.' as B')
            -> select('il', DB::raw('count(*) as total'))
            ->groupBy('il')
            ->get();*/

if ($il) {

    $T = DB::table('bank_' . $il . ' as B')
        ->leftJoin('edvyox_' . $il . ' as L',
            function ($join) {
                $join->on('B.kodqurum', '=', 'L.kodqurum')->on('B.ay', '=', 'L.ay')->on('B.il', '=', 'L.il');
            })
        ->select('B.notel', 'B.kodqurum', 'B.kodxidmet', 'B.summa', 'L.adqurum', 'L.kateqor', 'L.kodmhm', 'B.ay', 'B.il');

    $T1 = DB::table(DB::raw("({$T->toSql()}) as T1"));


    $data = $T1
        ->where('ay', $ay)
        ->where('il', $il)
        ->whereIn('kateqor', array(21, 31, 71, 23, 33, 73))
        // ->groupBy('kateqor','kodqurum','summa','kodxidmet')

        ->get();


    $hes = $data->sum('summa');
    return view('back.yoxla.senedlesme_edvsiz', compact('data','hes'));

}else{


        return view('back.yoxla.senedlesme_edvsiz');
}
    }

// *******************     sen_edv son  *****************************************************

// *******************      hes_siyahi start  *****************************************************
    public function hes_siyahi(Request $request)
    {
        ini_set('max_execution_time', 180);



        $kat = $request->kat;
        $il = $request->il;
        $ay = $request->ay;
        $aylar=DB::table('flkart8 as B')
            -> select('ay', DB::raw('count(*) as total'))
            ->groupBy('ay')
            ->get();

        $iller=DB::table('flkart_x8 as B')
            -> select('il', DB::raw('count(*) as total'))
            ->groupBy('il')
            ->get();





        $E=DB::table('flkart_x8 as E')
            ->join('flkart8  as A',
                function ($join) {
                    $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
                })
            ->leftJoin('lsqurums as L',
                function ($join){
                    $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
                }
            )
            ->select('A.notel','A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.hesab','E.summa','L.adqurum','L.kateqor','L.kodmhm','A.ay','A.il');

        $E1=DB::table(DB::raw("({$E->toSql()}) as E1"));

       // return$E1=$E1->take(150)->get();

        $T=  DB::table('flkart8 as A')
            ->leftJoin('lsqurums as L',
                function ($join)
                {
                    $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
                }
            )
            ->select('A.notel','A.kodqurum','abonent','abonent2','kodtarif','hesab','summa','L.adqurum','L.kateqor','L.kodmhm','A.ay','A.il')->
            unionAll($E1);

        $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

       // return$T1=$T1->where('kodqurum',14885)->take(150)->get();

        $T1=$T1->select('T1.notel','kodqurum','kodtarif','T1.kodmhm','T1.hesab','T1.adqurum','T1.kateqor','ay','il',
            $T1->raw('

    /*COUNT(*) as cemi_say,*/

    SUM( CASE WHEN
    T1.kodtarif IN (
    	    /*701 tarif kodunu 01.06.2023-tarixden legv eledim   WHEN T1.kodtarif IN (707,708,721,723)    THEN "1.1 GPON"*/

    1,2,7,21,111,707,708,721,723,272,273,274,275,276,277,278,279,281,282,283,285,286,293,295,4,6,8,36,49,61,235,349,907,925,926,928,
    289,410,924,927,930,411,31,32,93,94,96,97,324,325,326,328,329,330,331,929,39,46,48,51,53,54,58,59,60,391,392,396,397,398,407,399,368,369,
    10,321,931
    ) THEN T1.summa ELSE 0 END) as hesablama,

        SUM( CASE WHEN
    T1.kodtarif IN (
    543,546,920
    ) THEN T1.summa ELSE 0 END) as prov_hes,

    SUM(T1.summa) as cemi_hesablama
')
        );


        if ($request->kat==1 or $request->kat==2)
        {
            $data=$T1
                ->where('ay',$ay)
                ->where('il',$il)
                ->where('T1.abonent',$kat)
                ->whereNotIn('T1.summa',[0])
                ->whereIn('T1.kodtarif',array(
                    1,2,7,21,111,707,708,721,723,272,273,274,275,276,277,278,279,281,282,283,285,286,293,295,4,6,8,36,49,61,235,349,907,925,926,928,
                    289,410,924,927,930,411,31,32,93,94,96,97,324,325,326,328,329,330,331,929,39,46,48,51,53,54,58,59,60,391,392,396,397,398,407,399,368,369,
                    10,321,931,
                    543,546,920
                ))
                ->groupBy(DB::raw('T1.notel WITH ROLLUP'))
                //  ->groupBy('T1.hesab')
                ->get();
            return view('back.yoxla.hes_siyahi', compact('data','aylar','iller'));

        }if ($request->kat==3)
    {
        $data=$T1
            ->where('ay',$ay)
            ->where('il',$il)
            ->whereNotIn('T1.summa',[0])
            ->whereIn('T1.kodtarif',array(
                1,2,7,21,111,707,708,721,723,272,273,274,275,276,277,278,279,281,282,283,285,286,293,295,4,6,8,36,49,61,235,349,907,925,926,928,
                289,410,924,927,930,411,31,32,93,94,96,97,324,325,326,328,329,330,331,929,39,46,48,51,53,54,58,59,60,391,392,396,397,398,407,399,368,369,
                10,321,931,
                543,546,920
            ))
            ->groupBy(DB::raw('T1.notel WITH ROLLUP'))
            //  ->groupBy('T1.hesab')
            ->get();
        return view('back.yoxla.hes_siyahi', compact('data','aylar','iller'));
    }
        if ($request->kat==4)
    {
        $data=$T1
            ->where('ay',$ay)
            ->where('il',$il)
            ->where('T1.abonent',2)
            ->whereNotIn('T1.summa',[0])
            ->whereIn('T1.kodtarif',array(
                1,2,7,21,111,707,708,721,723,272,273,274,275,276,277,278,279,281,282,283,285,286,293,295,4,6,8,36,49,61,235,349,907,925,926,928,
                289,410,924,927,930,411,31,32,93,94,96,97,324,325,326,328,329,330,331,929,39,46,48,51,53,54,58,59,60,391,392,396,397,398,407,399,368,369,
                10,321,931,
                543,546,920
            ))
            ->groupBy(DB::raw('T1.kodqurum WITH ROLLUP'))
            // ->groupBy('T1.hesab')
            ->get();
        return view('back.yoxla.hes_siyahi', compact('data','aylar','iller'));
    }
        if ($request->kat==5)
        {
            $data=$T1
                ->where('ay',$ay)
                ->where('il',$il)
               // ->where('T1.abonent',2)
                ->whereNotIn('T1.summa',[0])
                ->whereIn('T1.kodtarif',array(
                    543,546,920
                ))
                ->groupBy(DB::raw('T1.hesab WITH ROLLUP'))
                // ->groupBy('T1.hesab')
                ->get();
            return view('back.yoxla.hes_siyahi', compact('data','aylar','iller'));
        }






        return view('back.yoxla.hes_siyahi', compact('aylar','iller'));


    }
// *******************     hes_siyahi son  *****************************************************
// *******************     hes_yoxla5 start  *****************************************************
    public function hes_yoxla5(Request $request)
    {
        ini_set('max_execution_time', 180);

        $kat = $request->kat;
        $il = $request->il;
        $ay = $request->ay;
        $aylar=DB::table('flkart8 as B')
            -> select('ay', DB::raw('count(*) as total'))
            ->groupBy('ay')
            ->get();

        $iller=DB::table('flkart_x8 as B')
            -> select('il', DB::raw('count(*) as total'))
            ->groupBy('il')
            ->get();

        $E=DB::table('flkart_x8 as E')
            ->join('flkart8  as A',
                function ($join) {
                    $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
                })
            ->leftJoin('lsqurums as L',
                function ($join){
                    $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
                }
            )
            ->select('A.notel','A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.summa','L.adqurum','L.kateqor','L.kodmhm','A.ay','A.il');

        $E1=DB::table(DB::raw("({$E->toSql()}) as E1"));

        $T=  DB::table('flkart8 as A')
            ->leftJoin('lsqurums as L',
                function ($join)
                {
                    $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
                }
            )
            ->select('A.notel','A.kodqurum','abonent','abonent2','kodtarif','summa','L.adqurum','L.kateqor','L.kodmhm','A.ay','A.il')->
            unionAll($E1);

        $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

        $T1=$T1->select('T1.notel','kodqurum','T1.kodmhm','T1.summa','T1.adqurum','T1.kateqor','ay','il',
            $T1->raw('
    SUM(T1.summa) as cemi_hesablama
')
        );

        $data=$T1
            ->where('ay',$ay)
            ->where('il',$il)
            ->where('T1.abonent',$kat)
            ->whereNotIn('T1.summa',[0])
            //  ->where('notel',4374500)

            // ->whereIn('T1.kateqor',array(21,31,71,23,33,73))
            ->whereIn('T1.kodtarif',array(
                //111,235,543,546,920
                1,2,7,21,707,708,721,723,272,273,274,275,276,277,278,279,281,282,283,285,286,293,295,4,6,8,36,49,61,349,907,925,926,928,
                289,410,924,927,930,411,31,32,93,94,96,97,324,325,326,328,329,330,331,929,39,46,48,51,53,54,58,59,60,391,392,396,397,398,399,407,368,369
            ))
            ->groupBy(DB::raw('T1.notel WITH ROLLUP'))
            // ->take(10)
            ;


        $lArray=$data
           // ->take(10)
            ->get()
            ->keyBy('notel')
            ->toArray()
        ;


        $R=mhmhes::
        select(
            'notel','kodqurum', 'abonent','summa',
            DB::raw('SUM(summa) as cemi_hesablama'))
            ->where('abonent',$kat)
            ->groupBy(DB::raw('notel WITH ROLLUP'))   ;

        $mArray=$R
             ->get()
            ->keyBy('notel')
            ->toArray();
        $m=$R
            // ->take(500)
            ->get();


        $lks_hesablama=$data->get();
        $lks_toarray=$lArray;

        $mhm_hesablama=$m;
        $mhm_toarray=$mArray;









        return view('back.yoxla.hes_yoxla5', compact('aylar','iller','lks_hesablama','mhm_hesablama','lks_toarray','mhm_toarray'));
    }

// *******************     hes_yoxla2 son  *****************************************************

// *******************     hes_yoxla start  *****************************************************
public function hes_yoxla(Request $request)
{
    ini_set('max_execution_time', 180);



    $kat = $request->kat;
    $il = $request->il;
    $ay = $request->ay;

    $aylar=DB::table('flkart8 as B')
        -> select('ay', DB::raw('count(*) as total'))
        ->groupBy('ay')
        ->get();

    $iller=DB::table('flkart_x8 as B')
        -> select('il', DB::raw('count(*) as total'))
        ->groupBy('il')
        ->get();





    $E=DB::table('flkart_x8 as E')
        ->join('flkart8  as A',
            function ($join) {
                $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
            })
        ->leftJoin('lsqurums as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )
        ->select('A.notel','A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.summa','L.adqurum','L.kateqor','L.kodmhm','A.ay','A.il');

    $E1=DB::table(DB::raw("({$E->toSql()}) as E1"));


    $T=  DB::table('flkart8 as A')
        ->leftJoin('lsqurums as L',
            function ($join)
            {
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )
        ->select('A.notel','A.kodqurum','abonent','abonent2','kodtarif','summa','L.adqurum','L.kateqor','L.kodmhm','A.ay','A.il')->
        unionAll($E1);


    $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

    $T1=$T1->select('T1.notel','kodqurum','T1.kodmhm','T1.summa','T1.adqurum','T1.kateqor','ay','il',
        $T1->raw('

    /*COUNT(*) as cemi_say,*/
    SUM(T1.summa) as cemi_hesablama
')
    );

  $data=$T1
        ->where('ay',$ay)
        ->where('il',$il)
        ->where('T1.abonent',$kat)
        ->whereNotIn('T1.summa',[0])
        //  ->where('notel',4374500)

        // ->whereIn('T1.kateqor',array(21,31,71,23,33,73))
        ->whereIn('T1.kodtarif',array(
            //111,235,543,546,920
            1,2,7,21,707,708,721,723,272,273,274,275,276,277,278,279,281,282,283,285,286,293,295,4,6,8,36,49,61,349,907,925,926,928,
            289,410,924,927,930,411,31,32,93,94,96,97,324,325,326,328,329,330,331,929,39,46,48,51,53,54,58,59,60,391,392,396,397,398,399,407,368,369
        ))
        ->groupBy(DB::raw('T1.notel WITH ROLLUP'))
    // ->take(10)
        ->get();

      $mata=$data
          ->keyBy('notel')
          ->toArray()
    ;


      $R=mhmhes::
      select(
          'notel',
          'kodqurum',
          'abonent',
          'summa',
          DB::raw('SUM(summa) as cemi_hesablama'))

        ->where('abonent',$kat)
          ->groupBy(DB::raw('notel WITH ROLLUP'))
      ;
      $M=$R
          ->get()
          ->keyBy('notel')
          ->toArray();
      $L=$R
    // ->take(500)
      ->get();




    return view('back.yoxla.hes_yoxla2', compact('data','M','aylar','iller','mata','L'));
}

// *******************     hes_yoxla son  *****************************************************
// *******************      Hesablanma start  *****************************************************
public function hesablanma(Request $request)
{
    $telefon = $request->telefon;
    $il = $request->il;
    $ay = $request->ay;
    $aylar=DB::table('gesas_2021 as A')
        -> select('ay', DB::raw('count(*) as total'))
        ->groupBy('ay')
        ->get();

    $iller=DB::table('gesas_2021 as A')
        -> select('il', DB::raw('count(*) as total'))
        ->groupBy('il')
        ->get();


    $E=DB::table('gelave_2021 as E')
        ->join('gesas_2021  as A',
            function ($join) {
                $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
            })
        ->leftJoin('edvyox_2021 as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )
        ->select('A.notel','A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.summa','L.adqurum','L.kateqor','L.kodmhm','A.ay','A.il');

    $E1=DB::table(DB::raw("({$E->toSql()}) as E1"));




/*    $T=  DB::table('gesas_2021 as A')
        ->leftJoin('edvyox_2021 as L',
            function ($join)
            {
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )
        ->select('A.notel','A.kodqurum','abonent','abonent2','kodtarif','summa','L.adqurum','L.kateqor','L.kodmhm','A.ay','A.il')->
        unionAll($E1);*/

    $data=$E1
        ->where('notel',$telefon)


        ->take(150)
        ->groupBy('ay')
        ->get();
  //  dd($telefon) ;
    return view('back.yoxla.hesablanma', compact('data','aylar','iller'));

}

// *******************      Hesablanma son  *****************************************************
// *******************      senedlesme start  *****************************************************
    public function senedlesme(Request $request)
    {
        $il = $request->il;
        $ay = $request->ay;

        $aylar=DB::table('bank_2021 as B')
            -> select('ay', DB::raw('count(*) as total'))
            ->groupBy('ay')
            ->get();

        $iller=DB::table('bank_2021 as B')
            -> select('il', DB::raw('count(*) as total'))
            ->groupBy('il')
            ->get();


        $T=DB::table('bank_2021 as E')
            ->leftJoin('edvyox_2021 as L',
                function ($join){
                    $join->on('E.kodqurum', '=', 'L.kodqurum')->on('E.ay', '=', 'L.ay')->on('E.il', '=', 'L.il');
                })
            ->select('E.notel','E.kodqurum','E.kodxidmet','E.summa','L.kateqor','L.kodmhm','E.ay','E.il');
        $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

        $T1=$T1->select('T1.*',
            $T1->raw('
        CASE
    		WHEN T1.kodqurum = 0 THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

	    CASE
 		   	WHEN T1.kodxidmet IN (101,103,104,107,109)                                         THEN "1. Yeni cekilis"
/* 		   	WHEN T1.kodxidmet IN (121,151,171,299,378)                                         THEN "2. Bərpa,A-Ada,Sair"*/


    		ELSE "2. Bərpa,A-Ada,Sair"
   		END AS "xidmetin_novu"
'));
        $T2=DB::table(DB::raw("({$T1->toSql()}) as T2"));

        $data=$T2
            ->select('T2.xidmetin_novu',
                DB::raw('COALESCE( T2.xidmetin_novu,"Cəmi") as xidmetin_novu'),
                $T2->raw('

    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN T2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN T2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (21,31,71,23,33,73) THEN T2.summa ELSE 0 END) as idere_edv,

    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor NOT IN (21,31,71,23,33,73) THEN T2.summa ELSE 0 END) as idere_edv_li,


    SUM( CASE WHEN T2.kateqor IN (21,31,71,23,33,73) THEN T2.summa ELSE 0 END) as idere_edv_siz,
    SUM( CASE WHEN T2.categoriya = "IDERE" THEN T2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(T2.summa) as cemi_hesab

     '));



        $data=$data
            ->where('ay',$ay)
            ->where('il',$il)
//        ->where('xidmetin_novu', '!=', '2. Bərpa,A-Ada,Sair')
            ->groupBy(DB::raw('T2.xidmetin_novu WITH ROLLUP'))
            ->take(150)
            ->get();



        return view('back.yoxla.senedlesme', compact('data','aylar','iller'));

    }
// *******************      senedlesme finis  *****************************************************

// *******************      kod_tarif start  *****************************************************
public function kod_tarif(Request $request)
{
/*    $E=DB::table('flkart_x8 as E')
        ->join('flkart8 as A',
            function ($join) {
                $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
            })
        ->select('A.kodqurum','A.notel','A.abonent','A.abonent2','A.Kodtarif as tarifim','E.kodtarif','E.summa');
     $E2=DB::table(DB::raw("({$E->toSql()}) as El"));*/





    $kodtarif=$request->kodtarif;


    $tarifler=DB::table('lstarif_2021 as T')
        -> select('kodtarif','adtarif', DB::raw('count(*) as total'))
        ->groupBy('kodtarif')
        ->get();


   // dd($kodtarif);


    $E=DB::table('flkart_x8 as E')
        ->join('flkart8 as A',
            function ($join) {
                $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
            })
        ->leftJoin('lsqurums as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )
        ->leftJoin('lstarif_2021 as T','E.kodtarif', '=', 'T.kodtarif')

        ->select('A.kodqurum','A.notel','A.abonent','A.abonent2','E.kodtarif','L.adqurum','L.kodmhm','L.kateqor','E.summa',
            'E.hesab',
            'T.adtarif',
           // 'T.kodtarif as tarif',
            'A.ay','A.il');

    $E1=DB::table(DB::raw("({$E->toSql()}) as E"));

    //return $E1=$E1->take(150)->get();

    $T=DB::table('flkart8 as A')
        ->leftJoin('lsqurums as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )

        ->leftJoin('lstarif_2021 as T','A.kodtarif','=','T.kodtarif'     )



        ->select('A.kodqurum','notel','abonent','abonent2','A.kodtarif','L.adqurum','L.kodmhm','L.kateqor','summa',
        //   'T.koftarif as tarif',
        'hesab',
           'T.adtarif',
            'A.ay','A.il')->
        unionAll($E1);

   $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

   // return $E1=$T1->take(150)->toSql();



//dd($kodtarif);
if ($kodtarif!=0)
{
    $data=$T1
        -> whereIn('kodtarif',$kodtarif)
        ->take(250)
        ->get();
  //  dd($data);
}else{
    $data=$T1
        -> whereIn('kodtarif',array())
        ->take(150)
        ->get();

}

    return view('back.yoxla.kod_tarif',compact('data','tarifler'));
}

// *******************      kod_tarif finis  *****************************************************

    /****************         xidmet analizi basla          ***********************/
    public function xidmet()
    {
        $E=DB::table('flkart_x8 as F8')
            ->join('flkart8 as F', 'F8.notel', '=', 'F.notel')
            ->leftJoin('lstarif_2021 as L', 'F8.kodtarif', '=', 'L.kodtarif')
            ->select(
                'F8.kodtarif as tarif',
                'L.adtarif',
                'F8.notel',
                'F8.summa',
                'L.kodish',
                'F.abonent',
                'F.abonent2'
            );
        $E1=DB::table(DB::raw("({$E->toSql()}) as E1"));

        $T=DB::table('flkart8 as F')
            ->leftJoin('lstarif_2021 as L', 'F.kodtarif', '=', 'L.kodtarif')
            ->select('F.kodtarif as tarif',
                'adtarif',
                'notel',
                'summa',
                'kodish',
                'abonent',
                'abonent2'
            )->unionAll($E1);

        $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));


        $T1=$T1->select('T1.*',
            $T1->raw('
        CASE
    		WHEN T1.abonent IN (1, 8) THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

    	CASE
 		   	WHEN T1.tarif IN (1,2,7,21,111)                        THEN "Mis kabel"
 		   	WHEN T1.tarif IN (707,708,721,723)                        THEN "Gpon telefon"
 		   	WHEN T1.tarif IN (272,273,274,275,276,277,278,279,281,282,283,285,286,293,295)                        THEN "Servis telefon"
 		   	WHEN T1.tarif IN (6,8,36,49,61,235,289,349,907,925,926,928)                                          THEN "Digər_say"

 		   	WHEN T1.tarif IN (410,924,927,930,411)                        THEN "ATS-lərdə qur.avad"
 		   	WHEN T1.tarif IN (31,32,93,94,96,97)                        THEN "BRX-dən ist.haqqı"
 		   	WHEN T1.tarif IN (324,325,326,328,329)                        THEN "Ethernet"
 		   	WHEN T1.tarif IN (543,920)                        THEN "Digər prov"
 		   	WHEN T1.tarif IN (929)                        THEN "KTX"
 		   	WHEN T1.tarif IN (39,46,48,51,53,54,58,59,60)                        THEN "Rəqəmsal kanal"
 		   	WHEN T1.tarif IN (391,392,396,397,398,399,407)                        THEN "Kabel kan.icare"
 		   	WHEN T1.tarif IN (368,369)                        THEN "FO lif"

 		   	WHEN T1.tarif IN (437,444,447,806,812,813,814,851,852,877)                        THEN "Adsl"
 		   	WHEN T1.tarif   BETWEEN 609 AND 628                                           THEN "Aik"
 		   	WHEN T1.tarif   BETWEEN 701 AND 727                                           THEN "Gpon"
 		   	WHEN T1.tarif IN (815,827,305)                                                   THEN "Ip Tv"
 		   	WHEN T1.tarif IN (858,859,881,680,818,821,822,823,841)                                                   THEN "elave"

    	ELSE "Diger"

   		END AS "xidmetin_novu"

'));
        $T2=DB::table(DB::raw("({$T1->toSql()}) as T2"));


        $data=$T2
            ->select('T2.tarif','T2.adtarif','T2.categoriya','T2.xidmetin_novu',
                DB::raw('COALESCE( T2.tarif," ") as tarif'),
                $T2->raw('

   		CASE
   		WHEN T2.xidmetin_novu = "Mis kabel"
   		  or T2.xidmetin_novu = "Gpon telefon"
   		  or T2.xidmetin_novu = "Servis telefon"
   		  or T2.xidmetin_novu = "Digər_say"
   		    THEN    "Telefon"

   		WHEN T2.xidmetin_novu = "Adsl"
   		  or T2.xidmetin_novu = "Aik"
   		  or T2.xidmetin_novu = "Gpon"
   		  or T2.xidmetin_novu = "Ip Tv"
   		  or T2.xidmetin_novu = "elave"
   		    THEN    "Internet"
   		ELSE "Sair"
   		END AS "Qrup",

    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN T2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN T2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN T2.categoriya = "IDERE" THEN T2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(T2.summa) as cemi_hesab

     '));

    return    $data= $data
            //          ->orderBy('Qrup','DESC')

            ->groupBy('Qrup')
            ->groupBy('T2.xidmetin_novu')
            ->groupBy(DB::raw('T2.tarif WITH ROLLUP'))
            //->orderBy('Qrup','DESC')
            ->take(150)
            ->get();




        return view('back.yoxla.xidmet',compact('data'));

    }
    /****************         xidmet analizi son          ***********************/


// *******************      analiz  *****************************************************

    public function analiz()
    {


        $data = esas::join('elaves', 'esas.telefon', '=', 'elaves.telefon')
            ->join('tarifs', 'elaves.tarifs', '=', 'tarifs.kod')
            ->select(
                'tarifs.kod as kod',
                'tarifs.name as name',
                'elaves.summa as summa',
                'esas.abonent as abonent',
                'esas.abonent2 as abonentq'

            );
        $data = $data->select('kod', 'name',
            $data->raw('
                SUM(CASE WHEN abonent IN (1, 8) AND abonent2 = 0 THEN 1     ELSE 0 END) AS menzil_say,
                SUM(CASE WHEN abonent IN (1, 8) AND abonent2 = 0 THEN summa ELSE 0 END) AS menzil_sum,

                SUM(CASE WHEN abonent = 2 AND abonent2 = 0 THEN 1     ELSE 0 END) AS idare_say,
                SUM(CASE WHEN abonent = 2 AND abonent2 = 0 THEN summa ELSE 0 END) AS idare_sum,

                SUM(CASE WHEN abonent = 1 AND abonent2 = 2 THEN 1     ELSE 0 END) AS qurum_say,
                SUM(CASE WHEN abonent = 1 AND abonent2 = 2 THEN summa ELSE 0 END) AS qurum_sum,

                SUM(CASE WHEN abonent IN (1, 8, 2) AND abonent2 IN (0, 2) THEN 1     ELSE 0 END) AS cemi_say,
                SUM(CASE WHEN abonent IN (1, 8, 2) AND abonent2 IN (0, 2) THEN summa ELSE 0 END) AS cemi_sum



'))
            ->orderBy('kod', 'Asc')
            ->groupBY('kod', 'name');


        $data = $data->get();

        $menzil_say = $data->sum('menzil_say');
        $idare_say = $data->sum('idare_say');
        $qurum_say = $data->sum('qurum_say');
        $cemi_say = $data->sum('cemi_say');
        $menzil_sum = $data->sum('menzil_sum');
        $idare_sum = $data->sum('idare_sum');
        $qurum_sum = $data->sum('qurum_sum');
        $cemi_sum = $data->sum('cemi_sum');

        $cemi = array($menzil_say, $menzil_sum, $idare_say, $idare_sum, $qurum_say, $qurum_sum, $cemi_say, $cemi_sum);


        return view('back.yoxla.analiz2', compact('data', 'cemi'));
    }

    // *******************      texniki verilenler basla  *****************************************************

    public function texniki(Request $request){
        $atsler=skaf::
        select('ats', DB::raw('count(*) as total'))
            ->groupBy('ats')
            -> take(150)
            ->get();
        $data=DB::table('skafs as S')
            ->join('mhm_ads as M', 'S.telefon', '=', 'M.telefon')
            ->join('flkart8 as F', 'S.telefon', '=', 'F.notel')
            ->select('S.telefon','S.ats','S.skaf','M.ad','M.unvan','F.kodtarif as tarif','F.abonent')
            ->where('ats',$request->ats)
            //   ->whereNotIn('kodtarif', [707,708,721,723])
            ->orderBy('telefon','ASC')
            ->get();
        $say=$data->count();


        return view('back.yoxla.texniki',compact('atsler','data','say'));
    }

// *******************      texniki verilenler son *****************************************************




// *******************      Gelir  *****************************************************
    public function gelir(Request $request)
    {

        ini_set('max_execution_time', 180);


        $il = $request->il;
        $ay = $request->ay;
        $aylar=DB::table('bank_2021 as B')
            -> select('ay', DB::raw('count(*) as total'))
            ->groupBy('ay')
            ->get();

        $iller=DB::table('bank_2021 as B')
            -> select('il', DB::raw('count(*) as total'))
            ->groupBy('il')
            ->get();

 $E=DB::table('gelave_2021 as E')
         ->join('gesas_2021 as A',
     function ($join) {
         $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
     })
     ->leftJoin('edvyox_2021 as L',
         function ($join){
         $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
     }
     )

    ->select('A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.summa','L.kateqor','A.ay','A.il');

  $E1=DB::table(DB::raw("({$E->toSql()}) as E"));

 $T=DB::table('gesas_2021 as A')
     ->leftJoin('edvyox_2021 as L',
         function ($join){
             $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
         }
     )
     ->select('A.kodqurum','abonent','abonent2','kodtarif','summa','L.kateqor','A.ay','A.il')->
        unionAll($E1);

 $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

 $T1=$T1->select('T1.*',
    $T1->raw('
        CASE
    		WHEN T1.abonent IN (1, 8) THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

	    CASE
 		   	WHEN T1.kodtarif IN (707,708,721,723)                                         THEN "GPON"
 		    WHEN T1.kodtarif IN (1,2,7,21,111)                                                THEN "Mis"
    		WHEN T1.kodtarif IN (272,273,274,275,276,277,278,279,281,282,283,285,286,293,295) THEN "Servis"
    		WHEN T1.kodtarif IN (4,6,8,36,49,61,235,349,907,920,925,926,928)                THEN "Sair xidmət "
    		WHEN T1.kodtarif IN (289)                                                       THEN "Sair tex xid"

    		WHEN T1.kodtarif IN (410,924,927,930,411)                                         THEN "ATS-lərdə qur.avad."
    		WHEN T1.kodtarif IN (31,32,93,94,96,97)                                           THEN "BRX-dən ist.haqqı"
    		WHEN T1.kodtarif IN (324,325,326,328,329)                                                 THEN "Ethernet"
    		WHEN T1.kodtarif IN (543)                                                         THEN "Digər prov"
    		WHEN T1.kodtarif IN (929)                                                         THEN "KTX"
    		WHEN T1.kodtarif IN (39,46,48,51,53,54,58,59,60)                                  THEN "Rəqəmsal kanal"
    		WHEN T1.kodtarif IN (391,392,396,397,398,399,407)                                     THEN "Kabel kan.icare"
    		WHEN T1.kodtarif IN (368,369)                                                     THEN "FO lif"

    		ELSE "basqa"
   		END AS "xidmetin_novu"
'));
        $T2=DB::table(DB::raw("({$T1->toSql()}) as T2"));



     $gelirler=$T2
         ->select('T2.xidmetin_novu',
             DB::raw('COALESCE( T2.xidmetin_novu,"Cəmi") as xidmetin_novu'),
             $T2->raw('

    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN T2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN T2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (21,31,71,23,33,73) THEN T2.summa ELSE 0 END) as idere_edv,
    SUM( CASE WHEN T2.categoriya = "IDERE" THEN T2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(T2.summa) as cemi_hesab

     '));

        $gelirler=$gelirler
             ->where('ay',$ay)
             ->where('il',$il)
             ->where('xidmetin_novu', '!=', 'basqa')
             ->groupBy(DB::raw('T2.xidmetin_novu WITH ROLLUP'))
             ->take(150)
             ->get();

        //SEnedlesme

        $Ts=DB::table('bank_2021 as Es')
            ->leftJoin('edvyox_2021 as Ls',
                function ($join){
                    $join->on('Es.kodqurum', '=', 'Ls.kodqurum')->on('Es.ay', '=', 'Ls.ay')->on('Es.il', '=', 'Ls.il');
                })
            ->select('Es.notel','Es.kodqurum','Es.kodxidmet','Es.summa','Ls.kateqor','Ls.kodmhm','Es.ay','Es.il');
        $Ts1=DB::table(DB::raw("({$Ts->toSql()}) as Ts1"));

        $Ts1=$Ts1->select('Ts1.*',
            $Ts1->raw('
        CASE
    		WHEN Ts1.kodqurum = 0 THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",

	    CASE
 		   	WHEN Ts1.kodxidmet IN (101,103,104,107,109)                                         THEN "1. Yeni cekilis"
/* 		   	WHEN Ts1.kodxidmet IN (121,151,171,299,378)                                         THEN "2. Bərpa,A-Ada,Sair ödəniş"*/


    		ELSE "2. Bərpa,A-Ada,Sair"
   		END AS "xidmetin_novu"
'));
        $Ts2=DB::table(DB::raw("({$Ts1->toSql()}) as Ts2"));

        $senedlesme=$Ts2
            ->select('Ts2.xidmetin_novu',
                DB::raw('COALESCE( Ts2.xidmetin_novu,"Cəmi") as xidmetin_novu'),
                $Ts2->raw('

    SUM( CASE WHEN Ts2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN Ts2.categoriya = "MENZIL" THEN Ts2.summa ELSE 0 END) as menzil_summa,

    SUM( CASE WHEN Ts2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,
    SUM( CASE WHEN Ts2.categoriya = "IDERE" AND Ts2.kateqor IN (21,31,71,23,33,73) THEN Ts2.summa ELSE 0 END) as idere_edv,
    SUM( CASE WHEN Ts2.categoriya = "IDERE" THEN Ts2.summa ELSE 0 END) as idere_summa,

    COUNT(*) as cemi_say,
    SUM(Ts2.summa) as cemi_hesab

     '));

        $senedlesme=$senedlesme
            ->where('ay',$ay)
            ->where('il',$il)
//        ->where('xidmetin_novu', '!=', '2. Bərpa,A-Ada,Sair')
            ->groupBy(DB::raw('Ts2.xidmetin_novu WITH ROLLUP'))
            ->take(150)
            ->get();




        return view('back.yoxla.gelir_sened', compact('gelirler','senedlesme','aylar','iller'));
    }
// *******************      Gelir son  *****************************************************


// *******************      texXid basla  *****************************************************


public function texXid(Request $request)
{
    ini_set('max_execution_time', 300);

    $il = $request->il;
    $ay = $request->ay;
    $aylar=DB::table('gelave_2021 as B')
        -> select('ay', DB::raw('count(*) as total'))
        ->groupBy('ay')
        ->get();

    $iller=DB::table('gelave_2021 as B')
        -> select('il', DB::raw('count(*) as total'))
        ->groupBy('il')
        ->get();

     $E=DB::table('gelave_2021 as E')
          ->join('gesas_2021  as A',
            function ($join) {
                $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
            })
        ->leftJoin('edvyox_2021 as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )

        ->select('A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.summa','L.kateqor','A.ay','A.il');



    $E1=DB::table(DB::raw("({$E->toSql()}) as E"));

    $T=  DB::table('gesas_2021 as A')
           ->leftJoin('edvyox_2021 as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )
        ->select('A.kodqurum','abonent','abonent2','kodtarif','summa','L.kateqor','A.ay','A.il')->
        unionAll($E1);

    $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));

    $T1=$T1->select('T1.*',
        $T1->raw('
        CASE
    		WHEN T1.abonent IN (1, 8) THEN "MENZIL"
    		ELSE "IDERE"
    		END AS "categoriya",
	    CASE
    		WHEN T1.kodtarif IN (289)                                                       THEN "Sair tex xid"
    		/*ELSE "basqa"*/
   		END AS "xidmetin_novu"
'));
    $T2=DB::table(DB::raw("({$T1->toSql()}) as T2"));



    $data=$T2
        ->select('T2.xidmetin_novu',
            DB::raw('COALESCE( T2.xidmetin_novu,"Cəmi") as xidmetin_novu'),
            $T2->raw('

/*    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN 1 ELSE 0 END ) as menzil_say,
    SUM( CASE WHEN T2.categoriya = "MENZIL" THEN T2.summa ELSE 0 END) as menzil_summa,*/

/*    SUM( CASE WHEN T2.categoriya = "IDERE" THEN 1 ELSE 0 END ) as idere_say,*/
    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (21,31,71,23,33,73) THEN T2.summa ELSE 0 END) as idere_edv,
/*    SUM( CASE WHEN T2.categoriya = "IDERE" THEN T2.summa ELSE 0 END) as idere_summa,*/

    COUNT(*) as cemi_say,
    SUM(T2.summa) as cemi_hesab
     '));

    $data=$data
        ->where('ay',$ay)
        ->where('il',$il)
        ->where('xidmetin_novu', '!=', 'basqa')
        ->groupBy(DB::raw('T2.xidmetin_novu WITH ROLLUP'))
        ->take(150)
        ->get();


    return view('back.yoxla.texXid', compact('data','aylar','iller'));
}

// *******************      texXid son  *****************************************************
// *******************      siyahi start  *****************************************************
public function siyahi(Request $request)
{
    ini_set('max_execution_time', 180);


    $il = $request->il;
    $ay = $request->ay;
    $aylar=DB::table('gesas_2023 as B')
        -> select('ay', DB::raw('count(*) as total'))
        ->groupBy('ay')
        ->get();

    $iller=DB::table('gesas_2023 as B')
        -> select('il', DB::raw('count(*) as total'))
        ->groupBy('il')
        ->get();





    $E=DB::table('gelave_2023 as E')
        ->join('gesas_2023  as A',
            function ($join) {
                $join->on('E.notel', '=', 'A.notel')->on('E.ay', '=', 'A.ay')->on('E.il', '=', 'A.il');
            })
        ->leftJoin('edvyox_2023 as L',
            function ($join){
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )
        ->select('A.kodqurum','A.abonent','A.abonent2','E.kodtarif','E.summa','L.kateqor','L.kodmhm','A.ay','A.il');

        $E1=DB::table(DB::raw("({$E->toSql()}) as E1"));


    $T=  DB::table('gesas_2023 as A')
        ->leftJoin('edvyox_2023 as L',
            function ($join)
            {
                $join->on('A.kodqurum', '=', 'L.kodqurum')->on('A.ay', '=', 'L.ay')->on('A.il', '=', 'L.il');
            }
        )
        ->select('A.kodqurum','abonent','abonent2','kodtarif','summa','L.kateqor','L.kodmhm','A.ay','A.il')->
        unionAll($E1);

    $T1=DB::table(DB::raw("({$T->toSql()}) as T1"));
   // return $T1->where('ay',10)->where('il',2023)->where('kodqurum',6702)->take(150)->get();

    $T1=$T1->select('T1.kodqurum','T1.kodmhm',
        $T1->raw('

    COUNT(*) as cemi_say,
    SUM(T1.summa) as cemi_hesablama

')
    );



 $data=$T1
    ->where('ay',$ay)
    ->where('il',$il)

    ->whereIn('T1.kateqor',array(21,31,71,23,33,73))
    ->whereIn('T1.kodtarif',array(
        1,2,7,21,111,707,708,721,723,272,273,274,275,276,277,278,279,281,282,283,285,286,293,295,4,6,8,36,49,61,235,349,907,925,926,928,
        289,410,924,927,930,411,31,32,93,94,96,97,324,325,326,328,329,330,331,929,39,46,48,51,53,54,58,59,60,391,392,396,397,398,399,407,368,369

    ))
  //  ->groupBy('T1.kodqurum')
    ->groupBy(DB::raw('T1.kodqurum WITH ROLLUP'))
    ->take(150)
    ->get();






    return view('back.yoxla.siyahi', compact('data','aylar','iller'));
}
// *******************      siyahi son  *****************************************************

// *******************      tarifSelect  *****************************************************


    public function tarifSelect(Request $request)
    {

        $esas = $request->esas;
        $kod = array($request->kod);
        $abonent = $request->abonent;
        $abonent2 = $request->abonent2;
        $siyahi = $request->siyahi;

        $data_esas = esas::
        leftJoin('elaves', 'esas.telefon', '=', 'elaves.telefon')
            ->select('esas.telefon', 'esas.hesab', 'esas.tarif', 'esas.abonent', 'esas.abonent2', 'elaves.tarifs');
        if ($esas)
        {
            foreach ($kod as $gp)
                $data_esas = $data_esas->where('tarif', $esas)->whereIn('tarifs', $gp)->where('abonent', $abonent)->where('abonent2', $abonent2);
        }

        if ($kod)
        {
            foreach ($kod as $internet)
                $data_esas = $data_esas->whereIn('tarifs', $internet);
        }

        if ($abonent)
        {
            $data_esas = $data_esas->where('abonent', $abonent)->where('abonent2', $abonent2);
        }

        if ($abonent2)
        {
            $data_esas = $data_esas->where('abonent', $abonent)->where('abonent2', $abonent2);
        }

        if ($siyahi) {

            $data_esas = $data_esas->where('tarif', $siyahi)->where('abonent', $abonent)->where('abonent2', $abonent2);
        }


        $data_esas = $data_esas->get();
        $tarifler = tarif::get();

        return view('back.yoxla.Tselect', compact('data_esas', 'tarifler'));

    }


    /****************         telyoxla          ***********************/

    public function telyoxla(Request $request)
    {
        $category = $request->category;
        $novu = $request->novu;

        $data = tarif::orderBy('kod', 'ASC');
        if ($category) {
            $data = $data->where('category', $category);
        }

        if ($novu) {
            $data = $data->where('novu', $novu);
        }

        $data = $data->get();

        return view('back.yoxla.telyoxla', compact('data', 'category'));
    }

    /****************         telyoxlaS          ***********************/



    public function telyoxlaS(Request $request)
    {
//        $category=$request->category;
//        $novu=$request->novu;

        $esas = $request->esas;
        $abonent = $request->abonent;
        $abonent2 = $request->abonent2;
        $internet = $request->internet;
        $diger = $request->diger;
        $elave = $request->elave;
        $telefonlarim = $request->telefonlarim;


        $data = esas::leftJoin('elaves', 'esas.telefon', '=', 'elaves.telefon')
            ->select('esas.telefon', 'esas.hesab', 'esas.tarif', 'esas.abonent', 'esas.abonent2', 'elaves.tarifs');

        if ($esas) {
            $data = $data->where('tarif', $esas);
        }

        if ($abonent) {
            $data = $data->where('abonent', $abonent);
        }


        if ($abonent2) {
            $data = $data->where('abonent2', $abonent2);
        }

        if ($abonent2 === '0') {
            $data = $data->where('abonent2', $abonent2);
        }
        if ($internet) {
            $data = $data->whereIn('tarifs', $internet);
        }

        if ($diger) {
            $data = $data->where('tarif', $diger);
        }

        if ($elave) {

            $data = $data->where('tarifs', $elave);
        }
/*        else
            return back()->with('message',' Tapilmadi');*/



// $data=$data->where('telefon',$telefonlarim);
        $data = $data->get();



        $tarifler = tarif::get();

        $axtar = $data->first();


        $say_qur = $data->Where('abonent', 2)->where('abonent2', 0)->count();
        $say_men = $data->Where('abonent', 1)->where('abonent2', 0)->count();
        $say_menq = $data->Where('abonent', 1)->where('abonent2', 2)->count();
        //     $cemi=$data->count();
        $cemi = ($say_men + $say_qur + $say_menq);


        return view('back.yoxla.telyoxlaT', compact('data', 'tarifler', 'say_qur', 'say_men', 'say_menq', 'axtar', 'cemi'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kod' => 'max:10|unique:tarifs',
            'name' => 'required|max:50',
            'mebleg' => 'required|max:20',
            'mebleg_q' => 'required|max:20',
            'category' => 'required|max:50',
            'novu' => 'required|max:50',
            'qeyd1' => 'max:255',

        ]);
        tarif::create($request->post());
        return redirect()->route('tarif.index')->with('message', ' Uğurla icra olundu!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarif = tarif::find($id) ?? abort(404, 'bele sehife yoxdur');
        $data = tarif::orderBy('id', 'ASC')->paginate(5);
        return view('back.yoxla.tarifU', compact('tarif', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kod' => 'max:10',
            'name' => 'required|max:50',
            'mebleg' => 'required|max:20|',
            'mebleg_q' => 'required|max:20',
            'category' => 'required|max:50',
            'novu' => 'required|max:50',
            'qeyd1' => 'max:255',

        ]);
        $data = tarif::findOrFail($id);
        $data->update($request->except(['_method', '_token']));
        return redirect()->route('tarif.index')->with('message', ' Uğurla Deyisdirildi!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = tarif::find($id) ?? abort(404, 'bele sehife yoxdur');

        $data->delete();
        return redirect()->route('tarif.index')->with('message', ' Uğurla Silindi');
    }


    public function multipleusersdelete(Request $request)
    {
        $id = $request->id;
        foreach ($id as $user) {
            tarif::where('id', $user)->delete();
        }
        return redirect()->route('tarif.index')->with('message', ' Seçilənlər Uğurla Silindi');

    }
}
