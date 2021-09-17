<?php

namespace App\Http\Controllers;

use App\Http\Requests\FarmRequest;
use App\Http\Requests\FarmUpdateRequest;
use App\Models\Farm;
use App\Models\Office;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if($user['role'] == 'master'){
            $query = Farm::query();
        }else if($user['role'] == 'super-admin'){
            $office_id = auth()->user()->office->id;

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
        $user = auth()->user();

        $offices = Office::all();

        return view('pages.admin.farm.create', [
            'offices' => $offices,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FarmRequest $request)
    {
        $data = $request->all();

        $data['code'] = Str::random(20);

        Farm::create($data);

        Alert::success('Success', 'Data Farm Successfully Created');
        return redirect()->route('farm.index');//
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
        
        $user = auth()->user();
        $farm = Farm::findOrFail($id);

        if($user['role'] == 'master'){
            $offices = Office::all();
        }else if($user['role'] == 'super-admin'){
            $office_id = auth()->user()->office->id;

            $offices = Office::where('id', $office_id)->get();
        }
        
        return view('pages.admin.farm.edit', [
            'farm' => $farm,
            'offices' => $offices
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FarmUpdateRequest $request, Farm $farm)
    {
        $data = $request->all();

        $farm->update($data);

        Alert::success('Success', 'Data Farm Successfully Updated');
        return redirect()->route('farm.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farm $farm)
    {
        $farm->delete();

        return redirect()->route('farm.index');
    }
}
