<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MuserRequest;
use App\Http\Requests\MuserUpdateRequest;
use App\Models\MhmLogin;
use App\Models\MhmLoginCategory;
use App\Models\vezife;
use Illuminate\Http\Request;

class MhmLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
              $mlogin=MhmLogin::with('category','vezife')->get();
        $categories=MhmLoginCategory::orderBy('sobe','DESC')->get();
        $vezifeler=vezife::orderBy('id','Asc')->get();

      //  return compact('categories','mlogin');

      //  echo '<pre>'.print_r(compact('categories','mlogin'), true).'</pre>'; exit;

        return view('back.MhmLogin.MuserC',compact('categories','mlogin','vezifeler'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MuserRequest  $request)
    {
//                $request->validate([
//    'login' => 'required|max:255',
//    'name' => 'required|max:255',
//    'qeyd' => 'required|min:4|max:255',
//
//]);


        MhmLogin::create($request->post());
               return redirect()->route('muser.index')->with('message',' Uğurla icra olundu!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=MhmLogin::with('category','vezife')->find($id) ?? abort(404,'bele sehife yoxdur');


        $logins=MhmLogin::with('category','vezife')->get();
       $categories=MhmLoginCategory::orderBy('sobe','DESC')->get();
        $vezifeler=vezife::orderBy('id','Asc')->get();
      return view('back.MhmLogin.MuserU',compact('data','logins','categories','vezifeler'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MuserUpdateRequest $request, $id)
    {
//                $request->validate([
//    'login' => 'required|max:255',
//    'name' => 'required|max:255',
//    'qeyd' => 'required|min:4|max:255',
//
//]);
        $data=MhmLogin::findOrFail($id);
                $data->update($request->except(['_method','_token']));
        return redirect()->route('muser.index')->with('message',' Uğurla Deyisdirildi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data=MhmLogin::find($id) ?? abort(404,'bele sehife yoxdur');

        $data->delete();
        return redirect()->route('muser.index')->with('message',' Uğurla Silindi');
    }


        	public function multipleusersdelete(Request $request)
	{
		$id = $request->id;
		foreach ($id as $user)
		{
			MhmLogin::where('id', $user)->delete();
		}
		        return redirect()->route('muser.index')->with('message',' Seçilənlər Uğurla Silindi');

	}
}
