<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMaterial;
use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{
    // 1. Ver MIS tareas
    public function index()
    {
        $user = Auth::user();
        
        $tickets = Ticket::where('status_id', '!=', 3) 
            ->where(function($query) use ($user) {
                $query->where('assigned_to_user_id', $user->id);
                if ($user->ticket_assignment_id) {
                    $query->orWhere('assignment_type_id', $user->ticket_assignment_id);
                }
            })
            ->orderBy('initial_priority_id', 'asc')
            ->get();

        return view('rrff.technician.mis_tickets', compact('tickets'));
    }

    // 2. Ver la pantalla de ejecución
    public function edit($id)
    {
        $ticket = Ticket::with(['materials', 'problemType'])->findOrFail($id);

        $user = Auth::user();
        $esMio = $ticket->assigned_to_user_id == $user->id;
        $esDeMiTaller = $user->ticket_assignment_id && $ticket->assignment_type_id == $user->ticket_assignment_id;

        if (!$esMio && !$esDeMiTaller) {
             return redirect()->route('technician.index')->with('error', 'No tienes permiso.');
        }

        if ($ticket->status_id == 1) {
            $ticket->status_id = 2;
            $ticket->save();
        }

        $supplies = Supply::orderBy('name')->get(); 

        return view('rrff.technician.ejecutar', compact('ticket', 'supplies'));
    }

    // 3. Guardar Avance o Finalizar
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        // --- CORREGIDO 1: Guardar el texto principal (execution_details) ---
        // Antes no se guardaba porque faltaba esta línea.
        if ($request->has('execution_details')) {
            $ticket->execution_details = $request->execution_details;
        }

        // --- CORREGIDO 2: Guardar la nueva observación (Bitácora) ---
        // Se concatena al texto principal si existe
        if ($request->filled('new_observation')) {
            $fecha = now()->format('d/m H:i');
            $usuario = Auth::user()->first_name ?? Auth::user()->name;
            $textoNuevo = "\n[{$fecha}] {$usuario}: " . $request->new_observation;
            
            // Si ya tiene texto, agregamos el nuevo; si no, lo iniciamos
            $ticket->execution_details = ($ticket->execution_details ?? '') . $textoNuevo;
        }

        // --- CORREGIDO 3: Guardar Insumos (new_materials vs materials) ---
        // Tu vista envía 'new_materials', así que debemos buscar eso.
        if ($request->has('new_materials') && is_array($request->new_materials)) {
            foreach ($request->new_materials as $item) {
                // Solo guardamos si tiene nombre y cantidad
                if (!empty($item['name']) && !empty($item['quantity'])) {
                    TicketMaterial::create([
                        'ticket_id' => $ticket->id,
                        'user_id' => Auth::id(),
                        'material_name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'unit' => $item['unit'] ?? 'unid'
                    ]);
                }
            }
        }

        // 4. Registrar Horas
        if ($request->filled('hours_today') && $request->hours_today > 0) {
            $ticket->time_spent_hours = ($ticket->time_spent_hours ?? 0) + $request->hours_today;
        }

        // 5. Lógica de Botones
        if ($request->action === 'finish' || $request->has('job_done')) {
            $ticket->status_id = 3; // Cerrado
            $ticket->closed_at = now();
            $ticket->save();

            return redirect()->route('technician.index')
                ->with('success', 'Ticket terminado correctamente.');
        } else {
            // Guardar Avance
            $ticket->status_id = 2; 
            $ticket->save();
            
            return redirect()->back()
                ->with('success', 'Avance guardado (Insumos y detalles registrados).');
        }
    }
}