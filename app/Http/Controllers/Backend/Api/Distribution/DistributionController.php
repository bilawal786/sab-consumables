<?php

namespace App\Http\Controllers\Backend\Api\Distribution;

use App\Http\Controllers\Controller;
use App\Models\Distrebution;
use App\Models\employee;
use App\Models\Stock;
use App\Models\StockQuantiy;
use Illuminate\Http\Request;
use Auth;


class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'table' => 'required',
            'employeeId' => 'required',
            'signature' => 'required',
            'picture' => 'required',
        ]);
        $date = request()->date;
        $table =json_decode($request->table);
        $employee_id = $request->employeeId;
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
        foreach ($table as $stock){
            $getstock = StockQuantiy::where('brand_id', $stock->brandId)->where('date', $date)->first();
            $distribution = new Distrebution();
            $distribution->employee_id = $employee_id;
            $distribution->brand_id = $stock->brandId;
            $distribution->quantity = $stock->quantity;
            $distribution->stock_id = $getstock->id;
            $distribution->signature = $signature_img;
            $distribution->picture = $picture_img;
            $distribution->date = $date;
            $distribution->user_id = Auth::user()->id;
            $distribution->save();
            $getstock->quantity = $getstock->quantity-$stock->quantity;
            $getstock->distribution = $getstock->distribution+$stock->quantity;
            $getstock->update();
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
