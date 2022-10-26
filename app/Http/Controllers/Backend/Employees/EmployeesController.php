<?php

namespace App\Http\Controllers\Backend\Employees;

use App\Http\Controllers\Controller;
use App\Imports\EmployeeImport;
use App\Models\employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:employee-list|employee-import|employee-edit|employee-delete', ['only' => ['index','store']]);
        $this->middleware('permission:employee-import', ['only' => ['import']]);
    }
    public function index()
    {
        $date=request()->date;
        $data = employee::where('date', $date)->get();
        return view('backend.employees.index', compact('data','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.employees.create');
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
    public function import(Request $request)
    {
        try {
            Excel::import(new EmployeeImport($request->date, Auth::user()->id), $request->file);
        }catch (\Exception $e){
            $nerror= array(
                'messege' => 'Please import correct file',
                'alert-type' => 'warning'
            );
            return redirect()->route('employee.index', ['date'=>$request->date])
                ->with($nerror);
        }


        $notification = array(
            'messege' => 'Stock successfully import',
            'alert-type' => 'success'
        );
        return redirect()->route('employee.index', ['date'=>$request->date])
            ->with($notification);
    }
}
