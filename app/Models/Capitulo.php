<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;

    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nombre'] = ucfirst($value);
    }
}
