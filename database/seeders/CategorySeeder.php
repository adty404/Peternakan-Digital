<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Etawa',
            'created_by' => '1',
            'updated_by' => '1',
        ]);

        Category::create([
            'name' => 'Jawa',
            'created_by' => '1',
            'updated_by' => '1',
        ]);
    }
}
