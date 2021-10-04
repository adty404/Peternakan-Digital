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
            'picture' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/peternakan/gallery/K3KZdqEWQdSFDQVo3LyCXZ276ybNmT8YVBK5NjQu.jpg',
            'created_by' => '1',
            'updated_by' => '1',
        ]);
    }
}
