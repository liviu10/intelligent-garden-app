<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateArduinoEquipmentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arduino_equipment_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arduino_list_of_equipment_id');
            $table->float('equipment_value', 8, 2);
            $table->timestamps();
        });
        DB::unprepared('ALTER TABLE `intelligent_garden`.`arduino_equipment_records` CHANGE COLUMN `equipment_value` `equipment_value` FLOAT(8,2) NOT NULL;');
        DB::unprepared(
            'ALTER TABLE `intelligent_garden`.`arduino_equipment_records` 
            ADD CONSTRAINT `EquipmentID` FOREIGN KEY (`equipment_id`)
            REFERENCES `intelligent_garden`.`arduino_list_of_equipments` (`equipment_id`) ON DELETE RESTRICT ON UPDATE CASCADE;'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arduino_equipment_records');
    }
}
