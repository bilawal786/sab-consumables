<?php

namespace App\Http\Controllers\Backend\Damages;

use App\Http\Controllers\Controller;
use App\Mail\AddDamagesMail;
use App\Models\Brand;
use App\Models\Damages;
use App\Models\Stock;
use App\Models\StockQuantiy;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Settings;

class DamagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:damages-list|damages-create|damages-reject|damages-approve', ['only' => ['index','store']]);
        $this->middleware('permission:damages-create', ['only' => ['create','store']]);
        $this->middleware('permission:damages-approve', ['only' => ['approved']]);
        $this->middleware('permission:damages-reject', ['only' => ['reject']]);
    }
    public function index()
    {
        $date=request()->date;
        $data=Damages::where('date', $date)->get();
        return view('backend.damages.index', compact('date', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = date('Y-m');
        $brands = Brand::all();
        return view('backend.damages.create', compact('brands', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quantity = $request->quantity;
        $date = $request->date;
//        dd($request);
        foreach($request->brand_id as $key => $brand){
            $danage = new Damages();
            $danage->brand_id = $brand;
            $danage->quantity = $quantity[$key];
            $danage->date = $date;
            $danage->status = 'p';
            $danage->user_id = Auth::user()->id;
            $danage->save();
        }
        $details = $danage;
        $setting = Settings::first();
        Mail::to($setting->email)
            ->send(new AddDamagesMail($details));

        $notification = array(
            'messege' => 'Stock successfully added',
            'alert-type' => 'success'
        );
        return redirect()->route('damages.index', ['date' => $date])
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
    public function approved($id){
        $date=request()->date;
        $damage =  Damages::where('id', $id)->first();
        $stockQuantity = StockQuantiy::where('brand_id', $damage->brand_id)->where('date', $date)->first();
        if($stockQuantity->quantity >= $damage->quantity ){
            $stockQuantity->quantity = $stockQuantity->quantity-$damage->quantity;
            $stockQuantity->damages = $stockQuantity->damages+$damage->quantity;
            $stockQuantity->update();
            Damages::where('id', $id)->update(['status'=>'a']);
            $data=Damages::where('date', $date)->get();
            $notification = array(
                'messege' => 'Damages successfully approved',
                'alert-type' => 'success'
            );
            return redirect()->route('damages.index', ['date'=>$date])->with($notification);
        }else{
            $notification = array(
                'messege' => 'Damages are distribute',
                'alert-type' => 'error'
            );
            return redirect()->route('damages.index', ['date'=>$date])->with($notification);
        }

    }
    public function reject($id){
        $date=request()->date;
        Damages::where('id', $id)->update(['status'=>'d']);
        $data=Damages::where('date', $date)->get();
        $notification = array(
            'messege' => 'Damages successfully declined',
            'alert-type' => 'success'
        );
        return redirect()->route('damages.index', ['date'=>$date])->with($notification);
    }
}
