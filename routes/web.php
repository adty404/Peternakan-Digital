<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalDetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FarmDetailController;
use App\Http\Controllers\GalleryAnimalController;
use App\Http\Controllers\GalleryFarmController;
use App\Http\Controllers\GalleryOfficeController;
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
    Route::get('data', [AnimalController::class, 'index'])->name('data.index');
    Route::get('data/{animal}/edit', [AnimalController::class, 'edit'])->name('data.edit');
    Route::put('data/{animal}', [AnimalController::class, 'update'])->name('data.update');
    Route::delete('data/{animal}', [AnimalController::class, 'destroy'])->name('data.destroy');
    Route::get('data/more/{id}', [AnimalController::class, 'more'])->name('data.more');

    //Gallery Animal
    Route::get('animal-gallery/{id}', [GalleryAnimalController::class, 'index'])->name('animal-gallery.index');
    Route::get('animal-gallery/create/{gallery}', [GalleryAnimalController::class, 'create'])->name('animal-gallery.create');
    Route::post('animal-gallery', [GalleryAnimalController::class, 'store'])->name('animal-gallery.store');
    Route::delete('animal-gallery/destroy/{gallery}', [GalleryAnimalController::class, 'destroy'])->name('animal-gallery.destroy');
});

Route::group(['middleware' => ['auth', 'checkRole:master,super-admin,admin']], function(){
    //Category
    Route::resource('category', CategoryController::class);

    //Animal
    Route::get('data/create', [AnimalController::class, 'create'])->name('data.create');
    Route::post('data', [AnimalController::class, 'store'])->name('data.store');
});

Route::group(['middleware' => ['auth', 'checkRole:master,super-admin']], function(){
    //User Office
    Route::resource('user-office', UserOfficeController::class);

    //User Farm
    Route::resource('user-farm', UserFarmController::class);

    //Farm
    Route::resource('farm', FarmController::class);
    Route::get('farm/more/{id}', [FarmController::class, 'more'])->name('farm.more');

    //Gallery Farm
    Route::get('farm-gallery/{code}', [GalleryFarmController::class, 'index'])->name('farm-gallery.index');
    Route::get('farm-gallery/create/{gallery}', [GalleryFarmController::class, 'create'])->name('farm-gallery.create');
    Route::post('farm-gallery', [GalleryFarmController::class, 'store'])->name('farm-gallery.store');
    Route::delete('farm-gallery/destroy/{gallery}', [GalleryFarmController::class, 'destroy'])->name('farm-gallery.destroy');

    //Gallery Office
    Route::get('officepics/{code}', [GalleryOfficeController::class, 'index'])->name('officepics.index');
    Route::get('officepics/create/{gallery}', [GalleryOfficeController::class, 'create'])->name('officepics.create');
    Route::post('officepics', [GalleryOfficeController::class, 'store'])->name('officepics.store');
    Route::delete('officepics/destroy/{gallery}', [GalleryOfficeController::class, 'destroy'])->name('officepics.destroy');

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

//Farm Detail
Route::get('farm/detail/{qrcode}', [FarmDetailController::class, 'index'])->name('farm.detail');

//Farm Barcode
Route::get('farm/code/{qrcode}', [FarmDetailController::class, 'qrcode'])->name('farm.qrcode');