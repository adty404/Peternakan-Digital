<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GalleryFarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gallery::create([
            'code' => 'JG7qgPzT3JHCf56DG4YI',
            'picture' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/peternakan/gallery/Dq8VTaG7Zfhw0sO8YU8DeVy5BhJkezrWRwXLy9xa.jpg',
            'created_by' => '1',
            'updated_by' => '1',
        ]);
    }
}
