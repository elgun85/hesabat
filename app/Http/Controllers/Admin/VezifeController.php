<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vezife;

class VezifeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=vezife::orderBy('id','Desc')->paginate(5);
        return view('back.MhmLogin.vezifeC',compact('data'));
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
    public function store(Request $request)
    {
        $request->validate([
    'name' => 'required|max:255',

]);
        vezife::create($request->post());
               return redirect()->route('mvezife.index')->with('message',' Uğurla icra olundu!');
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
      $data=vezife::find($id) ?? abort(404,'bele sehife yoxdur');
        $vezifeler=vezife::orderBy('id','Desc')->paginate(5);
        return view('back.MhmLogin.vezifeU',compact('data','vezifeler'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                $request->validate([
    'name' => 'required|max:255',


]);
        $data=vezife::findOrFail($id);
                $data->update($request->except(['_method','_token']));
        return redirect()->route('mvezife.index')->with('message',' Uğurla Deyisdirildi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data=vezife::find($id) ?? abort(404,'bele sehife yoxdur');

        $data->delete();
        return redirect()->route('mvezife.index')->with('message',' Uğurla Silindi');

    }
}
