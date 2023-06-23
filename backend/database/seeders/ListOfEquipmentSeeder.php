<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Settings\ListOfEquipment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ListOfEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        ListOfEquipment::truncate();
        $records = [
            [
                'id'                    => 1,
                'equipment_id'          => 'PH_SENSOR',
                'equipment_description' => 'pH Sensor',
                'equipment_notes'       => 'The values of this equipment must be between 0.00 and 14.00',
                'is_active'             => true,
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => 2,
                'equipment_id'          => 'EC_SENSOR',
                'equipment_description' => 'Electrical Conductivity Sensor',
                'equipment_notes'       => 'The values of this equipment must be between 0.70 si 1.20. Besides the gross value it\'s also being displayed the truncheon [ppm] value',
                'is_active'             => true,
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => 3,
                'equipment_id'          => 'LEVEL_SENSOR',
                'equipment_description' => 'Level Sensor',
                'equipment_notes'       => 'The values of this equipment must be 0 or 1 (0 = the water level in the tank is normal; 1 = the water level in the tank is maximum)',
                'is_active'             => true,
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => 4,
                'equipment_id'          => 'PUMP_1',
                'equipment_description' => 'pH-- Pump',
                'equipment_notes'       => 'The values of this equipment must be 0 or 1 (0 = the pump is stopped; 1 = the pump is started)',
                'is_active'             => true,
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => 5,
                'equipment_id'          => 'PUMP_2',
                'equipment_description' => 'pH++ Pump',
                'equipment_notes'       => 'The values of this equipment must be 0 or 1 (0 = the pump is stopped; 1 = the pump is started)',
                'is_active'             => true,
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id'                    => 6,
                'equipment_id'          => 'PUMP_3',
                'equipment_description' => 'Nutrients Pump',
                'equipment_notes'       => 'The values of this equipment must be 0 or 1 (0 = the pump is stopped; 1 = the pump is started)',
                'is_active'             => true,
                'user_id'               => 1,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
        ];
        ListOfEquipment::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
