<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database by calling the Seeder Class
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ArduinoListOfEquipmentSeeder::class,
        ]);
    }
}
