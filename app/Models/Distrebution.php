<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrebution extends Model
{
    use HasFactory;
    protected $fillable =[
        'employee_id',
        'brand_id',
        'stock_id',
        'quantity',
        'signature',
        'picture',
        'date',
        'user_id'
    ];
    public function employee(){
        return $this->belongsTo('App\Models\employee', 'employee_id', 'id');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }
    public function stock(){
        return $this->belongsTo('App\Models\Stock', 'stock_id', 'id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
