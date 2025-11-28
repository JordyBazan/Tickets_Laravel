<?php

namespace App\Http\Controllers;

use App\Models\TicketProblemType;
use App\Models\TicketPriority;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    /**
     * Muestra la lista de Tipos y Prioridades
     */
    public function index()
    {
        $problemTypes = TicketProblemType::all();
        $priorities = TicketPriority::orderBy('level', 'asc')->get();
        
        // AGREGAR ESTA LÍNEA:
        $assignments = \App\Models\TicketAssignment::all(); 

        return view('rrff.settings.configuracion', compact('problemTypes', 'priorities', 'assignments'));
    }

    /**
     * Guarda un nuevo Tipo de Problema
     */
    public function storeProblemType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:ticket_problem_types,name'
        ]);

        TicketProblemType::create([
            'name' => $request->name
        ]);

        return redirect()->route('rrff.settings.index')->with('success', 'Nuevo tipo de problema agregado.');
    }

    /**
     * Elimina un Tipo de Problema
     */
    public function destroyProblemType($id)
    {
        $type = TicketProblemType::findOrFail($id);
        $type->delete();

        return redirect()->route('rrff.settings.index')->with('success', 'Tipo de problema eliminado.');
    }

    /**
     * Guardar nuevo Taller/Asignación
     */
    public function storeAssignment(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);
        
        \App\Models\TicketAssignment::create([
            'name' => $request->name,
            'is_internal' => 1 // Por defecto lo creamos como interno
        ]);

        return redirect()->route('rrff.settings.index')->with('success', 'Taller agregado correctamente.');
    }

    /**
     * Eliminar Taller
     */
    public function destroyAssignment($id)
    {
        try {
            $assignment = \App\Models\TicketAssignment::findOrFail($id);
            $assignment->delete();
            return redirect()->route('rrff.settings.index')->with('success', 'Taller eliminado.');
        } catch (\Exception $e) {
            return redirect()->route('rrff.settings.index')->with('error', 'No se puede eliminar: Hay tickets asignados a este taller.');
        }
    }
}