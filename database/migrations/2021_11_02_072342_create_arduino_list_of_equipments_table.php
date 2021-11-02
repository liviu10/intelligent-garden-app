<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArduinoListOfEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arduino_list_of_equipments', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_id', 15);
            $table->string('equipment_description');
            $table->string('equipment_notes');
            $table->string('equipment_is_active', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arduino_list_of_equipments');
    }
}
