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
    Route::get('animal-data', [AnimalController::class, 'index'])->name('animal-data.index');
    Route::get('animal-data/{animal}/edit', [AnimalController::class, 'edit'])->name('animal-data.edit');
    Route::put('animal-data/{animal}', [AnimalController::class, 'update'])->name('animal-data.update');
    Route::delete('animal-data/{animal}', [AnimalController::class, 'destroy'])->name('animal-data.destroy');
});

Route::group(['middleware' => ['auth', 'checkRole:master,super-admin,admin']], function(){
    //Category
    Route::resource('animal-category', CategoryController::class);

    //Animal
    Route::get('animal-data/create', [AnimalController::class, 'create'])->name('animal-data.create');
    Route::post('animal-data', [AnimalController::class, 'store'])->name('animal-data.store');
});

Route::group(['middleware' => ['auth', 'checkRole:master,super-admin']], function(){
    //User Office
    Route::resource('user-office', UserOfficeController::class);

    //User Farm
    Route::resource('user-farm', UserFarmController::class);

    //Farm
    Route::resource('farm', FarmController::class);

    //Office Profile Edit
    Route::get('office/{office}/edit', [OfficeController::class, 'edit'])->name('office.edit');
    Route::put('office/{office}', [OfficeController::class, 'update'])->name('office.update');
});

Route::group(['middleware' => ['auth', 'checkRole:master']], function(){
    //User
    Route::resource('user-all', UserController::class);

    //Office
    Route::get('office', [OfficeController::class, 'index'])->name('office.index');
    Route::delete('office/{office}', [OfficeController::class, 'destroy'])->name('office.destroy');
    Route::get('office/create', [OfficeController::class, 'create'])->name('office.create');
    Route::post('office', [OfficeController::class, 'store'])->name('office.store');
});

//Animal Detail
Route::get('data/detail/{qrcode}', [AnimalDetailController::class, 'index'])->name('animal.detail');

//Animal Barcode
Route::get('data/code/{qrcode}', [AnimalDetailController::class, 'qrcode'])->name('animal.qrcode');