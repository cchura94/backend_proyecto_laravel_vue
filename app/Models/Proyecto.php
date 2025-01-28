<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    public function jefe_proyecto_data() {
        return $this->belongsTo(User::class, "jefe_proyecto");
    }

    public function tareas() {
        return $this->hasMany(Tarea::class);
    }

    public function recursos() {
        return $this->belongsToMany(Recurso::class)->withPivot(["cantidad_asignada", "fecha_asignacion", "responsable_id"]);
    }

    public function informes() {
        return $this->hasMany(Informe::class);
    }

    /*
    public function users() {
        return $this->hasMany(User::class);
    }
    */
}
