<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});
Route::get('/customer',[CustomerController::class,'index'])->name('customer.index');
Route::get('/customer/add',[CustomerController::class,'create'])->name('customer.create');
Route::post('/customer/add',[CustomerController::class,'store'])->name('customer.store');
Route::get('/customer/{id}/delete',[CustomerController::class,'destroy'])->name('customer.destroy');
