<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center rounded-lg bg-blue-100 px-3 py-1 text-sm font-bold text-blue-800 ring-1 ring-inset ring-blue-700/10">
                    OT #{{ $ticket->ticket_number }}
                </span>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Ejecución de Trabajo</h1>
            </div>
            
            <a href="{{ route('technician.index') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver a Mis Tareas
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <div class="space-y-6">
                
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-yellow-400"></div>
                    
                    <div class="pl-3">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Solicitud Original</h3>
                        <p class="text-gray-900 font-medium text-lg mb-6 leading-relaxed">
                            "{{ $ticket->description }}"
                        </p>
                        
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 space-y-3">
                            <div class="flex items-center text-sm text-gray-700">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-500 font-bold uppercase">Ubicación</span>
                                    {{ $ticket->unit_service }}
                                </div>
                            </div>

                            <div class="flex items-center text-sm text-gray-700">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-500 font-bold uppercase">Solicitante</span>
                                    {{ $ticket->applicant_name }}
                                </div>
                            </div>

                            <div class="flex items-center text-sm text-gray-700">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3 flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-500 font-bold uppercase">Contacto</span>
                                    {{ $ticket->applicant_annex }} <span class="text-gray-400 mx-1">|</span> {{ $ticket->applicant_email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Evidencia Fotográfica
                    </h3>
                    
                    @if($ticket->images->count() > 0)
                        <div class="relative group rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                            <a href="{{ asset('storage/' . $ticket->images->first()->url) }}" target="_blank">
                                <img src="{{ asset('storage/' . $ticket->images->first()->url) }}" 
                                     alt="Foto del problema" 
                                     class="w-full h-64 object-cover transform transition-transform duration-500 group-hover:scale-105">
                                
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all flex items-center justify-center">
                                    <span class="text-white opacity-0 group-hover:opacity-100 font-bold text-sm bg-black/50 px-3 py-1 rounded-full backdrop-blur-sm">
                                        Clic para ampliar
                                    </span>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="h-48 bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center text-gray-400">
                            <svg class="w-10 h-10 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-medium">Sin evidencia adjunta</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-blue-100 relative overflow-hidden h-fit">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 blur-xl"></div>
                
                <div class="px-6 py-5 border-b border-gray-100 bg-white relative z-10">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center">
                        <span class="bg-blue-600 text-white p-1.5 rounded-lg mr-3 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </span>
                        Registrar Término de Trabajo
                    </h2>
                </div>

                <div class="p-6 relative z-10">
                    <form action="{{ route('technician.update', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6 bg-blue-50/50 p-4 rounded-xl border border-blue-100">
                            <div class="flex justify-between items-center mb-3">
                                <label class="text-sm font-bold text-blue-900 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    Insumos Utilizados
                                </label>
                                <button type="button" onclick="agregarFilaMaterial()" class="text-xs bg-white border border-blue-200 hover:bg-blue-50 text-blue-700 font-medium px-3 py-1.5 rounded-lg transition-all shadow-sm flex items-center group">
                                    <svg class="w-3 h-3 mr-1 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Agregar
                                </button>
                            </div>

                            <div id="lista-materiales" class="space-y-2">
                                <div class="grid grid-cols-12 gap-2 bg-white p-2 rounded-lg border border-blue-100 shadow-sm">
                                    <div class="col-span-7">
                                        <select name="materials[0][name]" class="w-full border-gray-200 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 py-1.5" onchange="actualizarUnidad(this)">
                                            <option value="">Seleccione insumo...</option>
                                            @foreach($supplies as $supply)
                                                <option value="{{ $supply->name }}" data-unit="{{ $supply->unit }}">{{ $supply->name }} ({{ $supply->unit }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-3">
                                        <input type="number" name="materials[0][quantity]" step="0.1" placeholder="Cant." class="w-full border-gray-200 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 text-center py-1.5">
                                    </div>
                                    <div class="col-span-2">
                                        <input type="text" name="materials[0][unit]" placeholder="Un." class="unidad-input w-full border-gray-200 rounded-md text-xs bg-gray-100 text-gray-500 text-center cursor-not-allowed py-1.5" readonly tabindex="-1">
                                    </div>
                                </div>
                            </div>
                            
                            @if($ticket->materials->count() > 0)
                                <div class="mt-4 pt-3 border-t border-blue-200/50">
                                    <p class="text-[10px] font-bold text-blue-400 mb-2 uppercase tracking-wide">Registrados anteriormente:</p>
                                    <ul class="text-xs text-blue-800 space-y-1 pl-1">
                                        @foreach($ticket->materials as $mat)
                                            <li class="flex items-center">
                                                <svg class="w-3 h-3 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                <span class="font-bold mr-1">{{ $mat->quantity }} {{ $mat->unit }}</span> {{ $mat->material_name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Horas trabajadas HOY</label>
                            <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-200">
                                <div class="relative">
                                    <input type="number" name="hours_today" step="0.5" class="w-24 border-gray-300 rounded-lg text-lg font-bold text-center focus:ring-blue-500 focus:border-blue-500 py-2" placeholder="0.0">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium">hrs</span>
                                </div>
                                <div class="text-sm text-gray-600 flex flex-col border-l border-gray-200 pl-4">
                                    <span class="text-xs text-gray-400 uppercase font-bold tracking-wider">Acumulado</span>
                                    <span class="text-lg font-bold text-gray-900">{{ $ticket->time_spent_hours }} <span class="text-xs font-normal text-gray-500">hrs totales</span></span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Observación Técnica Final</label>
                            <textarea name="new_observation" rows="3" class="w-full border-gray-300 rounded-xl text-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 placeholder-gray-400 py-3 px-4 transition-shadow focus:shadow-md" placeholder="Describe brevemente el trabajo realizado para finalizar..."></textarea>
                        </div>

                        <hr class="mb-6 border-gray-100">

                        <div class="space-y-4">
                            <input type="hidden" name="job_done" value="1">

                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-xl flex justify-center items-center gap-3 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Finalizar y Cerrar Ticket
                            </button>
                            
                            <p class="text-center text-xs text-gray-400 mt-2">
                                Al hacer clic, el ticket se marcará como terminado y se notificará.
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let contadorMateriales = 1;
        const opcionesInsumos = `
            <option value="">Seleccione...</option>
            @foreach($supplies as $supply)
                <option value="{{ $supply->name }}" data-unit="{{ $supply->unit }}">{{ $supply->name }} ({{ $supply->unit }})</option>
            @endforeach
        `;

        function agregarFilaMaterial() {
            const contenedor = document.getElementById('lista-materiales');
            const nuevaFila = document.createElement('div');
            nuevaFila.className = 'grid grid-cols-12 gap-2 bg-white p-2 rounded-lg border border-blue-100 shadow-sm fade-in relative';
            
            nuevaFila.innerHTML = `
                <div class="col-span-7">
                    <select name="materials[${contadorMateriales}][name]" class="w-full border-gray-200 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 py-1.5" onchange="actualizarUnidad(this)">
                        ${opcionesInsumos}
                    </select>
                </div>
                <div class="col-span-3">
                    <input type="number" name="materials[${contadorMateriales}][quantity]" step="0.1" placeholder="Cant." class="w-full border-gray-200 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 text-center py-1.5">
                </div>
                <div class="col-span-2">
                    <input type="text" name="materials[${contadorMateriales}][unit]" placeholder="Un." class="unidad-input w-full border-gray-200 rounded-md text-xs bg-gray-100 text-gray-500 text-center cursor-not-allowed py-1.5" readonly tabindex="-1">
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-100 text-red-500 rounded-full w-5 h-5 flex items-center justify-center hover:bg-red-200 shadow-sm border border-red-200 text-xs font-bold transition-transform hover:scale-110">×</button>
            `;

            contenedor.appendChild(nuevaFila);
            contadorMateriales++;
        }

        function actualizarUnidad(select) {
            const opcion = select.options[select.selectedIndex];
            const unidad = opcion.getAttribute('data-unit');
            const fila = select.closest('.grid');
            const inputUnidad = fila.querySelector('.unidad-input');
            if(inputUnidad) inputUnidad.value = unidad;
        }
    </script>

    <style>
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>