<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status'];

    /**
     * Relación Muchos a Muchos con Usuarios
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

    /**
     * 👇 ESTA ES LA FUNCIÓN QUE FALTABA 👇
     * Relación Muchos a Muchos con Permisos
     */
    public function permissions()
    {
        // Definimos la tabla pivote 'permission_role' y las llaves foráneas
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}