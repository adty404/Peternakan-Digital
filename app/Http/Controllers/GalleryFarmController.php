<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryFarmRequest;
use App\Models\Farm;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryFarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {
        $gallery = Gallery::where('code', $code)->orderBy("id", "desc")->paginate(6);
        
        return view('pages.admin.gallery_farm.index', [
            'gallery' => $gallery,
            'farm' => Farm::where('code', $code)->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gallery)
    {
        $farm = Farm::where('code', $gallery)->first();

        return view('pages.admin.gallery_farm.create', [
            'gallery' => $gallery,
            'farm' => $farm
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryFarmRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('picture')){
            $path = Storage::disk('s3')->putFile('ternak/peternakan/gallery', $request->picture, 'public');
            $picture = Storage::cloud()->url($path);
        }

        $data['picture'] = $picture;

        Gallery::create($data);

        Alert::success('Success', 'Berhasil menambahkan data Gallery');
        return redirect()->route('farm-gallery.index', ['code' => $request->code]);
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
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('farm-gallery.index', ['code' => $gallery->code]);
    }
}
