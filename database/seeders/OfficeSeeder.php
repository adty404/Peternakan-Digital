<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Office::create([
            'code' => 'dPFSATjAxlkeHlD8Euz4',
            'name' => 'Bersama Beternak Berdaya',
            'address' => 'Karangpucung, Cilacap, Jateng',
            'email' => 'email@bbb.co.id',
            'phone' => '081222125534',
            'pic' => 'Bambang',
            'logo' => 'https://cazh-cdn.sgp1.digitaloceanspaces.com/ternak/perusahaan/logo/Mej6CPMKb7HN19aRAzljC2XWRFH6FfeLjlx0C3Ws.png'
        ]);
    }
}
