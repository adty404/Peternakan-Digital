<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();

        if($user->role == 'master'){
            return view('pages.admin.dashboard');
        }

        return redirect('/');
    }
}
