<?php

namespace App\Http\Controllers;

use App\Models\MhmLogin;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\esas;
use App\Models\elave;


class ProductController extends Controller
{
        public function index()
    {

      $data=esas::
          join('elaves', 'esas.telefon', '=', 'elaves.telefon')
          ->select('esas.*', 'elaves.telefon', 'elaves.tarifs')
          ->whereTarif(707)
          ->whereIn('tarifs',array(701,702,703,704,705))
                ->get();

         //   return $data=elave::paginate(7);
return view('test',compact('data'));
    }




	public function multipleusersdelete(Request $request)
	{
		$id = $request->id;
		foreach ($id as $user)
		{
			Product::where('id', $user)->delete();
		}
		return redirect()->route('test');
	}

public function table()
{
    return view('data_table');
}



}
