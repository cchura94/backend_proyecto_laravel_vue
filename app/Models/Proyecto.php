<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    public function jefe_proyecto() {
        return $this->belongsTo(User::class, "jefe_proyecto");
    }

    public function tareas() {
        return $this->hasMany(Tarea::class);
    }

    public function recursos() {
        return $this->belongsToMany(Recurso::class);
    }

    public function informes() {
        return $this->hasMany(Informe::class);
    }
}
