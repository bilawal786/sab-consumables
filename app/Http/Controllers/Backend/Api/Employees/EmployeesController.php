<?php

namespace App\Http\Controllers\Backend\Api\Employees;

use App\Http\Controllers\Controller;
use App\Models\employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date=request()->date;
        $limit = request()->limit;
        $search = request()->search;
        $data = employee::where('date', $date)
            ->where(
                function($query) use ($search) {
                    $query
                        ->where('employee_no','like','%'.$search.'%')
                        ->orwhere('inital','like','%'.$search.'%')
                        ->orwhere('surname','like','%'.$search.'%')
                        ->orwhere('paypoint','like','%'.$search.'%')
                        ->orwhere('selection_1','like','%'.$search.'%')
                        ->orwhere('selection_2','like','%'.$search.'%')
                        ->orwhere('selection_3','like','%'.$search.'%')
                        ->orwhere('shift_bear','like','%'.$search.'%')
                        ->orwhere('other_bear','like','%'.$search.'%');
                })
            ->orderBy('id', 'desc')
            ->paginate($limit);
        return response()->json($data);
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
