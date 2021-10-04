<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\GalleryAnimal;
use Illuminate\Http\Request;

class AnimalDetailController extends Controller
{
    public function index($qrcode){

        $animal = Animal::with(['category', 'farm', 'cb', 'ub'])->where('qrcode', $qrcode)->first();

        $gallery = GalleryAnimal::where('animal_id', $animal->id)->orderBy("id", "desc")->paginate(3);

        return view('pages.admin.animal_detail.index', [
            'animal' => $animal,
            'gallery' => $gallery
        ]);
    }

    public function qrcode($qrcode){
        return view('pages.admin.animal_detail.qrcode', [
            'link' => route('animal.detail', ['qrcode' => $qrcode]),
        ]);
    }
}
