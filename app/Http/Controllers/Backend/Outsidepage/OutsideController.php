<?php

namespace App\Http\Controllers\Backend\Outsidepage;

use App\Http\Controllers\Controller;
use App\Models\Damages;
use App\Models\StockQuantiy;
use Illuminate\Http\Request;

class OutsideController extends Controller
{
    //
    public function accept($id){
        $ids = json_decode($id);
        $details = Damages::with('brand', 'user')->whereIn('id', $ids)->get();
        if($details[0]->status == 'p'){
            return view('backend.outsidepage.accept', compact('details', 'ids'));

        }else{
            return redirect()->route('action.check');
        }
    }
    public function acceptpost($id){
        $ids = json_decode($id);
        $details = Damages::with('brand', 'user')->whereIn('id', $ids)->get();
        if ($details[0]->status == 'p') {
            foreach ($details as $value) {
                $stock = StockQuantiy::where('brand_id', $value->brand_id)->where('date', $value->date)->first();
                if ($stock->quantity >= $value->quantity){
                    $stock->quantity = $stock->quantity  - $value->quantity;
                    $stock->damages = $stock->damages  + $value->quantity;
                    $stock->update();
                    Damages::with('brand', 'user')->where('id', $value->id)->update(['status' => 'a']);
                }
            }
            return redirect()->route('action.check');
        }else {
            return redirect()->route('action.check');
        }
    }
    public function decline($id)
    {
        $ids = json_decode($id);
        $details = Damages::with('brand', 'user')->whereIn('id', $ids)->get();
        if ($details[0]->status == 'p') {
            return view('backend.outsidepage.decline', compact('details', 'ids'));
        } else {
            return redirect()->route('action.crose');
        }
    }
    public function declinepost(Request $request, $id)
    {
        $ids = json_decode($id);
        $details = Damages::with('brand', 'user')->whereIn('id', $ids)->get();
        if ($details[0]->status == 'p') {
            Damages::with('brand', 'user')->whereIn('id', $ids)->update(['status' => 'd', 'reason' => $request->reason]);
            return redirect()->route('action.crose');
        }else{
            return redirect()->route('action.crose');
        }
    }


}
