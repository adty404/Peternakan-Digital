<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Gallery;
use Illuminate\Http\Request;

class FarmDetailController extends Controller
{
    public function index($qrcode){

        $farm = Farm::where('qrcode', $qrcode)->first();

        $gallery = Gallery::where('code', $farm->code)->orderBy("id", "desc")->paginate(3);

        return view('pages.admin.farm_detail.index', [
            'farm' => $farm,
            'gallery' => $gallery
        ]);
    }

    public function qrcode($qrcode){
        return view('pages.admin.farm_detail.qrcode', [
            'link' => route('farm.detail', ['qrcode' => $qrcode]),
        ]);
    }
}
