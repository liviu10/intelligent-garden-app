<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateArduinoListOfErrorsTable extends Migration
{
    /**
     * Run the migration (creating the table arduino_list_of_equipments).
     * This script will create in the current database the following columns and datatype:
     * id                       = BIGINT(20), primary key, not null, unique, auto-increment
     * error_code               = VARCHAR(15), primary key, not null
     * error_description        = VARCHAR(255), not null
     * error_notes              = VARCHAR(255), not null
     * created_at               = TIMESTAMP
     * updated_at               = TIMESTAMP
     * @return void
     */
    public function up()
    {
        /* create() method will create in the current database the arduino_list_of_errors table */
        Schema::create('arduino_list_of_errors', function (Blueprint $table) {
            $table->id();
            $table->string('error_code', 15)->unique('error_code');
            $table->string('error_description', 255);
            $table->string('error_notes', 255);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        /** 
         * In laravel there cannot be declared two primary keys using create() method.
         * unprepared() method will alter the newly created table by adding another primary key.
        */
        DB::unprepared(
            'ALTER TABLE `intelligent_garden`.`arduino_list_of_errors` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `error_code`);'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arduino_list_of_errors');
    }
}
