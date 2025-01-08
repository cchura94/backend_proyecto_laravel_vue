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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->text("descripcion")->nullable();
            $table->date("fecha_inicio");
            $table->date("fecha_fin");
            $table->enum('estado', ["pendiente", "en progreso", "completado"]);
            $table->enum('prioridad', ["baja", "media", "alta"]);

            $table->bigInteger("proyecto_id")->unsigned();
            $table->foreign("proyecto_id")->references("id")->on("proyectos");
            $table->decimal("porcentaje_avance", 5, 2)->default(0);      

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
