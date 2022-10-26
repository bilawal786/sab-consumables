<?php

namespace App\Http\Controllers\Backend\Api\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\StockQuantiy;
use Illuminate\Http\Request;
use App\Http\Resources\Backend\Api\Brand\BrandResource;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $date=request()->date;
//        $data = StockQuantiy::where('date', $date)->pluck('brand_id');
//        $brand = Brand::where(function ($query) use ($data){
//            for ($i = 0; $i < count($data); $i++) {
//                $query->where('id', '!=', $data[$i]);
//            }
//        })->get();
        $brand = Brand::get();
        $brands = BrandResource::collection($brand);
        return response()->json($brands);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
