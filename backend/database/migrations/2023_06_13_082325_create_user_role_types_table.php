<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role_types', function (Blueprint $table) {
            $table->id()->index('idx_id');
            $table->string('user_role_name');
            $table->string('user_role_description');
            $table->string('user_role_slug');
            $table->boolean('user_role_is_active')->nullable(true)->default(false);
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
        Schema::dropIfExists('user_role_types');
    }
}
