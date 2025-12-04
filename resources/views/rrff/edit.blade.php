<x-app-layout>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestionar Solicitud</h1>
                    <span class="px-3 py-1 text-sm font-bold text-blue-700 bg-blue-100 rounded-full border border-blue-200 shadow-sm">
                        {{ $ticket->ticket_number }}
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500">Revisión y asignación de recursos.</p>
            </div>
            <a href="{{ route('rrff.tickets.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al listado
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start border-b border-gray-100 pb-5 mb-5">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    {{ $ticket->unit_service }}
                                </h2>
                                <span class="text-sm text-gray-500 mt-1 block">Fecha de creación: {{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                {{ $ticket->problemType->name }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="flex items-start p-3 bg-gray-50 rounded-lg border border-gray-100">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                        {{ substr($ticket->applicant_name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Solicitante</p>
                                    <p class="text-sm font-bold text-gray-900">{{ $ticket->applicant_name }}</p>
                                    <p class="text-xs text-gray-500 font-mono">{{ $ticket->applicant_rut }}</p>
                                </div>
                            </div>

                            <div class="flex items-start p-3 bg-gray-50 rounded-lg border border-gray-100">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Contacto</p>
                                    <p class="text-sm text-gray-900">{{ $ticket->applicant_email }}</p>
                                    <p class="text-sm text-gray-600 font-bold">Anexo: {{ $ticket->applicant_annex }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 block">Descripción del Problema</span>
                            <div class="p-4 bg-yellow-50 rounded-xl border border-yellow-100 text-gray-800 leading-relaxed text-sm shadow-sm">
                                {{ $ticket->description }}
                            </div>
                        </div>

                        @if($ticket->images->count() > 0)
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 block">Evidencia Fotográfica</span>
                                <div class="relative group w-fit">
                                    <a href="{{ asset('storage/' . $ticket->images->first()->url) }}" target="_blank" class="block overflow-hidden rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all">
                                        <img src="{{ asset('storage/' . $ticket->images->first()->url) }}" alt="Evidencia" class="h-48 object-cover transform transition duration-500 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                
                @if ($errors->any())
                    <div class="mb-4 p-4 text-red-700 bg-red-50 rounded-xl border border-red-100 shadow-sm">
                        <div class="font-bold text-sm mb-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Atención:
                        </div>
                        <ul class="list-disc list-inside text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('rrff.tickets.update', $ticket->id) }}" method="POST" class="bg-white rounded-xl shadow-lg border border-gray-200 sticky top-6 overflow-hidden">
                    @csrf
                    @method('PUT')
                    
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            Control y Asignación
                        </h3>
                    </div>

                    <div class="p-6 space-y-6">
                        
                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700">Estado Actual</label>
                            <div class="relative">
                                <select name="status_id" class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 pr-8 cursor-pointer">
                                    <option value="1" {{ $ticket->status_id == 1 ? 'selected' : '' }}>🔵 Abierto</option>
                                    <option value="2" {{ $ticket->status_id == 2 ? 'selected' : '' }}>🟣 En proceso</option>
                                    <option value="3" {{ $ticket->status_id == 3 ? 'selected' : '' }}>🟢 Cerrado</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700">Prioridad Asignada</label>
                            <div class="flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <span class="font-medium text-gray-800">{{ $ticket->initialPriority->name }}</span>
                                <span class="bg-gray-200 text-gray-600 text-xs font-bold px-2 py-1 rounded">
                                    Nivel {{ $ticket->initialPriority->level }}
                                </span>
                            </div>
                            <input type="hidden" name="assigned_priority_id" value="{{ $ticket->initial_priority_id }}">
                        </div>

                        <hr class="border-gray-100">

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700">Derivar a (Taller)</label>
                            <select name="assignment_type_id" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 shadow-sm" required>
                                <option value="">Seleccione...</option>
                                @foreach($assignmentTypes as $type)
                                    <option value="{{ $type->id }}" {{ $ticket->assignment_type_id == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700">Asignar Técnico Específico</label>
                            <select name="assigned_to_user_id" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 shadow-sm">
                                <option value="">-- Sin Asignar (Verán todos los del taller) --</option>
                                @foreach($technicians as $tech)
                                    <option value="{{ $tech->id }}" {{ $ticket->assigned_to_user_id == $tech->id ? 'selected' : '' }}>
                                        {{ $tech->first_name }} {{ $tech->last_name }}
                                        @if($tech->taller)
                                            ({{ Str::limit($tech->taller->name, 10) }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Opcional. Si lo dejas vacío, cualquier técnico del taller seleccionado podrá tomarlo.</p>
                        </div>

                        <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-bold rounded-lg text-sm px-5 py-3.5 focus:outline-none transition-all shadow-md hover:shadow-lg flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>