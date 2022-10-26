<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Distrebution;
use App\Models\employee;
use App\Models\Stock;
use App\Models\StockQuantiy;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m');
        $brands = Brand::count();
        $employees = employee::where('date', $date)->count();
        $stock = Stock::where('date', $date)->sum('quantity');
        $damages = StockQuantiy::where('date', $date)->sum('damages');
        $data = Distrebution::with('employee', 'brand', 'stock', 'user')
            ->where('date', $date)
            ->groupBy('employee_id')
            ->selectRaw('count(*) as total, employee_id')
            ->limit(5)
            ->get();
        return view('backend.dashboard.index', compact('brands', 'employees', 'stock', 'damages', 'data', 'date'));
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
        //
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
