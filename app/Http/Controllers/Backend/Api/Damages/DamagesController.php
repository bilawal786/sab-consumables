<?php

namespace App\Http\Controllers\Backend\Api\Damages;

use App\Http\Controllers\Controller;
use App\Mail\AddDamagesMail;
use App\Models\Damages;
use App\Models\Settings;
use App\Models\StockQuantiy;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;

class DamagesController extends Controller
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
        ]);

        $date = request()->date;
        $table =json_decode($request->table);
        $ids = [];
        foreach ($table as $key => $item){
            $getstock = StockQuantiy::where('brand_id', $item->brandId)->where('date', $date)->first();
            $danage = new Damages();
            $danage->brand_id = $item->brandId;
            $danage->quantity = $item->quantity;
            $danage->date = $date;
            $danage->status = 'p';
            $danage->user_id = Auth::user()->id;
            $danage->save();
            $ids[$key] = $danage->id;
        }
        $details = Damages::with('brand', 'user')->whereIn('id', $ids)->get();
        $setting = Settings::first();
        Mail::to($setting->email)
            ->send(new AddDamagesMail($details, $ids));
        $notification = array(
            'messege' => 'Stock damages added',
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
