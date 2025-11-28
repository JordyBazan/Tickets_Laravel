<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // 1. Mostrar la lista de usuarios
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('rrff.users.lista_usuarios', compact('users'));
    }

    // 2. Mostrar el formulario (Aquí es donde llamamos a la vista con el HTML)
    public function create()
    {
        // Traemos todos los roles para el select
        $roles = Role::where('status', 1)->get(); 
        
        return view('rrff.users.crear_usuario', compact('roles'));
    }

    // 3. Guardar los datos en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'document_number' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id', // <--- Validación del Rol
        ]);

        // 1. Crear el Usuario
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'document_number' => $request->document_number,
            'document_type_id' => 1,
            'status' => 1,
        ]);

        // 2. Asignar el Rol (Llenar la tabla intermedia role_user)
        $user->roles()->attach($request->role_id);

        return redirect()->route('rrff.users.index')->with('success', 'Usuario registrado y rol asignado.');
    }
}