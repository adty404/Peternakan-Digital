<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GalleryOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gallery::create([
            'code' => 'dPFSATjAxlkeHlD8Euz4',
            'picture' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/perusahaan/gallery/IMC0OrcJsmhCDFBGU79sVi9r5DTpLDnnJ5Dx01ei.jpg',
            'created_by' => '1',
            'updated_by' => '1',
        ]);

        Gallery::create([
            'code' => 'dPFSATjAxlkeHlD8Euz4',
            'picture' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/perusahaan/gallery/jlhB3AMPSiSaYTIR71h3Gk1t9YsdIqouTUzy25h7.jpg',
            'created_by' => '1',
            'updated_by' => '1',
        ]);
    }
}
