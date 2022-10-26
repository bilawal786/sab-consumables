<?php

namespace App\Http\Controllers\Backend\StatusMessage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function check(){
        return view('backend.outsidepage.tick');
    }
    public function crose(){
        return view('backend.outsidepage.crose');
    }
}
