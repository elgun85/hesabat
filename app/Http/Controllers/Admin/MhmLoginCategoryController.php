<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MhmLoginCategory;

class MhmLoginCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=MhmLoginCategory::orderBy('id','ASC')->paginate(5);
        return view('back.MhmLogin.CategoryC',compact('data'));
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
    'sobe' => 'required|min:3|max:255',
    'vezife' => 'max:255',

]);
        MhmLoginCategory::create($request->post());
               return redirect()->route('category.index')->with('message',' Uğurla icra olundu!');

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

      $data=MhmLoginCategory::find($id) ?? abort(404,'bele sehife yoxdur');
        $category=MhmLoginCategory::orderBy('id','ASC')->paginate(5);
        return view('back.MhmLogin.CategoryU',compact('data','category'));

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
////         $isSlug=MhmLoginCategory::whereSlug(Str::slug($request->slug))->first();
//        $isName=MhmLoginCategory::whereSobe($request->sobe)->first();
//
//        if ( $isName) {
//        return redirect()->route('CatLogin.index')->with('error','  Deyisdirilmedi!');
//
//        }

                $request->validate([
    'sobe' => 'required|min:3|max:255',
    'vezife' => 'max:255',

]);
        $data=MhmLoginCategory::findOrFail($id);
                $data->update($request->except(['_method','_token']));
        return redirect()->route('category.index')->with('message',' Uğurla Deyisdirildi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data=MhmLoginCategory::find($id) ?? abort(404,'bele sehife yoxdur');

        $data->delete();
        return redirect()->route('category.index')->with('message',' Uğurla Silindi');

    }


    	public function multipleusersdelete(Request $request)
	{
		$id = $request->id;
		foreach ($id as $user)
		{
			MhmLoginCategory::where('id', $user)->delete();
		}
		        return redirect()->route('category.index')->with('message',' Seçilənlər Uğurla Silindi');

	}




//        public function deyis(Request $request, $id)
//    {
//////         $isSlug=MhmLoginCategory::whereSlug(Str::slug($request->slug))->first();
////        $isName=MhmLoginCategory::whereSobe($request->sobe)->first();
////
////        if ( $isName) {
////        return redirect()->route('CatLogin.index')->with('error','  Deyisdirilmedi!');
////        }
//
//        $data=MhmLoginCategory::findOrFail($id);
//                $data->update($request->except(['_method','_token']));
//        return redirect()->route('CatLogin.index')->with('message',' Uğurla Deyisdirildi!');
//    }



}
