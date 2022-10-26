<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
    protected $fillable =[
        'employee_no',
        'inital',
        'surname',
        'paypoint',
        'selection_1',
        'selection_2',
        'selection_3',
        'shift_bear',
        'other_bear',
        'signature',
        'status',
        'date',
        'user_id'
    ];
}
