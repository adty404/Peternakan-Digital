<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalDetailController extends Controller
{
    public function index($barcode){

        $animal = Animal::with(['category', 'farm', 'cb', 'ub'])->where('barcode', $barcode)->first();
        return view('pages.admin.animal_detail.index', [
            'animal' => $animal
        ]);
    }
}
