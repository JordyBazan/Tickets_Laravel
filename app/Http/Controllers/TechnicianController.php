<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supply;
class TechnicianController extends Controller
{
    // 1. Ver MIS tareas (Solo las asignadas a mí y que NO estén cerradas)
    public function index()
    {
        $user = Auth::user();
        
        $tickets = Ticket::where('status_id', '!=', 3) // Excluir cerrados
            ->where(function($query) use ($user) {
                // Condición 1: Asignado a mí personalmente
                $query->where('assigned_to_user_id', $user->id);
                
                // Condición 2: Asignado a mi Taller (si tengo uno)
                if ($user->ticket_assignment_id) {
                    $query->orWhere('assignment_type_id', $user->ticket_assignment_id);
                }
            })
            ->orderBy('initial_priority_id', 'asc') // Prioridad alta primero
            ->get();

        return view('rrff.technician.mis_tickets', compact('tickets'));
    }
    // 2. Ver la pantalla de ejecución (Bitácora)
    public function edit($id)
    {
        $ticket = Ticket::with(['materials', 'problemType'])->findOrFail($id);

        // Seguridad: ¿Es mi ticket?
        if ($ticket->assigned_to_user_id != Auth::id()) {
            // Validación extra por si es del taller
            $user = Auth::user();
            if (!$user->ticket_assignment_id || $ticket->assignment_type_id != $user->ticket_assignment_id) {
                 return redirect()->route('technician.index')->with('error', 'No tienes permiso.');
            }
        }

        // Cambio de estado automático a "En Proceso"
        if ($ticket->status_id == 1) {
            $ticket->status_id = 2;
            $ticket->save();
        }

        // 👇 ESTO ES LO QUE TE FALTA 👇
        // Cargar la lista de insumos para el select
        $supplies = Supply::orderBy('name')->get(); 

        // Agregamos 'supplies' al compact
        return view('rrff.technician.ejecutar', compact('ticket', 'supplies'));
    }

    // 3. Guardar Avance (Horas y Materiales)
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        // 1. REGISTRAR MATERIALES (Lista)
        if ($request->has('materials') && is_array($request->materials)) {
            foreach ($request->materials as $item) {
                if (!empty($item['name']) && !empty($item['quantity'])) {
                    \App\Models\TicketMaterial::create([
                        'ticket_id' => $ticket->id,
                        'user_id' => Auth::id(),
                        'material_name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'unit' => $item['unit'] ?? 'un'
                    ]);
                }
            }
        }

        // 2. REGISTRAR HORAS
        if ($request->filled('hours_today')) {
            $ticket->time_spent_hours += $request->hours_today;
        }

        // 3. REGISTRAR BITÁCORA (El historial) --- CORREGIDO
        if ($request->filled('new_observation')) {
            // Formato: [02/12 14:30] Juan: Se cambió el cable.
            $fecha = now()->format('d/m H:i');
            $usuario = Auth::user()->first_name;
            $textoNuevo = "[{$fecha}] {$usuario}: " . $request->new_observation;
            
            // Si ya había texto antes, agregamos un salto de línea (\n)
            if ($ticket->execution_details) {
                $ticket->execution_details = $ticket->execution_details . "\n" . $textoNuevo;
            } else {
                $ticket->execution_details = $textoNuevo;
            }
        }

        // 4. ESTADO
        if ($request->has('job_done')) {
            $ticket->status_id = 3; // Cerrado (o 6 si usas 'Por Confirmar')
            $msg = '¡Trabajo terminado!';
        } else {
            $ticket->status_id = 2; // En Proceso
            $msg = 'Avance guardado.';
        }

        // Guardamos todo el objeto Ticket
        $ticket->save();

        return redirect()->back()->with('success', $msg);
    }
}