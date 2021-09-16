<?php

namespace Database\Seeders;

use App\Models\Farm;
use Illuminate\Database\Seeder;

class FarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Farm::create([
            'code' => 'JG7qgPzT3JHCf56DG4YI',
            'office_id' => '1',
            'name' => 'Farm Test 1',
            'address' => 'Farm Address 1',
            'email' => 'farm1-test@peternakan.com',
            'phone' => '081344123312',
            'pic' => 'Pic farm 1',
        ]);
    }
}