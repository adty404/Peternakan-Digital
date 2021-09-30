<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeRequest;
use App\Http\Requests\OfficeUpdateRequest;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Office::query();

            return DataTables::of($query)
            ->addColumn('aksi', 'pages.admin.office.action')
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->toJson();
        }
        return view('pages.admin.office.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.office.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('logo')){
            $path = Storage::disk('s3')->putFile('ternak/perusahaan/logo', $request->logo, 'public');
            $logo = Storage::cloud()->url($path);
        }

        $data['code'] = Str::random(20);
        $data['logo'] = $logo;

        Office::create($data);

        Alert::success('Success', 'Berhasil menambahkan data Perusahaan');
        return redirect()->route('office.index');
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
        $office = Office::findOrFail($id);

        return view('pages.admin.office.profile-edit', [
            'office' => $office
        ]);
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
        $data = $request->all();
        $office = Office::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'email' => ['unique:office,email,'.$office->id],
            'phone' => ['unique:office,phone,'.$office->id],
            'pic' => ['required', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        if($request->hasFile('logo') && $request->has('logo')){
            $path = Storage::disk('s3')->putFile('ternak/perusahaan/logo', $request->logo, 'public');
            $logo = Storage::cloud()->url($path);
        }else{
            $logo = $office->logo;
        }

        $data['logo'] = $logo;
        $office->update($data);

        if(auth()->user()->role == 'super-admin'){
            Alert::success('Success', 'Berhasil mengubah data Perusahaan');
            return redirect()->route('dashboard');
        }else if(auth()->user()->role == 'master'){
            Alert::success('Success', 'Berhasil mengubah data Perusahaan');
            return redirect()->route('office.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return redirect()->route('office.index');
    }
}
