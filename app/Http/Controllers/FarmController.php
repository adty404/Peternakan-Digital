<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $office_id = auth()->user()->office->id;

        $user = auth()->user();

        if($user['role'] == 'master'){
            $query = Farm::query();
        }else if($user['role'] == 'super-admin'){
            $query = Farm::where('office_id', $office_id);
        }

        if (request()->ajax()) {

            return DataTables::of($query)
            ->addColumn('aksi', 'pages.admin.farm.action')
            ->addColumn('office', function($farm){
                return $farm->office['name'];
            })
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->toJson();
        }
        return view('pages.admin.farm.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
