<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

// 👇 ESTAS SON LAS LÍNEAS QUE FALTABAN 👇
use App\Models\Permission;
use App\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. DESACTIVAR SEGURIDAD
        Schema::disableForeignKeyConstraints();
        
        // 2. LIMPIAR TABLAS (Borrar si existen para evitar conflictos)
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        
        // 3. CREAR TABLA PERMISSIONS
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150)->unique();
            $table->string('menu', 150);
            $table->string('permission', 150);
            $table->timestamps();
        });

        // 4. CREAR TABLA PIVOTE
        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();
        });

        // 5. INSERTAR PERMISOS
        $perms = [
            ['title' => 'dashboard_view',      'menu' => 'Dashboard',     'permission' => 'View'],
            ['title' => 'ticket_bandeja_view', 'menu' => 'Ticket',        'permission' => 'View Index'],
            ['title' => 'ticket_assign_edit',  'menu' => 'Ticket',        'permission' => 'Assign/Edit'],
            ['title' => 'ticket_admin_delete', 'menu' => 'Ticket',        'permission' => 'Delete'],
            ['title' => 'ticket_execution',    'menu' => 'Ticket',        'permission' => 'Execute/Log'],
            ['title' => 'user_index',          'menu' => 'User Mgmt',     'permission' => 'View List'],
            ['title' => 'user_create_edit',    'menu' => 'User Mgmt',     'permission' => 'Create/Edit'],
            ['title' => 'user_delete',         'menu' => 'User Mgmt',     'permission' => 'Delete'],
            ['title' => 'role_manage',         'menu' => 'Roles',         'permission' => 'Manage'],
            ['title' => 'settings_manage',     'menu' => 'Settings',      'permission' => 'Manage Catalogs'],
        ];

        DB::table('permissions')->insert($perms);

        // 6. ASIGNAR AL ADMINISTRADOR
        $adminRole = Role::where('title', 'Administrador')->first();
        if ($adminRole) {
            // Ahora sí encontrará la clase Permission gracias al 'use' arriba
            $allPerms = Permission::pluck('id')->toArray();
            $adminRole->permissions()->sync($allPerms);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}