<?php

namespace App\Imports;

use App\Models\employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    public $date;
    public $user_id;

    public function __construct($date, $user_id)
    {
        $this->date = $date;
        $this->user_id = $user_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new employee([
            'employee_no'   => $row[0],
            'inital'        => $row[1],
            'surname'       => $row[2],
            'paypoint'    => $row[3],
            'selection_1'   => $row[4],
            'selection_2'   => $row[5]??"",
            'selection_3'   => $row[6]??"",
            'shift_bear'      => $row[7]??"",
            'other_bear'      => $row[8]??"",
            'signature'      => $row[9]??"",
            'date'          => $this->date??"",
            'user_id'       => $this->user_id??""
        ]);
    }
}
