<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(SuperAdminSeeder::class);
        $this->call(MasterSeeder::class);
        $this->call(OfficeSeeder::class);
        $this->call(FarmSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AnimalSeeder::class);
        $this->call(OperatorSeeder::class);
    }
}
