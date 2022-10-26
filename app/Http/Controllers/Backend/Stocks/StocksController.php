<?php

namespace App\Http\Controllers\Backend\Stocks;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Stock;
use App\Models\StockQuantiy;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:stock-list|stock-create|stock-delete', ['only' => ['index','store']]);
        $this->middleware('permission:stock-create', ['only' => ['create','store']]);
        $this->middleware('permission:stock-delete', ['only' => ['delete']]);
    }
    public function index()
    {
        $today = request()->date;

//        $today = date('Y-m');
        $data = Stock::with('brand')->where('date', $today)->orderby('id', 'DESC')->get();
        return view('backend.stock.index', compact('data', 'today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $today = date('Y-m');
        $brands = Brand::all();
        return view('backend.stock.create', compact('brands', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = $request->date;
        $brand_id = $request->brand_id;
        $request->validate([
            'date' => 'required',
            'barcode' => 'required',
            'quantity' => 'required',
//            'brand_id' => [
//                        'required',
//                        Rule::unique('stocks')->where(function ($query) use ($date, $brand_id) {
//                            return $query
//                                ->whereIn('brand_id', $brand_id)
//                                ->where('date', $date);
//                        }),
//                        ],
        ]);

        $brand = $request->brand_id;
        $quantity = $request->quantity;
        $date = $request->date;
        foreach($request->barcode as $key => $barcode){
            $stock = new Stock();
            $stock->barcode = $barcode;
            $stock->brand_id = $brand[$key];
            $stock->quantity = $quantity[$key];
            $stock->date = $date;
            $stock->user_id = Auth::user()->id;
            $stock->save();
            $check = StockQuantiy::where('brand_id', $brand[$key])->where('date', $date)->count();

            if($check > 0){
                $addQuantity = StockQuantiy::where('brand_id', $brand[$key])->where('date', $date)->sum('quantity');
                StockQuantiy::where('brand_id', $brand[$key])->where('date', $date)->update(['quantity'=>$addQuantity+$quantity[$key]]);
            }else{
                $addstock = new StockQuantiy();
                $addstock->brand_id = $brand[$key];
                $addstock->date = $date;
                $addstock->quantity = $quantity[$key];
                $addstock->save();
            }

        }
        $notification = array(
            'messege' => 'Stock Added Successfully..!',
            'alert-type' => 'success'
        );
        return redirect()->route('stocks.index', ['date' => $date])
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $brands = Brand::all();
//        $data = Stock::find($id);
//        $stock = StockQuantiy::Where('brand_id', $data->brand_id)->where('date', $data->date)->first();
//        $stocks = $stock->quantity;
//        return view('backend.stock.edit', compact('data', 'brands', 'stocks'));
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
//        $request->validate([
//            'barcode' => 'required',
//            'quantity' => 'required',
//
//        ]);
//
//        $stock = Stock::where('id', $id)->first();
//        $stockquantity = StockQuantiy::where('brand_id', $stock->brand_id)->where('date', $stock->date)->first();
//
//        Stock::where('id', $id)->update(['quantity'=> ($stock->quantity-$stockquantity->quantity)+$request->quantity]);
//        StockQuantiy::where('brand_id', $stock->brand_id)->where('date', $stock->date)->update(['quantity'=>$request->quantity]);
//
//        $notification = array(
//            'messege' => 'Stock Updated Successfully..!',
//            'alert-type' => 'success'
//        );
//        return redirect()->route('stocks.index', ['date'=>$stock->date])
//            ->with($notification);


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
    public function delete($id){
        $date=request()->date;
        $stock= Stock::where('id', $id)->first();
        $stockquantity = StockQuantiy::where('brand_id', $stock->brand_id)->where('date', $stock->date)->first();
        if($stockquantity->quantity >= $stock->quantity){
            if($stockquantity->quantity == $stock->quantity){
                StockQuantiy::where('brand_id', $stock->brand_id)->where('date', $stock->date)->delete();
                Stock::find($id)->delete();
            }else{
                StockQuantiy::where('brand_id', $stock->brand_id)->where('date', $stock->date)->update(['quanitiy' => $stockquantity->quantity-$stock->quantity]);
                tock::find($id)->delete();
            }

            $notification = array(
                'messege' => 'Stock Successfully Deleted..!',
                'alert-type' => 'warning'
            );
            return redirect()->route('stocks.index', ['date'=>$date])
                ->with($notification);
        }else{
            $notification = array(
                'messege' => 'Distributed Stock Can Not Be Deleted..!',
                'alert-type' => 'warning'
            );
            return redirect()->route('stocks.index', ['date'=>$date])
                ->with($notification);

        }

//        $notification = array(
//            'messege' => 'Stock Successfully Deleted..!',
//            'alert-type' => 'success'
//        );
//        return redirect()->route('stocks.index', ['date'=>$date])
//            ->with($notification);
    }
    public function brandstock(){
        $id=request()->id;
        $data = StockQuantiy::where('brand_id', $id)->first();

        return response()->json($data->quantity);
    }
}
