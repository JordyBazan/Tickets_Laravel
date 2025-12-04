<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    👷 Mis Tareas Asignadas
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Gestiona y reporta el avance de tus órdenes de trabajo pendientes.
                </p>
            </div>
            
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                Total Pendientes: {{ $tickets->count() }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($tickets as $ticket)
                @php
                    // Lógica de Colores según Prioridad
                    $priorityColors = [
                        1 => 'bg-red-50 text-red-700 border-red-200 ring-red-600/20',      // Crítica
                        2 => 'bg-orange-50 text-orange-700 border-orange-200 ring-orange-600/20', // Alta
                        3 => 'bg-yellow-50 text-yellow-700 border-yellow-200 ring-yellow-600/20', // Media
                        4 => 'bg-green-50 text-green-700 border-green-200 ring-green-600/20',    // Baja
                    ];
                    $badgeClass = $priorityColors[$ticket->initial_priority_id] ?? 'bg-gray-50 text-gray-700 border-gray-200';
                    
                    // Estado visual
                    $isNew = $ticket->status_id == 1; 
                @endphp

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-300 flex flex-col h-full group relative overflow-hidden">
                    
                    @if($isNew)
                        <div class="absolute top-0 right-0">
                            <span class="inline-flex items-center gap-1 rounded-bl-lg bg-blue-600 px-3 py-1 text-xs font-bold text-white shadow-sm">
                                Nuevo
                            </span>
                        </div>
                    @endif

                    <div class="p-6 flex-1">
                        <div class="flex justify-between items-start mb-4">
                            <span class="font-mono text-xs font-bold text-gray-400 uppercase tracking-wider">
                                {{ $ticket->ticket_number }}
                            </span>
                            
                            @if(!$isNew)
                                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $badgeClass }}">
                                    {{ $ticket->initialPriority->name }}
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-1" title="{{ $ticket->unit_service }}">
                                {{ $ticket->unit_service }}
                            </h3>
                            <div class="flex items-center text-xs text-gray-500 mt-1">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $ticket->problemType->name }}
                            </div>
                        </div>

                        <p class="text-sm text-gray-600 line-clamp-3 mb-4 leading-relaxed">
                            {{ $ticket->description }}
                        </p>

                        <div class="flex items-center justify-between text-xs text-gray-400 border-t border-gray-100 pt-3 mt-auto">
                            <div class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $ticket->created_at->diffForHumans() }}
                            </div>
                            <div class="flex items-center" title="Solicitante">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ Str::words($ticket->applicant_name, 2, '') }}
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('technician.edit', $ticket->id) }}" class="block w-full bg-gray-50 hover:bg-blue-600 hover:text-white border-t border-gray-200 text-center py-3 text-sm font-bold text-gray-700 transition-all duration-200 flex justify-center items-center gap-2 group-hover:border-blue-600">
                        @if($ticket->status_id == 2)
                            <span>Continuar Trabajando</span> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        @else
                            <span>Iniciar Trabajo</span> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        @endif
                    </a>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-16 px-4 text-center bg-white rounded-xl border-2 border-dashed border-gray-200">
                    <div class="bg-blue-50 p-4 rounded-full mb-4">
                        <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">¡Todo al día!</h3>
                    <p class="text-gray-500 mt-1 max-w-sm">No tienes órdenes de trabajo pendientes por ahora. Disfruta tu café ☕.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>