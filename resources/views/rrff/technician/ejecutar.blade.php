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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-yellow-400"></div>
                    <div class="pl-3">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Solicitud Original</h3>
                        <p class="text-gray-900 font-medium text-lg mb-6 leading-relaxed">"{{ $ticket->description }}"</p>
                        
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 space-y-3 text-sm">
                            <p><span class="font-bold text-gray-500 block text-xs uppercase">Ubicación</span> {{ $ticket->unit_service }}</p>
                            <p><span class="font-bold text-gray-500 block text-xs uppercase">Solicitante</span> {{ $ticket->applicant_name }}</p>
                            <p><span class="font-bold text-gray-500 block text-xs uppercase">Contacto</span> {{ $ticket->applicant_annex }} | {{ $ticket->applicant_email }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Evidencia Fotográfica</h3>
                    @if($ticket->images->count() > 0)
                        <div class="rounded-lg overflow-hidden border border-gray-200">
                            <a href="{{ asset('storage/' . $ticket->images->first()->url) }}" target="_blank">
                                <img src="{{ asset('storage/' . $ticket->images->first()->url) }}" class="w-full h-48 object-cover hover:opacity-90 transition">
                            </a>
                        </div>
                    @else
                        <div class="h-32 bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center text-gray-400 text-sm">Sin evidencia</div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg border border-indigo-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h2 class="text-lg font-bold text-gray-900">Bitácora de Trabajo</h2>
                    </div>

                    <form action="{{ route('technician.update', $ticket->id) }}" method="POST" class="p-6">
                        @csrf
                        @method('PUT')

                        <div class="mb-6 bg-blue-50 p-4 rounded-xl border border-blue-100">
                            <div class="flex justify-between items-center mb-3">
                                <label class="text-sm font-bold text-blue-900">Insumos Utilizados</label>
                                <button type="button" onclick="agregarFilaMaterial()" class="text-xs bg-white border border-blue-300 text-blue-700 px-3 py-1 rounded hover:bg-blue-50 transition shadow-sm">+ Agregar</button>
                            </div>

                            @if($ticket->materials->count() > 0)
                                <div class="mb-3 text-xs text-gray-600 bg-white p-2 rounded border border-blue-100">
                                    <p class="font-bold mb-1 uppercase text-[10px] text-blue-400">Registrados:</p>
                                    <ul class="space-y-1">
                                        @foreach($ticket->materials as $mat)
                                            <li class="flex items-center"><span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span> {{ $mat->material_name }} ({{ $mat->quantity }} {{ $mat->unit }})</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div id="lista-materiales" class="space-y-2">
                                </div>
                            <p class="text-xs text-gray-400 mt-2 ml-1">Selecciona el insumo y la cantidad usada.</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Horas trabajadas HOY</label>
                            <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-200">
                                <div class="relative">
                                    <input type="number" name="hours_today" step="0.5" class="w-24 border-gray-300 rounded-lg text-lg font-bold text-center focus:ring-blue-500 focus:border-blue-500 py-2" placeholder="0.0">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium">hrs</span>
                                </div>
                                <div class="text-sm text-gray-600 flex flex-col border-l border-gray-200 pl-4">
                                    <span class="text-xs text-gray-400 uppercase font-bold tracking-wider">Acumulado Total</span>
                                    <span class="text-lg font-bold text-gray-900">{{ number_format($ticket->time_spent_hours, 1) }} <span class="text-xs font-normal text-gray-500">hrs</span></span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Observación Técnica</label>
                            <textarea name="execution_details" rows="3" class="w-full border-gray-300 rounded-xl text-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 placeholder-gray-400 py-3 px-4" placeholder="Describe brevemente el trabajo realizado...">{{ old('execution_details', $ticket->execution_details) }}</textarea>
                        </div>

                        <hr class="mb-6 border-gray-100">

                        <div class="flex flex-col sm:flex-row gap-3">
                            
                            <button type="submit" name="action" value="save" class="flex-1 bg-white border border-gray-300 text-gray-700 font-bold py-3.5 px-6 rounded-xl hover:bg-gray-50 transition shadow-sm flex justify-center items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                Guardar Avance
                            </button>

                            <button type="submit" name="action" value="finish" onclick="return confirm('¿Seguro que terminaste el trabajo? El ticket se cerrará.')" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 px-6 rounded-xl transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Finalizar y Cerrar Ticket
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let contadorMateriales = 1;
        // Obtenemos los insumos desde PHP
        const opcionesInsumos = `
            <option value="">Seleccione...</option>
            @foreach($supplies as $supply)
                <option value="{{ $supply->name }}" data-unit="{{ $supply->unit }}">{{ $supply->name }}</option>
            @endforeach
        `;

        function agregarFilaMaterial() {
            const contenedor = document.getElementById('lista-materiales');
            const nuevaFila = document.createElement('div');
            nuevaFila.className = 'grid grid-cols-12 gap-2 bg-white p-2 rounded-lg border border-blue-100 shadow-sm fade-in relative';
            
            nuevaFila.innerHTML = `
                <div class="col-span-7">
                    <select name="new_materials[${contadorMateriales}][name]" class="w-full border-gray-200 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-50 py-1.5" onchange="actualizarUnidad(this)" required>
                        ${opcionesInsumos}
                    </select>
                </div>
                <div class="col-span-3">
                    <input type="number" name="new_materials[${contadorMateriales}][quantity]" step="0.1" placeholder="Cant." class="w-full border-gray-200 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 text-center py-1.5" required>
                </div>
                <div class="col-span-2">
                    <input type="text" name="new_materials[${contadorMateriales}][unit]" placeholder="Un." class="unidad-input w-full border-gray-200 rounded-md text-xs bg-gray-100 text-gray-500 text-center cursor-not-allowed py-1.5" readonly tabindex="-1">
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-100 text-red-500 rounded-full w-5 h-5 flex items-center justify-center hover:bg-red-200 shadow-sm border border-red-200 text-xs font-bold transition-transform hover:scale-110">×</button>
            `;

            contenedor.appendChild(nuevaFila);
            contadorMateriales++;
        }

        function actualizarUnidad(select) {
            const opcion = select.options[select.selectedIndex];
            const unidad = opcion.getAttribute('data-unit'); // Obtenemos la unidad del atributo data
            const fila = select.closest('.grid');
            const inputUnidad = fila.querySelector('.unidad-input');
            
            if(inputUnidad) inputUnidad.value = unidad || ''; // Asignamos la unidad al input readonly
        }
    </script>

    <style>
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>