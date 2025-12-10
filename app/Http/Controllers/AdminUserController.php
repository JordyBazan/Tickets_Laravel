<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\TicketAssignment;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class AdminUserController extends Controller
{
    /**
     * SEGURIDAD BASE: Usamos el permiso de VISTA (user_index) en el constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = $request->user();

            // AHORA CHEQUEAMOS EL PERMISO GRANULAR 'user_index' (Ver la lista)
            if (!$user || !$user->hasPermission('user_index')) {
                abort(403, 'ACCESO DENEGADO: No tienes permisos para ver usuarios.');
            }

            return $next($request);
        });
    }

    // 1. LISTAR (Base check is in constructor)
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('rrff.users.lista_usuarios', compact('users'));
    }

    // 2. CREAR (Formulario)
    public function create()
    {
        // Chequeo de acción específica: Crear/Editar
        if (!auth()->user()->hasPermission('user_create_edit')) {
            abort(403, 'ACCESO DENEGADO: No tienes permiso para crear usuarios.');
        }

        $roles = Role::where('status', 1)->get();
        $talleres = TicketAssignment::where('is_internal', 1)->get(); 
        return view('rrff.users.crear_usuario', compact('roles', 'talleres'));
    }

    // 3. GUARDAR
    public function store(Request $request)
    {
        // Chequeo de acción específica: Crear/Editar
        if (!auth()->user()->hasPermission('user_create_edit')) {
            abort(403, 'ACCESO DENEGADO: No tienes permiso para crear usuarios.');
        }

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'document_number' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'ticket_assignment_id' => 'nullable|exists:ticket_assignments,id',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'document_number' => $request->document_number,
            'document_type_id' => 1,
            'status' => 1,
            'ticket_assignment_id' => $request->ticket_assignment_id,
        ]);

        $user->roles()->attach($request->role_id);

        return redirect()->route('rrff.users.index')->with('success', 'Usuario creado.');
    }

    // 4. EDITAR (Formulario)
    public function edit($id)
    {
        // Chequeo de acción específica: Crear/Editar
        if (!auth()->user()->hasPermission('user_create_edit')) {
            abort(403, 'ACCESO DENEGADO: No tienes permiso para editar usuarios.');
        }
        
        $user = User::findOrFail($id);
        $roles = Role::where('status', 1)->get();
        $talleres = TicketAssignment::where('is_internal', 1)->get();
        $permissions = Permission::all()->groupBy('menu');

        return view('rrff.users.editar_usuario', compact('user', 'roles', 'talleres', 'permissions'));
    }

    // 5. ACTUALIZAR
    public function update(Request $request, $id)
    {
        // Chequeo de acción específica: Crear/Editar
        if (!auth()->user()->hasPermission('user_create_edit')) {
            abort(403, 'ACCESO DENEGADO: No tienes permiso para editar usuarios.');
        }
        
        $user = User::findOrFail($id);
        
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'document_number' => 'required|string|max:20',
            'role_id' => 'required|exists:roles,id',
            'ticket_assignment_id' => 'nullable|exists:ticket_assignments,id',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'document_number' => $request->document_number,
            'ticket_assignment_id' => $request->ticket_assignment_id,
            'status' => $request->status,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->roles()->sync([$request->role_id]);
        $user->permissions()->sync($request->input('direct_permissions', []));

        return redirect()->route('rrff.users.index')->with('success', 'Usuario actualizado.');
    }
    
    // 6. ELIMINAR (Imagen fda6e1.png)
    public function destroy($id)
    {
        // Chequeo de acción específica: Eliminar
        if (!auth()->user()->hasPermission('user_delete')) {
            abort(403, 'ACCESO DENEGADO: No tienes permiso para eliminar usuarios.');
        }

        if (auth()->user()->id == $id) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }
        $user = User::findOrFail($id);
        $user->roles()->detach(); 
        $user->delete();
        return redirect()->route('rrff.users.index')->with('success', 'Usuario eliminado.');
    }
}