<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. SEGURIDAD: Si es Técnico, lo mandamos a sus tareas, a menos que tenga el permiso 'dashboard_view'.
        if (auth()->user()->hasAnyRole(['Técnico']) && !auth()->user()->hasPermission('dashboard_view')) {
            return redirect()->route('technician.index');
        }

        // 2. CALCULAR TOTALES (Lógica de KPI, Estados, Prioridades, etc. se mantiene) ...
        $totalTickets = Ticket::count();
        $ticketsAbiertos = Ticket::whereIn('status_id', [1, 2, 6])->count();
        $ticketsCerradosMes = Ticket::where('status_id', 3) 
            ->whereMonth('closed_at', Carbon::now()->month)
            ->count();

        // 3. DATOS PARA GRÁFICO (ESTADO)
        $conteoEstados = Ticket::select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->pluck('total', 'status_id')->toArray();
        $ticketsPorEstado = [
            'Abierto'    => $conteoEstados[1] ?? 0,
            'En Proceso' => $conteoEstados[2] ?? 0,
            'Cerrado'    => $conteoEstados[3] ?? 0
        ];

        // 4. DATOS PARA GRÁFICO (PRIORIDAD)
        $conteoPrioridad = Ticket::select('initial_priority_id', DB::raw('count(*) as total'))
            ->groupBy('initial_priority_id')
            ->pluck('total', 'initial_priority_id')->toArray();
        $ticketsPorPrioridad = [
            'Baja'    => $conteoPrioridad[4] ?? 0,
            'Media'   => $conteoPrioridad[3] ?? 0,
            'Alta'    => $conteoPrioridad[2] ?? 0,
            'Urgente' => $conteoPrioridad[1] ?? 0,
        ];
        
        // 5. DATOS PARA GRÁFICO (HORAS TRABAJADAS POR TALLER)
        $horasPorTallerData = Ticket::select('assignment_type_id', DB::raw('SUM(time_spent_hours) as total_hours'))
            ->whereNotNull('assignment_type_id')
            ->where('time_spent_hours', '>', 0) 
            ->groupBy('assignment_type_id')
            ->with('assignment')
            ->get();

        // 🚨 CONVERTIMOS A ARRAY AQUÍ 🚨
        $tallerLabels = $horasPorTallerData->pluck('assignment.name')->toArray();
        $tallerHours = $horasPorTallerData->pluck('total_hours')->toArray();
        
        // 6. DATOS PARA EL TOP 5 DE PROBLEMAS
        $problemasData = Ticket::select('problem_type_id', DB::raw('count(*) as total'))
            ->groupBy('problem_type_id')
            ->orderByDesc('total')
            ->limit(5)
            ->with('problemType')
            ->get();

        // 🚨 CONVERTIMOS A ARRAY AQUÍ 🚨
        $topProblemasLabels = $problemasData->pluck('problemType.name')->toArray();
        $topProblemasData = $problemasData->pluck('total')->toArray();

        // 7. LÍNEA DE TIEMPO (Últimos 15 días)
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(14);
        $timelineData = Ticket::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->whereDate('created_at', '>=', $startDate)
            ->groupBy('date')
            ->pluck('total', 'date');
        $chartDataFechaLabels = [];
        $chartDataFechaValues = [];
        
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $fechaStr = $date->format('Y-m-d');
            $chartDataFechaLabels[] = $date->format('d/m');
            $chartDataFechaValues[] = $timelineData[$fechaStr] ?? 0;
        }

        // 🚨 CONVERTIMOS A ARRAY AQUÍ (timeline data) 🚨
        $chartDataFechaLabels = array_values($chartDataFechaLabels);
        $chartDataFechaValues = array_values($chartDataFechaValues);


        // 8. TABLA: Los 5 tickets más recientes
        $ultimosTickets = Ticket::with(['problemType', 'status'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalTickets', 'ticketsAbiertos', 'ticketsCerradosMes',
            'ticketsPorEstado', 'ticketsPorPrioridad',
            'topProblemasLabels', 'topProblemasData',
            'chartDataFechaLabels', 'chartDataFechaValues',
            'ultimosTickets',
            'tallerLabels', 'tallerHours'
        ));
    }
}