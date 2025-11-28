<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketProblemType;
use App\Models\TicketPriority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Usamos DB para acceder a la tabla sidra directamente

class PublicTicketController extends Controller
{
    /**
     * Muestra el formulario de solicitud (Paso 1 del requerimiento).
     */
    public function create()
    {
        // 1. Obtener catálogos para los menús desplegables
        $problemTypes = TicketProblemType::all();
        $priorities = TicketPriority::all();
        
        // 2. Obtener las Unidades/Servicios desde tu tabla 'sidra' antigua
        // Usamos 'distinct' por si hay servicios repetidos en esa tabla
        $services = DB::table('sidra')->select('servicio')->distinct()->orderBy('servicio')->get();

        return view('public.create', compact('problemTypes', 'priorities', 'services'));
    }

    /**
     * Guarda el ticket en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación estricta
        $request->validate([
            'unit_service' => 'required|string',
            'applicant_name' => 'required|string|max:150',
            'applicant_email' => 'required|email',
            'applicant_rut' => 'required|string|max:12',
            'applicant_annex' => 'required|string|max:20',
            'problem_type_id' => 'required|exists:ticket_problem_types,id',
            'initial_priority_id' => 'required|exists:ticket_priorities,id',
            'description' => 'required|string|min:10',
            'photo' => 'nullable|image|max:5120', // Máximo 5MB, solo imágenes
        ]);

        // 2. Crear el Ticket
        // Nota: Laravel llenará status_id, ticket_number y secure_token automáticamente gracias al Modelo.
        $ticket = Ticket::create($request->except('photo'));

        // 3. Manejo de la Foto (Si el usuario subió una)
        if ($request->hasFile('photo')) {
            // Guardar archivo en 'storage/app/public/tickets'
            $path = $request->file('photo')->store('tickets', 'public');

            // Guardar registro en la tabla 'images' usando la relación polimórfica
            $ticket->images()->create([
                'url' => $path
            ]);
        }

        // 4. Redirigir con mensaje de éxito
        return redirect()->route('public.ticket.create')
            ->with('success', 'Solicitud creada con éxito. Su número de ticket es: ' . $ticket->ticket_number);
    }
}