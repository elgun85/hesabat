<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\mhm_ad;

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



//        $edv=$T1
//       ->select('T1.kodxidmet','T1.summa','T1.kodmhm')
//       ->whereNotIn('T1.kateqor', array(23,33))
////        ->whereIn('T1.kateqor', array(23,33))
//       ->groupBy('T1.kodxidmet','T1.kodmhm')
//        ->get();


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
    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (23,33) THEN T2.summa ELSE 0 END) as idere_edv,

    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor NOT IN (23,33) THEN T2.summa ELSE 0 END) as idere_edv_li,


    SUM( CASE WHEN T2.kateqor IN (23,33) THEN T2.summa ELSE 0 END) as idere_edv_siz,
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
// *******************      Gelir  *****************************************************
    public function gelir(Request $request)
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
 		   	WHEN T1.kodtarif IN (701,707,708,721,723)                                         THEN "GPON"
 		    WHEN T1.kodtarif IN (1,2,7,21,111)                                                THEN "Mis"
    		WHEN T1.kodtarif IN (272,273,274,275,276,277,278,279,281,282,283,285,286,293,295) THEN "Servis"
    		WHEN T1.kodtarif IN (6,8,36,49,61,235,289,349,907,920,925,926,928)                THEN "sair"

    		WHEN T1.kodtarif IN (410,924,927,930,411)                                         THEN "ATS-lərdə qur.avad."
    		WHEN T1.kodtarif IN (31,32,93,94,96,97)                                           THEN "BRX-dən ist.haqqı"
    		WHEN T1.kodtarif IN (324,325,326)                                                 THEN "Ethernet"
    		WHEN T1.kodtarif IN (543)                                                         THEN "Digər prov"
    		WHEN T1.kodtarif IN (929)                                                         THEN "KTX"
    		WHEN T1.kodtarif IN (39,46,48,51,53,54,58,59,60)                                  THEN "Rəqəmsal kanal"
    		WHEN T1.kodtarif IN (391,392,396,397,398,399)                                     THEN "Kabel kan.icare"
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
    SUM( CASE WHEN T2.categoriya = "IDERE" AND T2.kateqor IN (23,33) THEN T2.summa ELSE 0 END) as idere_edv,
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
/* 		   	WHEN Ts1.kodxidmet IN (121,151,171,299,378)                                         THEN "2. Bərpa,A-Ada,Sair"*/


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
    SUM( CASE WHEN Ts2.categoriya = "IDERE" AND Ts2.kateqor IN (23,33) THEN Ts2.summa ELSE 0 END) as idere_edv,
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
    /****************         xidmet analizi basla          ***********************/
    public function xidmet()
    {
        return view('back.yoxla.xidmet');

    }
    /****************         xidmet analizi son          ***********************/





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
