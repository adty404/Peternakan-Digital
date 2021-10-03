<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;

class FarmDetailController extends Controller
{
    public function index($qrcode){

        $farm = Farm::where('qrcode', $qrcode)->first();
        return view('pages.admin.farm_detail.index', [
            'farm' => $farm
        ]);
    }

    public function qrcode($qrcode){
        return view('pages.admin.farm_detail.qrcode', [
            'link' => route('farm.detail', ['qrcode' => $qrcode]),
        ]);
    }
}
