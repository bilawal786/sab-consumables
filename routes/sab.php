<?php

use App\Http\Controllers\Backend\Api\Brands\BrandsController;
use App\Http\Controllers\Backend\Api\Employees\EmployeesController;
use App\Http\Controllers\Backend\Api\Distribution\DistributionController;
use App\Http\Controllers\Backend\Api\Stock\StockController;
use App\Http\Controllers\Backend\Api\Damages\DamagesController;
use App\Http\Controllers\Backend\Api\Brand\BrandController;


/*
|--------------------------------------------------------------------------
| Sab Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth']], function() {


    Route::resource('select2brands', BrandsController::class);
    Route::resource('select2brand', BrandController::class);
    Route::resource('sabemployees', EmployeesController::class);
    Route::resource('sabdistribution', DistributionController::class);
    Route::resource('sabstock', StockController::class);
    Route::resource('sabdamages', DamagesController::class);



});
