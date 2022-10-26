<?php

namespace App\Http\Controllers\Backend\Brands;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Auth;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:brand-list|brand-create|brand-edit|brand-delete', ['only' => ['index','store']]);
        $this->middleware('permission:brand-create', ['only' => ['create','store']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:brand-delete', ['only' => ['delete']]);
    }
    public function index()
    {
        $data = Brand::orderBy('id', 'desc')->get();
        return view('backend.brands.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|min:1|max:255',
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->user_id = Auth::user()->id;
        $brand->save();
        $notification = array(
            'messege' => 'Brand Created Successfully..!',
            'alert-type' => 'success'
        );

        return redirect()->route('brands.index')
            ->with($notification);
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
        $data = Brand::find($id);
        return view('backend.brands.edit', compact('data'));
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
        $data = Brand::find($id);
        $data->name = $request->name;
        $data->user_id = Auth::user()->id;
        $data->update();
        $notification = array(
            'messege' => 'Brand Updated Successfully..!',
            'alert-type' => 'success'
        );

        return redirect()->route('brands.index')
            ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
    public function delete($id)
    {
        Brand::find($id)->delete();
        $notification = array(
            'messege' => 'Brand Deleted Successfully..!',
            'alert-type' => 'warning'
        );
        return redirect()->route('brands.index')
            ->with($notification);
    }
}
