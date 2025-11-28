<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden guardar masivamente.
     * 'url' guardará la ruta del archivo (ej: 'tickets/foto1.jpg')
     */
    protected $fillable = [
        'url',
        'imageable_id',
        'imageable_type',
    ];

    /**
     * Relación Polimórfica Inversa.
     * Le dice a Laravel: "Esta imagen pertenece a 'algo' (puede ser un Ticket, un Usuario, etc.)"
     * Laravel mirará 'imageable_type' para saber el modelo y 'imageable_id' para saber el ID.
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}