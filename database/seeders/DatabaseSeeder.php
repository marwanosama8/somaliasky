<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()
        ->times(1)
        ->create();
    
    
        $this->call([
            // PackageSeeder::class,
            // UsersSeeder::class,
            // SettingsSeeder::class,
            // PagesSeeder::class,
            // MenusSeeder::class,
            // \Database\Seeders\CitySeeder::class,
            // \Database\Seeders\CountrySeeder::class
             \Database\Seeders\CounterSeeder::class
        ]);
    }
}

