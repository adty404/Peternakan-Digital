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
            'picture' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/peternakan/gallery/Dq8VTaG7Zfhw0sO8YU8DeVy5BhJkezrWRwXLy9xa.jpg',
            'created_by' => '1',
            'updated_by' => '1',
        ]);
    }
}
