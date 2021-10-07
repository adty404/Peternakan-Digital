<?php

namespace Database\Seeders;

use App\Models\Peristiwa;
use Illuminate\Database\Seeder;

class PeristiwaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Peristiwa::create([
            'animal_id' => '1',
            'tanggal' => date('d M Y'),
            'waktu' => date('H:i'),
            'peristiwa' => 'Lahir',
            'keterangan' => 'Baru lahir',
            'foto' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/peternakan/gallery/Dq8VTaG7Zfhw0sO8YU8DeVy5BhJkezrWRwXLy9xa.jpg',
            'created_by' => '2',
            'updated_by' => '2',
        ]);
    }
}
