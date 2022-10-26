<?php

namespace App\Http\Controllers\Backend\Api\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\StockQuantiy;
use Illuminate\Http\Request;
use Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
            'date' => 'required',
            'table' => 'required',
        ]);

        $date = $request->date;
        $table =json_decode($request->table);

        foreach($table as $item){
            $stock = new Stock();
            $stock->barcode = $item->barcode;
            $stock->brand_id = $item->brandId;
            $stock->quantity = $item->quantity;
            $stock->date = $date;
            $stock->user_id = Auth::user()->id;
            $stock->save();
//            $addstock = new StockQuantiy();
//            $addstock->brand_id = $item->brandId;
//            $addstock->date = $date;
//            $addstock->quantity = $item->quantity;
//            $addstock->save();

            $check = StockQuantiy::where('brand_id', $item->brandId)->where('date', $date)->count();
            if($check > 0){
                $addQuantity = StockQuantiy::where('brand_id', $item->brandId)->where('date', $date)->sum('quantity');
                StockQuantiy::where('brand_id', $item->brandId)->where('date', $date)->update(['quantity'=>$addQuantity+$item->quantity]);
            }else{
                $addstock = new StockQuantiy();
                $addstock->brand_id = $item->brandId;
                $addstock->date = $date;
                $addstock->quantity = $item->quantity;
                $addstock->save();
            }

        }
        $notification = array(
            'messege' => 'Stock successfully added',
            'alert-type' => 'success'
        );
        return response()->json($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = StockQuantiy::where('brand_id', $id)->first();
        return response()->json($stock->quantity);
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
