<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryOfficeRequest;
use App\Models\Gallery;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {
        $gallery = Gallery::where('code', $code)->orderBy("id", "desc")->paginate(6);
        
        return view('pages.admin.gallery_office.index', [
            'gallery' => $gallery,
            'office' => Office::where('code', $code)->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gallery)
    {
        $office = Office::where('code', $gallery)->first();

        return view('pages.admin.gallery_office.create', [
            'gallery' => $gallery,
            'office' => $office
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryOfficeRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('picture')){
            $path = Storage::disk('s3')->putFile('ternak/perusahaan/gallery', $request->picture, 'public');
            $picture = Storage::cloud()->url($path);
        }

        $data['picture'] = $picture;

        Gallery::create($data);

        Alert::success('Success', 'Berhasil menambahkan data Gallery');
        return redirect()->route('office-gallery.index', ['code' => $request->code]);
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

        return redirect()->route('office-gallery.index', ['code' => $gallery->code]);
    }
}
