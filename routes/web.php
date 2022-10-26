<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\Profile\ProfileController;
use App\Http\Controllers\Backend\Profile\ChangePasswordController;
use App\Http\Controllers\Backend\Users\UserController;
use App\Http\Controllers\Backend\Roles\RoleController;
use App\Http\Controllers\Backend\Setting\SettingController;
use App\Http\Controllers\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Backend\Fresh\FreshController;
use App\Http\Controllers\Backend\Brands\BrandsController;
use App\Http\Controllers\Backend\Stocks\StocksController;
use App\Http\Controllers\Backend\Employees\EmployeesController;
use App\Http\Controllers\Backend\Distribution\DistributionController;
use App\Http\Controllers\Backend\Damages\DamagesController;
use App\Http\Controllers\Backend\Reports\DamageReportController;
use App\Http\Controllers\Backend\Reports\DistributionReportController;
use App\Http\Controllers\Backend\Reports\PdfReportController;
use App\Http\Controllers\Backend\Outsidepage\OutsideController;
use App\Http\Controllers\Backend\StatusMessage\StatusController;
use App\Http\Controllers\Backend\Printer\PrinterController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function ()
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/accept/{id}', [OutsideController::class, 'accept'])->name('email.damage.accept');
Route::get('/decline/{id}', [OutsideController::class, 'decline'])->name('email.damage.decline');
Route::get('/accept/actiion/{id}', [OutsideController::class, 'acceptpost'])->name('email.damage.action.accept');
Route::put('/decline/action/{id}', [OutsideController::class, 'declinepost'])->name('email.damage.action.decline');
Route::get('/accepts/check', [StatusController::class, 'check'])->name('action.check');
Route::get('/declines/crose', [StatusController::class, 'crose'])->name('action.crose');
Route::resource('fresh123', FreshController::class);
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('brands', BrandsController::class);
    Route::get('/brands/destroy/{id}', [BrandsController::class, 'delete'])->name('brands.delete');
    Route::resource('stocks', StocksController::class);
    Route::get('/stocks/destroy/{id}', [StocksController::class, 'delete'])->name('stocks.delete');
    Route::resource('employee', EmployeesController::class);
    Route::post('employees/list', [EmployeesController::class, 'import'])->name('employees.import');
    Route::resource('distribution', DistributionController::class);
    Route::resource('distributereports', DistributionReportController::class);
    Route::resource('stockreport', DamageReportController::class);
    Route::resource('damages', DamagesController::class);
    Route::get('/damage/approved/{id}', [DamagesController::class, 'approved'])->name('damages.approved');
    Route::get('/damage/reject/{id}', [DamagesController::class, 'reject'])->name('damages.reject');
    Route::post('/change/password', [ChangePasswordController::class, 'store'])->name('password.change');
    Route::get('/download/report/{id}', [PdfReportController::class, 'download'])->name('download.report');
    Route::get('/stock/get', [StocksController::class, 'brandstock'])->name('getstock');
    Route::get('/print/report/distribution', [PrinterController::class, 'distribution'])->name('print.distribution');
    Route::get('/print/report/stock', [PrinterController::class, 'stock'])->name('print.stock');
});
