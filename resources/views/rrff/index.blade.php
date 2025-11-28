
<x-app-layout>
    <nav class="bg-white border-b border-gray-200 px-4 py-2.5 shadow-sm">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <span class="self-center text-xl font-semibold whitespace-nowrap text-blue-700">
                HPEP - Recursos Físicos
            </span>
            <div class="flex items-center lg:order-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 mr-2">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto mt-10 px-4">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Bandeja de Entrada de Solicitudes</h1>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">N° Ticket</th>
                        <th scope="col" class="px-6 py-3">Fecha</th>
                        <th scope="col" class="px-6 py-3">Solicitante / Unidad</th>
                        <th scope="col" class="px-6 py-3">Problema</th>
                        <th scope="col" class="px-6 py-3">Prioridad</th>
                        <th scope="col" class="px-6 py-3">Estado</th>
                        <th scope="col" class="px-6 py-3">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-bold text-gray-900">
                                {{ $ticket->ticket_number }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticket->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold">{{ $ticket->unit_service }}</div>
                                <div class="text-xs">{{ $ticket->applicant_name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                    {{ $ticket->problemType->name }}
                                </span>
                                <div class="text-xs mt-1 truncate w-48">{{Str::limit($ticket->description, 50)}}</div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $colors = [
                                        1 => 'bg-red-100 text-red-800',    // Crítica
                                        2 => 'bg-orange-100 text-orange-800', // Alta
                                        3 => 'bg-yellow-100 text-yellow-800', // Media
                                        4 => 'bg-green-100 text-green-800',   // Baja
                                    ];
                                    $colorClass = $colors[$ticket->initial_priority_id] ?? 'bg-gray-100';
                                @endphp
                                <span class="{{ $colorClass }} text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ $ticket->initialPriority->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-500">
                                    {{ $ticket->status->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('rrff.tickets.edit', $ticket->id) }}" class="font-medium text-blue-600 hover:underline">
                                    Gestionar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No hay solicitudes pendientes.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="p-4">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

