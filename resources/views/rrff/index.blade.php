<x-app-layout>
    
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Bandeja de Solicitudes
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Gestiona, prioriza y asigna los tickets recibidos.
                </p>
            </div>
            
            <div class="flex gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                    Total: {{ $tickets->total() }}
                </span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">Ticket / Fecha</th>
                            <th scope="col" class="px-6 py-3 font-medium">Solicitante</th>
                            <th scope="col" class="px-6 py-3 font-medium">Detalle del Problema</th>
                            <th scope="col" class="px-6 py-3 font-medium text-center">Prioridad</th>
                            <th scope="col" class="px-6 py-3 font-medium text-center">Estado</th>
                            <th scope="col" class="px-6 py-3 font-medium text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($tickets as $ticket)
                            <tr class="bg-white hover:bg-gray-50 transition-colors duration-150 group">
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-900 font-mono">{{ $ticket->ticket_number }}</span>
                                        <span class="text-xs text-gray-500 flex items-center mt-1">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $ticket->created_at->format('d/m H:i') }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xs mr-3 flex-shrink-0">
                                            {{ substr($ticket->applicant_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $ticket->unit_service }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($ticket->applicant_name, 20) }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 mb-1">
                                        {{ $ticket->problemType->name }}
                                    </span>
                                    <p class="text-gray-600 text-xs mt-1 line-clamp-2 max-w-xs" title="{{ $ticket->description }}">
                                        {{ $ticket->description }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @php
                                        $pColors = [
                                            1 => 'bg-red-100 text-red-700 border-red-200',
                                            2 => 'bg-orange-100 text-orange-700 border-orange-200',
                                            3 => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                            4 => 'bg-green-100 text-green-700 border-green-200',
                                        ];
                                        $pClass = $pColors[$ticket->initial_priority_id] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $pClass }}">
                                        {{ $ticket->initialPriority->name }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @php
                                        $sColors = [
                                            1 => 'bg-blue-50 text-blue-700 ring-blue-600/20', // Abierto
                                            2 => 'bg-purple-50 text-purple-700 ring-purple-600/20', // En Proceso
                                            3 => 'bg-green-50 text-green-700 ring-green-600/20', // Cerrado
                                            6 => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20', // Por Confirmar
                                        ];
                                        $sClass = $sColors[$ticket->status_id] ?? 'bg-gray-50 text-gray-600 ring-gray-500/10';
                                    @endphp
                                    <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $sClass }}">
                                        {{ $ticket->status->name }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('rrff.tickets.edit', $ticket->id) }}" class="text-blue-600 hover:text-blue-900 font-medium text-sm flex items-center justify-end group-hover:underline">
                                        Gestionar <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500 bg-gray-50">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span class="block text-lg font-medium text-gray-900">Sin solicitudes pendientes</span>
                                    <span class="block text-sm text-gray-500">¡Todo está tranquilo por ahora!</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>

</x-app-layout>