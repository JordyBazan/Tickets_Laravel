<x-app-layout>

    <div class="max-w-6xl mx-auto mt-6 px-4">
        
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Gestionar Ticket</h1>
            <a href="{{ route('rrff.tickets.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al listado
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <div class="flex justify-between items-start border-b border-gray-100 pb-4 mb-4">
                        <div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">#{{ $ticket->ticket_number }}</span>
                            <h2 class="text-xl font-bold text-gray-800 mt-2">{{ $ticket->unit_service }}</h2>
                        </div>
                        <span class="text-sm text-gray-500">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Solicitante</span>
                            <p class="text-gray-900 font-medium">{{ $ticket->applicant_name }}</p>
                            <p class="text-sm text-gray-600">{{ $ticket->applicant_rut }}</p>
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Contacto</span>
                            <p class="text-sm text-gray-600 flex items-center mt-1">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ $ticket->applicant_email }}
                            </p>
                            <p class="text-sm text-gray-600 flex items-center mt-1">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                Anexo: {{ $ticket->applicant_annex }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Problema Reportado</span>
                        <div class="mt-2 p-4 bg-gray-50 rounded-lg border border-gray-100 text-gray-800 leading-relaxed">
                            {{ $ticket->description }}
                        </div>
                    </div>

                    @if($ticket->images->count() > 0)
                        <div class="mb-4">
                            <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Evidencia Fotográfica</span>
                            <div class="mt-3">
                                <a href="{{ asset('storage/' . $ticket->images->first()->url) }}" target="_blank" class="block relative group overflow-hidden rounded-lg shadow-sm w-fit">
                                    <img src="{{ asset('storage/' . $ticket->images->first()->url) }}" alt="Foto del problema" class="h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-300 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


            <div class="lg:col-span-1">
                <form action="{{ route('rrff.tickets.update', $ticket->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow border-t-4 border-blue-600 sticky top-6">
                    @csrf
                    @method('PUT') <h3 class="text-lg font-bold text-gray-800 mb-6">Control y Asignación</h3>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-semibold text-gray-900">Estado Actual</label>
                        <select name="status_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="1" {{ $ticket->status_id == 1 ? 'selected' : '' }}>Abierto</option>
                            <option value="2" {{ $ticket->status_id == 2 ? 'selected' : '' }}>En proceso</option>
                            <option value="3" {{ $ticket->status_id == 3 ? 'selected' : '' }}>Cerrado</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-semibold text-gray-900">Asignar a:</label>
                        <select name="assignment_type_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="">Seleccione Taller/Externo...</option>
                            @foreach($assignmentTypes as $type)
                                <option value="{{ $type->id }}" {{ $ticket->assignment_type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-8">
                        <label class="block mb-2 text-sm font-semibold text-gray-900">Técnico Responsable</label>
                        <select name="assigned_to_user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">-- Sin Asignar --</option>
                            @foreach($technicians as $tech)
                                <option value="{{ $tech->id }}" {{ $ticket->assigned_to_user_id == $tech->id ? 'selected' : '' }}>
                                    {{ $tech->first_name }} {{ $tech->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 focus:outline-none transition-colors duration-200 flex justify-center items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Guardar Cambios
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>