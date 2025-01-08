<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function proyecto() {
        return $this->belongsTo(Proyecto::class);
    }

    
}
