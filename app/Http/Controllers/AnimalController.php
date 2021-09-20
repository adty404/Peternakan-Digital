<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Farm;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\DataTables;

class AnimalController extends Controller
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
            $query = Animal::query();
        }else if($user['role'] == 'super-admin'){
            $office_id = auth()->user()->office->id;
            $farm_id = Farm::where('office_id', $office_id)->first();

            $query = Animal::where('farm_id', $farm_id['id']);
        }else if($user['role'] == 'admin' || $user['role'] == 'operator'){
            $farm_id = auth()->user()->farm->id;

            $query = Animal::where('farm_id', $farm_id);
        }

        if (request()->ajax()) {

            return DataTables::of($query)
            ->addColumn('aksi', 'pages.admin.animal.action')
            ->addColumn('category', function($animal){
                return $animal->category['name'];
            })
            ->addColumn('farm', function($animal){
                return $animal->farm['name'];
            })
            ->addColumn('created_by', function($animal){
                return $animal->cb['name'];
            })
            ->addColumn('updated_by', function($animal){
                return $animal->ub['name'];
            })
            ->addColumn('updated_at', function($animal){
                return $animal->updated_at->format('d M Y, H:i');
            })
            ->addColumn('barcode', function ($animal) {
                $barcode_link = route('animal.detail', ['barcode' => $animal['barcode']]);
                $barcode = QrCode::format('png')->size(500)->generate($barcode_link);

                // return '
                //     <a href="data:image/png;base64, '.base64_encode($barcode).'" target="_blank"><img src="data:image/png;base64, '.base64_encode($barcode).'"></a>
                // ';

                return '
                    <a href="data:image/png;base64, '.base64_encode($barcode).'" target="_blank" style="color:black; font-size:20px;"><i class="fa fa-qrcode"></i></a>
                    <span style="color:white; font-size:0px;">'. $barcode_link .'</span>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['aksi', 'barcode'])
            ->make(true);
        }
        return view('pages.admin.animal.index');
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
