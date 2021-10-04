<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryAnimalRequest;
use App\Models\Animal;
use App\Models\Gallery;
use App\Models\GalleryAnimal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryAnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $gallery = GalleryAnimal::where('animal_id', $id)->orderBy("id", "desc")->paginate(6);
        
        return view('pages.admin.gallery_animal.index', [
            'gallery' => $gallery,
            'animal' => Animal::where('id', $id)->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gallery)
    {
        $animal = Animal::where('id', $gallery)->first();

        return view('pages.admin.gallery_animal.create', [
            'gallery' => $gallery,
            'animal' => $animal
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryAnimalRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('picture')){
            $path = Storage::disk('s3')->putFile('ternak/perusahaan/gallery', $request->picture, 'public');
            $picture = Storage::cloud()->url($path);
        }

        $data['picture'] = $picture;

        GalleryAnimal::create($data);

        Alert::success('Success', 'Berhasil menambahkan data Gallery');
        return redirect()->route('animal-gallery.index', ['id' => $request->animal_id]);
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
    public function destroy(GalleryAnimal $gallery)
    {
        $gallery->delete();

        return redirect()->route('animal-gallery.index', ['id' => $gallery->animal_id]);
    }
}
