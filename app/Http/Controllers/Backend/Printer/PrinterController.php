<?php

namespace App\Http\Controllers\Backend\Printer;

use App\Http\Controllers\Controller;
use App\Models\Distrebution;
use App\Models\StockQuantiy;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    public function distribution()
    {
        $date=request()->date;
        $data = Distrebution::with('employee', 'brand', 'stock', 'user')
            ->where('date', $date)
            ->groupBy('employee_id')
            ->selectRaw('count(*) as total, employee_id')
            ->get();
        return view('backend.printer.distribution', compact('data','date'));
    }
    public function stock()
    {
        $date=request()->date;
        $data=StockQuantiy::where('date', $date)->get();
        return view('backend.printer.stock', compact('date', 'data'));
    }

}
