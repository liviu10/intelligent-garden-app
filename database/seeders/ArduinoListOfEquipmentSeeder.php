<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArduinoListOfEquipment;
use Illuminate\Support\Facades\DB;

class ArduinoListOfEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        ArduinoListOfEquipment::truncate();
        $records = [
            [
                'id'                    => '1',
                'equipment_id'          => 'SENZOR_PH',
                'equipment_description' => 'Senzor de PH',
                'equipment_notes'       => 'Valorile acestui echipament trebuie sa fie intre 0.00 si 14.00',
                'created_at'            => '2021-07-01 07:42:00',
                'updated_at'            => '2021-07-01 07:42:00',
            ],
            [
                'id'                    => '2',
                'equipment_id'          => 'SENZOR_EC',
                'equipment_description' => 'Senzor de conductivitate electrica',
                'equipment_notes'       => 'Valorile acestui echipament trebuie sa fie intre 0.70 si 1.20. Pe langa valoarea bruta este afisata si valoarea in unitatea de masura truncheon [ppm].',
                'created_at'            => '2021-07-01 07:42:00',
                'updated_at'            => '2021-07-01 07:42:00',
            ],
            [
                'id'                    => '3',
                'equipment_id'          => 'SENZOR_NIVEL',
                'equipment_description' => 'Senzor de Nivel',
                'equipment_notes'       => 'Valorile acestui echipament trebuie sa fie 0 sau 1 (0 = nivelul apei din bazin este normal; 1 = nivelul apei din bazin este maxim)',
                'created_at'            => '2021-07-01 07:42:00',
                'updated_at'            => '2021-07-01 07:42:00',
            ],
            [
                'id'                    => '4',
                'equipment_id'          => 'POMPA_1',
                'equipment_description' => 'Pompa PH--',
                'equipment_notes'       => 'Valorile acestui echipament trebuie sa fie 0 sau 1 (0 = pompa este oprita; 1 = pompa este pornita)',
                'created_at'            => '2021-07-01 07:42:00',
                'updated_at'            => '2021-07-01 07:42:00',
            ],
            [
                'id'                    => '5',
                'equipment_id'          => 'POMPA_2',
                'equipment_description' => 'Pompa PH++',
                'equipment_notes'       => 'Valorile acestui echipament trebuie sa fie 0 sau 1 (0 = pompa este oprita; 1 = pompa este pornita)',
                'created_at'            => '2021-07-01 07:42:00',
                'updated_at'            => '2021-07-01 07:42:00',
            ],
            [
                'id'                    => '6',
                'equipment_id'          => 'POMPA_3',
                'equipment_description' => 'Pompa Nutrienti',
                'equipment_notes'       => 'Valorile acestui echipament trebuie sa fie 0 sau 1 (0 = pompa este oprita; 1 = pompa este pornita)',
                'created_at'            => '2021-07-01 07:42:00',
                'updated_at'            => '2021-07-01 07:42:00',
            ],
        ];
        ArduinoListOfEquipment::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
