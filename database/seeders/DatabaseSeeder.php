<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $seeder = [
            RoleSeeder::class,
            KkjSeeder::class
        ];

        $this->call($seeder);
    }
}
