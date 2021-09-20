<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalDetailController;
use App\Http\Controllers\CategoryController;
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

    //Animal
    Route::resource('animal', AnimalController::class);
    Route::get('animal/detail/{barcode}', [AnimalDetailController::class, 'index'])->name('animal.detail');

});

Route::group(['middleware' => ['auth', 'checkRole:master,super-admin,admin']], function(){
    //Category
    Route::resource('category', CategoryController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:master,super-admin']], function(){
    //User Office
    Route::resource('user-office', UserOfficeController::class);

    //User Farm
    Route::resource('user-farm', UserFarmController::class);

    //Farm
    Route::resource('farm', FarmController::class);

    //Category
    Route::resource('category', CategoryController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:master']], function(){
    //User
    Route::resource('user-all', UserController::class);

    //Office
    Route::resource('office', OfficeController::class);
});



