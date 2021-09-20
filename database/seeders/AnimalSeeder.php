<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Animal::create([
            'category_id' => '1',
            'farm_id' => '1',
            'name' => 'Animal 1',
            'weight' => '500',
            'height' => '1000',
            'condition' => 'Good',
            'note' => 'Note 1',
            'created_by' => '1',
            'updated_by' => '1',
            'barcode' => 'HkdDs71S',
        ]);
    }
}
