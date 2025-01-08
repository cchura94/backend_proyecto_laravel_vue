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
        Schema::create('proyecto_recurso', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("proyecto_id")->unsigned();
            $table->bigInteger("recurso_id")->unsigned();

            $table->integer("cantidad_asignada")->default(1);
            $table->dateTime("fecha_asignacion");

            $table->bigInteger("responsable_id")->unsigned();
            $table->foreign("responsable_id")->references("id")->on("users");

            $table->foreign("proyecto_id")->references("id")->on("proyectos");

            $table->foreign("recurso_id")->references("id")->on("recursos");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_recurso');
    }
};
