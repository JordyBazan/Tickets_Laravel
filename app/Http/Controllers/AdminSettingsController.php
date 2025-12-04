<?php

namespace App\Http\Controllers;

use App\Models\TicketProblemType;
use App\Models\TicketPriority;
use App\Models\TicketAssignment;
use App\Models\Supply; // <--- 1. IMPORTANTE: Que esta línea esté aquí
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    /**
     * Muestra la lista de configuraciones
     */
    public function index()
    {
        // Cargar listas
        $problemTypes = TicketProblemType::all();
        $priorities = TicketPriority::orderBy('level', 'asc')->get();
        $assignments = TicketAssignment::all();
        
        // 2. Cargar Insumos (Variable $supplies)
        $supplies = Supply::orderBy('name')->get(); 

        // 3. Enviar TODO a la vista
        return view('rrff.settings.configuracion', compact(
            'problemTypes', 
            'priorities', 
            'assignments', 
            'supplies' // <--- TIENE QUE ESTAR AQUÍ
        ));
    }

    // --- FUNCIONES DE GUARDADO ---

    public function storeProblemType(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100|unique:ticket_problem_types,name']);
        TicketProblemType::create(['name' => $request->name]);
        return back()->with('success', 'Tipo agregado.');
    }

    public function destroyProblemType($id)
    {
        TicketProblemType::findOrFail($id)->delete();
        return back()->with('success', 'Tipo eliminado.');
    }

    public function storeAssignment(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);
        TicketAssignment::create(['name' => $request->name, 'is_internal' => 1]);
        return back()->with('success', 'Taller agregado.');
    }

    public function destroyAssignment($id)
    {
        try {
            TicketAssignment::findOrFail($id)->delete();
            return back()->with('success', 'Taller eliminado.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se puede borrar este taller.');
        }
    }

    // --- FUNCIONES DE INSUMOS ---

    public function storeSupply(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        Supply::create($request->all());
        return back()->with('success', 'Insumo agregado.');
    }

    public function destroySupply($id)
    {
        Supply::findOrFail($id)->delete();
        return back()->with('success', 'Insumo eliminado.');
    }
}