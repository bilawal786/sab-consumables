<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockQuantiy extends Model
{
    use HasFactory;
    protected $fillable =[
        'brand_id',
        'date',
        'quantity',
        'distribution',
        'damages'
    ];
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }
}
