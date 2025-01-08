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
        Schema::create('tarea_user', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("tarea_id")->unsigned();
            $table->foreign("tarea_id")->references("id")->on("tareas");

            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea_user');
    }
};
