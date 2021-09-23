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
use App\Models\Animal;
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
    return redirect()->route('login');
});

Auth::routes(['register' => false]);


Route::group(['middleware' => ['auth', 'checkRole:master,super-admin,admin,operator']], function(){
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Animal
    // Route::resource('animal', AnimalController::class);
    Route::get('animal', [AnimalController::class, 'index'])->name('animal.index');
    Route::get('animal/{animal}/edit', [AnimalController::class, 'edit'])->name('animal.edit');
    Route::put('animal/{animal}', [AnimalController::class, 'update'])->name('animal.update');
    Route::delete('animal/{animal}', [AnimalController::class, 'destroy'])->name('animal.destroy');

    //Animal Detail
    Route::get('animal/detail/{barcode}', [AnimalDetailController::class, 'index'])->name('animal.detail');

    //Animal Barcode
    Route::get('animal/barcode/{barcode}', [AnimalDetailController::class, 'barcode'])->name('animal.barcode');
});

Route::group(['middleware' => ['auth', 'checkRole:master,super-admin,admin']], function(){
    //Category
    Route::resource('category', CategoryController::class);

    //Animal
    Route::get('animal/create', [AnimalController::class, 'create'])->name('animal.create');
    Route::post('animal', [AnimalController::class, 'store'])->name('animal.store');
});

Route::group(['middleware' => ['auth', 'checkRole:master,super-admin']], function(){
    //User Office
    Route::resource('user-office', UserOfficeController::class);

    //User Farm
    Route::resource('user-farm', UserFarmController::class);

    //Farm
    Route::resource('farm', FarmController::class);
});

Route::group(['middleware' => ['auth', 'checkRole:master']], function(){
    //User
    Route::resource('user-all', UserController::class);

    //Office
    Route::resource('office', OfficeController::class);
});



