<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalDetailController extends Controller
{
    public function index($qrcode){

        $animal = Animal::with(['category', 'farm', 'cb', 'ub'])->where('qrcode', $qrcode)->first();
        return view('pages.admin.animal_detail.index', [
            'animal' => $animal
        ]);
    }

    public function qrcode($qrcode){
        return view('pages.admin.animal_detail.qrcode', [
            'link' => route('animal.detail', ['qrcode' => $qrcode]),
        ]);
    }
}
