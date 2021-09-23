<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Category;
use App\Models\Farm;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();

        if($user['role'] == 'master'){
            $one = User::all()->count();
            $two = Office::all()->count();
            $three = Farm::all()->count();
            $four = Animal::all()->count();
        }else if($user['role'] == 'super-admin'){
            $office_code = auth()->user()->office->code;
            $office_id = auth()->user()->office->id;

            $one = User::has('office')->where('code', $office_code)->count();
            $two = Farm::where('office_id', $office_id)->count();
            $three = Category::all()->count();
            $four = auth()->user()->office->animal->count();
        }else if($user['role'] == 'admin' || $user['role'] == 'operator'){
            $farm_id = auth()->user()->farm->id;
            $office_id = auth()->user()->farm->office_id;

            $one = Office::where('id', $office_id)->first();
            $two = Farm::where('id', $farm_id)->first();
            $three = Category::all()->count();
            $four = Animal::where('farm_id', $farm_id)->count();
        }

        return view('pages.admin.dashboard', [
            'one' => $one,
            'two' => $two,
            'three' => $three,
            'four' => $four,
        ]);
    }
}
