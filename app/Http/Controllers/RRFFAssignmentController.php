<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketPriority;
use App\Models\TicketAssignment;
use Illuminate\Http\Request;

class RRFFAssignmentController extends Controller
{
    /**
     * Muestra el listado de todos los tickets (Punto 2 y 8 del requerimiento)
     */
    public function index()
    {
        // Traemos los tickets ordenados por los más recientes.
        // Usamos 'with' para cargar las relaciones y evitar consultas lentas.
        $tickets = Ticket::with(['problemType', 'status', 'initialPriority'])
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Paginación de 10 en 10

        return view('rrff.index', compact('tickets'));
    }

    /**
     * Muestra el formulario para editar/asignar un ticket (Punto 2 y 4)
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        
        // Necesitamos listas para los selectores
        $priorities = TicketPriority::all();
        $assignmentTypes = TicketAssignment::all();
        
        // Traemos solo usuarios que sean técnicos o personal de mantenimiento
        // (Por ahora traemos todos, luego puedes filtrar por rol)
        $technicians = User::where('status', 1)->get(); 

        return view('rrff.edit', compact('ticket', 'priorities', 'assignmentTypes', 'technicians'));
    }
}