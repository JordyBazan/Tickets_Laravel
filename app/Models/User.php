<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',       // Antes era 'name'
        'last_name',        // Nuevo campo
        'email',
        'password',
        'document_number',  // Nuevo campo
        'document_type_id', // Nuevo campo
        'status',           // Nuevo campo
        'ticket_assignment_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    // Relación: Un usuario pertenece a un Taller
    public function taller()
    {
        return $this->belongsTo(TicketAssignment::class, 'ticket_assignment_id');
    }

    public function hasAnyRole(array $roles)
    {
        return $this->roles()->whereIn('title', $roles)->exists();
    }


    // 1. Relación Directa con Permisos (NUEVA)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }

    
    // 3. LÓGICA MAESTRA DE VERIFICACIÓN
    public function hasPermission(string $permissionName)
    {
        // A. Si es Admin, pase libre
        if ($this->roles()->where('title', 'Administrador')->exists()) {
            return true;
        }

        // B. ¿Tiene el permiso DIRECTAMENTE asignado al usuario?
        if ($this->permissions()->where('title', $permissionName)->exists()) {
            return true;
        }

        // C. ¿Tiene el permiso a través de su ROL?
        return $this->roles()->whereHas('permissions', function ($query) use ($permissionName) {
            $query->where('title', $permissionName);
        })->exists();
    }
    
}
