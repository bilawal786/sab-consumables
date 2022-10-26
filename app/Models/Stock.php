<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'brand_id',
        'quantity',
        'date',
        'user_id'
    ];
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
