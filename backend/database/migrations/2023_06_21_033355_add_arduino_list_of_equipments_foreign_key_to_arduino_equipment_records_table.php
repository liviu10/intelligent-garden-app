<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('arduino_equipment_records', function (Blueprint $table) {
            $table->foreignId('arduino_list_of_equipment_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->index('idx_arduino_equipment_records_arduino_list_of_equipment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arduino_equipment_records', function (Blueprint $table) {
            $table->dropForeign(['arduino_list_of_equipment']);
            $table->dropColumn('arduino_list_of_equipment');
        });
    }
};
