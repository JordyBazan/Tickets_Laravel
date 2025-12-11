<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketPriority;
use App\Models\TicketAssignment;
use App\Models\TicketStatus; // <--- 1. IMPORTANTE: Agregar este modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketAssignedNotification;

class RRFFAssignmentController extends Controller
{
    public function index(Request $request)
    {
        // 1. Obtener datos para los selectores
        $statuses = TicketStatus::all();
        $priorities = TicketPriority::all();

        // 2. Iniciar consulta
        $query = Ticket::with(['problemType', 'status', 'technician']);

        // --- FILTROS ---

        // Filtro: Fecha Exacta (Solo un día específico)
        if ($request->filled('date')) {
            // whereDate compara solo YYYY-MM-DD, ignorando la hora (H:i:s)
            $query->whereDate('created_at', $request->date);
        }

        // Filtro: Estado
        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        // Filtro: Prioridad
        if ($request->filled('priority_id')) {
            $query->where('priority_id', $request->priority_id);
        }

        // Búsqueda por texto
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('id', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }
        // ---------------

        $tickets = $query
            ->orderBy('id', 'desc')
            ->paginate(10); 

        return view('rrff.index', compact('tickets', 'statuses', 'priorities'));
    }
    // ... (El resto de métodos edit y update siguen igual) ...
    public function edit($id)
    {
        // ...
        $ticket = Ticket::findOrFail($id);
        $priorities = TicketPriority::all();
        $assignmentTypes = TicketAssignment::all();
        $technicians = User::where('status', 1)->get(); 

        return view('rrff.edit', compact('ticket', 'priorities', 'assignmentTypes', 'technicians'));
    }

    public function update(Request $request, $id)
    {
        // ... (Mismo código que te pasé antes) ...
        $request->validate([
            'status_id' => 'required',
            'assignment_type_id' => 'required',
            'assigned_to_user_id' => 'nullable',
        ]);

        $ticket = Ticket::findOrFail($id);
        $oldTechnicianId = $ticket->assigned_to_user_id; // Guardar anterior

        $tecnicoId = $request->assigned_to_user_id;
        if (empty($tecnicoId)) {
            $tecnicoId = null;
        }

        $ticket->update([
            'status_id' => $request->status_id,
            'assignment_type_id' => $request->assignment_type_id,
            'assigned_to_user_id' => $tecnicoId,
        ]);

        // Notificación
        if ($tecnicoId && $tecnicoId != $oldTechnicianId) {
            $technician = User::find($tecnicoId);
            if ($technician && $technician->email) {
                try {
                    Mail::to($technician->email)->send(new TicketAssignedNotification($ticket));
                } catch (\Exception $e) {
                    // Log error
                }
            }
        }

        return redirect()->route('rrff.tickets.index')
            ->with('success', 'Ticket actualizado correctamente.');
    }
}