<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obra extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }

    public function capitulo(): HasMany
    {
        return $this->hasMany(Capitulo::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nombre'] = ucfirst($value);
    }

    protected $attributes = [
        'capitulos' => 0,
        'likes' => 0,
        'imagen' => 'uploads/no-image-placeholder.svg'
    ];
}
