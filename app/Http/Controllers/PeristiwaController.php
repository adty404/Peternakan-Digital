<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeristiwaUpdateRequest;
use App\Models\Animal;
use App\Models\Peristiwa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\DataTables;

class PeristiwaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Peristiwa::query();

            return DataTables::of($query)
            ->addColumn('aksi', function($peristiwa){
                $data = [
                    'id' => $peristiwa->id
                ];
                return view('pages.admin.peristiwa.action')->with('data', $data);
            })
            ->addColumn('tanggal', function($peristiwa){
                return Carbon::parse($peristiwa->tanggal)->format('d M Y');
            })
            ->addColumn('ternak', function($peristiwa){
                return $peristiwa->animal->name;
            })
            ->addColumn('foto', function($peristiwa) {
                return $peristiwa->foto ? '<a href="' . $peristiwa->foto . '" target="_blank" style="color:black; font-size:20px;"><i class="fas fa-images"></i></a>' : '';
            })
            ->addIndexColumn()
            ->rawColumns(['aksi', 'tanggal', 'ternak', 'foto'])
            ->make(true);
        }
        return view('pages.admin.peristiwa.index');
    }

    public function more($id){
        $peristiwa = Peristiwa::findOrFail($id);

        return view('pages.admin.peristiwa.more', [
            'peristiwa' => $peristiwa,
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
            $animal = Animal::all();
        }else if($user['role'] == 'super-admin'){
            $animal = auth()->user()->office->animal;
        }else if($user['role'] == 'admin' || $user['role'] == 'operator'){
            $farm_id = auth()->user()->farm->id;

            $animal = Animal::where('farm_id', $farm_id)->get();
        }
        
        return view('pages.admin.peristiwa.create', [
            'animal' => $animal
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('foto')){
            $path = Storage::disk('s3')->putFile('ternak/ternak/peristiwa/foto', $request->foto, 'public');
            $foto = Storage::cloud()->url($path);
        }
        
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
        $data['foto'] = $foto;

        Peristiwa::create($data);

        $animal = Animal::where('id', $request->animal_id)->first();
        $animal['status'] = $request->peristiwa;
        $animal->save();

        Alert::success('Success', 'Berhasil menambahkan data Peristiwa');
        return redirect()->route('peristiwa.index');
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
        $peristiwa = Peristiwa::findOrFail($id);

        return view('pages.admin.peristiwa.edit', [
            'peristiwa' => $peristiwa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeristiwaUpdateRequest $request, Peristiwa $peristiwa)
    {
        $data = $request->all();

        $peristiwa->update($data);

        $animal = Animal::where('id', $request->animal_id)->first();
        $animal['status'] = $request->peristiwa;
        $animal->save();

        Alert::success('Success', 'Berhasil mengubah data Peristiwa');
        return redirect()->route('peristiwa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peristiwa $peristiwa)
    {
        $peristiwa->delete();

        $animal = Animal::where('id', $peristiwa->animal_id)->first();
        $animal['status'] = 'Status dihapus';
        $animal->save();

        return redirect()->route('peristiwa.index');
    }
}
