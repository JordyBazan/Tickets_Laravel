<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketPriority;
use App\Models\TicketAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketAssignedNotification;

class RRFFAssignmentController extends Controller
{
    /**
     * Muestra el listado de todos los tickets
     */
    public function index()
    {
        $tickets = Ticket::with(['problemType', 'status', 'initialPriority'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('rrff.index', compact('tickets'));
    }

    /**
     * Muestra el formulario para editar/asignar un ticket
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        
        $priorities = TicketPriority::all();
        $assignmentTypes = TicketAssignment::all();
        
        // Traemos usuarios activos (podrías filtrar por rol 'Técnico' si quisieras ser más específico)
        $technicians = User::where('status', 1)->get(); 

        return view('rrff.edit', compact('ticket', 'priorities', 'assignmentTypes', 'technicians'));
    }

    /**
     * Actualiza el ticket y notifica al técnico
     */
    public function update(Request $request, $id)
    {
        // 1. Validaciones: ELIMINAMOS 'assigned_priority_id' de aquí
        $request->validate([
            'status_id' => 'required',
            'assignment_type_id' => 'required',
            'assigned_to_user_id' => 'nullable',
        ]);

        $ticket = Ticket::findOrFail($id);
        
        // 2. Limpiar técnico (Si es "Sin Asignar", enviamos NULL)
        $tecnicoId = $request->assigned_to_user_id;
        if (empty($tecnicoId)) {
            $tecnicoId = null;
        }

        // 3. Actualizar: ELIMINAMOS 'assigned_priority_id' de aquí también
        // Al no incluirla, el sistema simplemente no toca ese dato y deja el que ya estaba.
        $ticket->update([
            'status_id' => $request->status_id,
            'assignment_type_id' => $request->assignment_type_id,
            'assigned_to_user_id' => $tecnicoId,
        ]);

        return redirect()->route('rrff.tickets.index')
            ->with('success', 'Ticket actualizado correctamente.');
    }
}