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
        Schema::table('equipment_readings', function (Blueprint $table) {
            $table->foreignId('list_of_equipment_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->index('idx_equipment_readings_list_of_equipment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment_readings', function (Blueprint $table) {
            $table->dropForeign(['list_of_equipment']);
            $table->dropColumn('list_of_equipment');
        });
    }
};
