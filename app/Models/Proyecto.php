<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
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
