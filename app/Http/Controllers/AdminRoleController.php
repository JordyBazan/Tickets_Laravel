<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    /**
     * SEGURIDAD: Solo Admin y Jefe.
     */


    /**
     * 1. LISTAR ROLES
     */
    public function index()
    {
        // Listamos los roles (excepto Super Admin si quisieras ocultarlo, pero mejor mostrar todos)
        $roles = Role::orderBy('id')->get();
        return view('rrff.roles.lista_roles', compact('roles'));
    }

    /**
     * 2. EDITAR PERMISOS (Vista)
     */
    public function editPermissions($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        
        // Agrupamos los permisos por "Menú" para que la vista sea ordenada
        $permissionsGrouped = Permission::all()->groupBy('menu');

        return view('rrff.roles.asignar_permisos', compact('role', 'permissionsGrouped'));
    }

    /**
     * 3. GUARDAR CAMBIOS
     */
    public function updatePermissions(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        
        // Sincronizamos los checkboxes marcados
        // Si no marca ninguno, enviamos array vacío
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('rrff.roles.index')
            ->with('success', "Permisos del rol '{$role->title}' actualizados.");
    }
}