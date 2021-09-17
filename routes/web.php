<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFarmController;
use App\Http\Controllers\UserOfficeController;
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
    return view('welcome');
});

Auth::routes(['register' => false]);


Route::group(['middleware' => ['auth', 'checkRole:master,super-admin,admin,operator']], function(){
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['auth', 'checkRole:master,super-admin']], function(){
    //User Office
    Route::resource('user-office', UserOfficeController::class);

    //User Farm
    Route::resource('user-farm', UserFarmController::class);

    //Office
    Route::resource('office', OfficeController::class);

    //Farm
    Route::resource('farm', FarmController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:master']], function(){
    //User
    Route::resource('user-all', UserController::class);
});



