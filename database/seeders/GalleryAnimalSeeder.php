<?php

namespace Database\Seeders;

use App\Models\GalleryAnimal;
use Illuminate\Database\Seeder;

class GalleryAnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GalleryAnimal::create([
            'animal_id' => '1',
            'picture' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/perusahaan/gallery/o2Bplx0NeqOcRccUdqJNJpBFJvpNBMegUAbBWAQj.jpg',
            'created_by' => '1',
            'updated_by' => '1',
        ]);

        GalleryAnimal::create([
            'animal_id' => '1',
            'picture' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/perusahaan/gallery/QvsFnsQseFEpfCfoYLJsHkOBN6NN7Q1VliNZ7iVX.jpg',
            'created_by' => '1',
            'updated_by' => '1',
        ]);

        GalleryAnimal::create([
            'animal_id' => '2',
            'picture' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/perusahaan/gallery/KSOU9qfxe1qSPiL8RvasNps2zkmzVUzYIQkhFmfC.jpg',
            'created_by' => '1',
            'updated_by' => '1',
        ]);
    }
}
