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
        Schema::create('list_of_equipments', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->string('equipment_id', 15)->unique('equipment_id');
            $table->string('equipment_description');
            $table->longText('equipment_notes');
            $table->boolean('equipment_is_active')->nullable(true)->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_of_equipments');
    }
};
