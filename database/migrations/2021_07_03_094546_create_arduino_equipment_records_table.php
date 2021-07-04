<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateArduinoEquipmentRecordsTable extends Migration
{
    /**
     * Run the migration (creating the table arduino_equipment_records).
     * This script will create in the current database the following columns and datatype:
     * id                   = BIGINT(20), primary key, not null, unique, auto-increment
     * equipment_id         = VARCHAR(15), primary key, not null
     * equipment_value      = FLOAT(8,2), not null
     * created_at           = TIMESTAMP
     * updated_at           = TIMESTAMP
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arduino_equipment_records', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_id', 15);
            $table->float('equipment_value', 8, 2);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        /** 
         * In laravel there cannot be declared float datatype by using create() method.
         * unprepared() method will alter the newly created table by modifying the datatype to float.
         * and setting up a foreign key that have the following actions:
         *  - deleting a certain record from "arduino_equipment_records" is prohibited;
         *  - updating a certain record from "arduino_equipment_records" is allowed;
        */
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
