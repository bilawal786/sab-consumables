<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Models\Distrebution;
use App\Models\employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $date = request()->date;
        $employee = employee::where('id', $id)->first();
        $data = Distrebution::with('brand', 'stock', 'user')->where('employee_id', $id)->where('date', $date)->get();
        $data1 = [
            'date' => $date,
            'employee' => $employee,
            'data' => $data
        ];
        $pdf = Pdf::loadView('backend.reports.pdf.download', $data1);
        $pdf->stream();
        return $pdf->download($employee->employee_no.'_employee.pdf');
    }

}
