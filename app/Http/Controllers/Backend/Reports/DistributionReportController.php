<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Models\Distrebution;
use App\Models\employee;
use Illuminate\Http\Request;

class DistributionReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:distribution-report-list|distribution-report-show', ['only' => ['index']]);
        $this->middleware('permission:distribution-report-show', ['only' => ['show']]);
    }
    public function index()
    {
        $date=request()->date;
        $data = Distrebution::with('employee', 'brand', 'stock', 'user')
            ->where('date', $date)
            ->groupBy('employee_id')
            ->selectRaw('count(*) as total, employee_id')
            ->get();
        return view('backend.reports.distribution.index', compact('data','date'));
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
        $date = request()->date;
        $employee = employee::where('id', $id)->first();
        $data = Distrebution::with('brand', 'stock', 'user')->where('employee_id', $id)->where('date', $date)->get();
        return view('backend.reports.distribution.show', compact('employee','data', 'date'));
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
