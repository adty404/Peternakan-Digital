<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Http\Requests\AnimalUpdateRequest;
use App\Models\Animal;
use App\Models\Category;
use App\Models\Farm;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
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
            $query = auth()->user()->office->animal;
        }else if($user['role'] == 'admin' || $user['role'] == 'operator'){
            $farm_id = auth()->user()->farm->id;

            $query = Animal::where('farm_id', $farm_id);
        }

        if (request()->ajax()) {

            return DataTables::of($query)
            ->addColumn('aksi', function($animal){
                $data = [
                    'id' => $animal->id
                ];
                return view('pages.admin.animal.action')->with('data', $data);
            })
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
            ->addColumn('qrcode', function ($animal) {
                $qrcode_link = route('animal.detail', ['qrcode' => $animal['qrcode']]);
                $qrcode = QrCode::format('png')->size(500)->generate($qrcode_link);

                // return '
                //     <a href="data:image/png;base64, '.base64_encode($qrcode).'" target="_blank" style="color:black; font-size:20px;"><i class="fa fa-qrcode"></i></a>
                //     <span style="color:white; font-size:0px;">'. $barcode_link .'</span>
                // ';
                return '
                <a href="'.route('animal.qrcode', ['qrcode' => $animal['qrcode']]).'" target="_blank" style="color:black; font-size:20px;"><i class="fa fa-qrcode"></i></a>
                <span style="color:white; font-size:0px;">'. $qrcode_link .'</span>
                ';
            })
            ->addColumn('gallery', function($animal) {
                return '<a href="'.route('animal-gallery.index', ['id' => $animal['id']]).'" class="btn btn-primary btn-sm" style="margin-top: 5px;">Foto</a>';
            })
            ->addIndexColumn()
            ->rawColumns(['category', 'farm', 'created_by', 'updated_by', 'aksi', 'qrcode', 'gallery'])
            ->make(true);
        }
        return view('pages.admin.animal.index');
    }

    public function more($id){
        $animal = Animal::findOrFail($id);

        return view('pages.admin.animal.more', [
            'animal' => $animal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        if($user['role'] == 'master'){
            $farms = Farm::all();
        }else if($user['role'] == 'super-admin'){
            $office_id = auth()->user()->office->id;
            $farms = Farm::where('office_id', $office_id)->get();
        }else if($user['role'] == 'admin' || $user['role'] == 'operator'){
            $office_id = auth()->user()->farm->office_id;

            $farms = Farm::where('office_id', $office_id)->get();
        }

        $categories = Category::all();

        return view('pages.admin.animal.create', [
            'categories' => $categories,
            'farms' => $farms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalRequest $request)
    {
        // dd($request->all());
        
        $data = $request->all();

        $data['qrcode'] = Str::random(8);
        $data['status'] = 'Lahir';

        Animal::create($data);

        Alert::success('Success', 'Berhasil menambahkan data Hewan');
        return redirect()->route('data.index');
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
        $animal = Animal::findOrFail($id);

        if($user['role'] == 'master'){
            $farms = Farm::all();
        }else if($user['role'] == 'super-admin'){
            $office_id = auth()->user()->office->id;
            $farms = Farm::where('office_id', $office_id)->get();
        }else if($user['role'] == 'admin' || $user['role'] == 'operator'){
            $office_id = auth()->user()->farm->office_id;

            $farms = Farm::where('office_id', $office_id)->get();
        }

        $categories = Category::all();

        return view('pages.admin.animal.edit', [
            'categories' => $categories,
            'farms' => $farms,
            'animal' => $animal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalUpdateRequest $request, Animal $animal)
    {
        $data = $request->all();

        $animal->update($data);

        Alert::success('Success', 'Berhasil mengubah data Hewan');
        return redirect()->route('data.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();

        return redirect()->route('data.index');
    }
}
