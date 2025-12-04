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
        if (auth()->user()->hasAnyRole(['Técnico'])) {
            return redirect()->route('technician.index');
        }

        // 1. KPIS
        $totalTickets = Ticket::count();
        $ticketsAbiertos = Ticket::whereIn('status_id', [1, 2])->count(); // 1=Abierto, 2=En Proceso
        $ticketsCerradosMes = Ticket::where('status_id', 3)->whereMonth('updated_at', Carbon::now()->month)->count();

        // 2. DATOS PARA GRÁFICO DE ESTADO (Fixed)
        // Forzamos el orden: [Abierto, En Proceso, Cerrado]
        $conteoEstados = Ticket::select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->pluck('total', 'status_id')->toArray();

        $ticketsPorEstado = [
            'Abierto'    => $conteoEstados[1] ?? 0, // ID 1
            'En Proceso' => $conteoEstados[2] ?? 0, // ID 2
            'Cerrado'    => $conteoEstados[3] ?? 0  // ID 3
        ];

        // 3. DATOS PARA GRÁFICO PRIORIDAD
        // Forzamos el orden lógico: [Baja, Media, Alta, Urgente]
        $conteoPrioridad = Ticket::select('initial_priority_id', DB::raw('count(*) as total'))
            ->groupBy('initial_priority_id')
            ->pluck('total', 'initial_priority_id')->toArray();

        $ticketsPorPrioridad = [
            'Baja'    => $conteoPrioridad[4] ?? 0,
            'Media'   => $conteoPrioridad[3] ?? 0,
            'Alta'    => $conteoPrioridad[2] ?? 0,
            'Urgente' => $conteoPrioridad[1] ?? 0,
        ];

        // 4. TOP PROBLEMAS (Igual que antes)
        $problemasData = Ticket::select('problem_type_id', DB::raw('count(*) as total'))
            ->groupBy('problem_type_id')
            ->orderByDesc('total')
            ->limit(5)
            ->with('problemType')
            ->get();
        $topProblemasLabels = $problemasData->pluck('problemType.name');
        $topProblemasData = $problemasData->pluck('total');

        // 5. LÍNEA DE TIEMPO
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(14); // Últimos 15 días se ve mejor
        
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

        // 6. ULTIMOS TICKETS
        $ultimosTickets = Ticket::with(['problemType', 'status'])->orderByDesc('created_at')->limit(5)->get();

        return view('dashboard', compact(
            'totalTickets', 'ticketsAbiertos', 'ticketsCerradosMes',
            'ticketsPorEstado', 'ticketsPorPrioridad',
            'topProblemasLabels', 'topProblemasData',
            'chartDataFechaLabels', 'chartDataFechaValues',
            'ultimosTickets'
        ));
    }
}