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
            'name' => 'Kambing Etawa 001',
            'weight' => '500',
            'height' => '1000',
            'condition' => 'Good',
            'note' => 'Note 1',
            'created_by' => '1',
            'updated_by' => '1',
            'qrcode' => 'HkdDs71S',
            'status' => 'Lahir',
        ]);

        Animal::create([
            'category_id' => '2',
            'farm_id' => '1',
            'name' => 'Jawa Randu 001',
            'weight' => '10',
            'height' => '50',
            'condition' => 'Sehat',
            'note' => 'Usia 2 tahun',
            'created_by' => '1',
            'updated_by' => '1',
            'qrcode' => 'HuWd9s71S',
            'status' => 'Lahir',
        ]);
    }
}
