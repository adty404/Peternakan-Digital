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
            'name' => 'Office Test 1',
            'address' => 'Office Address 1',
            'email' => 'office1-test@peternakan.com',
            'phone' => '081222125534',
            'pic' => 'Pic office 1',
            'logo' => 'https://picsum.photos/id/0/5616/3744'
        ]);
    }
}
