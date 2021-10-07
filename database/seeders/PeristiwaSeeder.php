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
            'foto' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/perusahaan/gallery/o2Bplx0NeqOcRccUdqJNJpBFJvpNBMegUAbBWAQj.jpg',
            'created_by' => '2',
            'updated_by' => '2',
        ]);

        Peristiwa::create([
            'animal_id' => '2',
            'tanggal' => date('d M Y'),
            'waktu' => date('H:i'),
            'peristiwa' => 'Lahir',
            'keterangan' => 'Baru lahir',
            'foto' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/perusahaan/gallery/KSOU9qfxe1qSPiL8RvasNps2zkmzVUzYIQkhFmfC.jpg',
            'created_by' => '2',
            'updated_by' => '2',
        ]);
    }
}
