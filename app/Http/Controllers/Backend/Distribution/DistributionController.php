<?php

namespace App\Http\Controllers\Backend\Distribution;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\employee;
use App\Models\Stock;
use App\Models\StockQuantiy;
use Illuminate\Http\Request;
use App\Models\Distrebution;
use Auth;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:distribution', ['only' => ['index','store']]);

    }
    public function index()
    {
        $date=request()->date;
        $data = employee::where('date', $date)->get();
        $brands = StockQuantiy::with('brand')->where('date', $date)->get();
        $stocks = Stock::where('date', $date)->get();
        return view('backend.distribution.index', compact('data','date', 'brands', 'stocks'));
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
        $signature = $request->signature;
        $picture = $request->picture;
        if(!empty($signature)){
            $folderPath = public_path('images/signature/');
            $image_parts = explode(";base64,", $signature);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signatures = strtotime("now") . '-signature.'.$image_type;
            $signature_localpath = $folderPath . $signatures;
            file_put_contents($signature_localpath, $image_base64);
            $destinationPath = 'images/signature/';
            $signature_img = $destinationPath.$signatures;

        }else{
            $signature_img=null;
        }
        if(!empty($picture)){
            $destinationPath = 'images/productpic/';
            $picture_originalFile = $picture->getClientOriginalName();
            $picture_filename = strtotime("now").'-'.$picture_originalFile;
            $picture->move($destinationPath, $picture_filename);
            $picture_img = $destinationPath.$picture_filename;
        }else{
            $picture_img=null;
        }
        $date = request()->date;
        $employee_id = $request->employeeId;
        $quantity = $request->quantity;
        foreach($request->brand_id as $key => $brand_id){
            $stock = Stock::where('brand_id', $brand_id)->where('date', $date)->first();
            $distribution = new Distrebution();
            $distribution->employee_id = $employee_id;
            $distribution->brand_id = $brand_id;
            $distribution->quantity = $quantity[$key];
            $distribution->stock_id = $stock->id;
            $distribution->signature = $signature_img;
            $distribution->picture = $picture_img;
            $distribution->date = $date;
            $distribution->user_id = Auth::user()->id;
            $distribution->save();
            $stock->quantity = $stock->quantity - $quantity[$key];
            $stock->update();
        }
        $employeedata = employee::where('id', $employee_id)->update(['status'=>'1']);

        $notification = array(
            'messege' => 'Distribute successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('distribution.index', ['date' => $date])
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
