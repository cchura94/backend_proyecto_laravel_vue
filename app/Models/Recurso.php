<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    public function proyectos() {
        return $this->belongsToMany(Proyecto::class);
    }
}
