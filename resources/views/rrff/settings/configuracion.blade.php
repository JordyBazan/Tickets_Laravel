<x-app-layout>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Configuración del Sistema</h1>
                <p class="mt-2 text-sm text-gray-500">Administra los catálogos de soporte, talleres e insumos.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 text-sm text-green-700 bg-green-100 rounded-lg border-l-4 border-green-500 shadow-sm" role="alert">
                <span class="font-bold">¡Listo!</span> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-6 p-4 text-sm text-red-700 bg-red-100 rounded-lg border-l-4 border-red-500 shadow-sm" role="alert">
                <span class="font-bold">Atención:</span> {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-800">Tipos de Problema</h2>
                    <p class="text-xs text-gray-500 mt-1">Categorías para clasificar las solicitudes.</p>
                </div>
                
                <div class="p-6">
                    <form action="{{ route('rrff.settings.store_type') }}" method="POST" class="flex gap-2 mb-6">
                        @csrf
                        <input type="text" name="name" placeholder="Ej: Aire Acondicionado" required class="flex-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 transition-colors">
                            Agregar
                        </button>
                    </form>

                    <div class="space-y-2 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($problemTypes as $type)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-300 transition-colors group">
                                <span class="text-gray-700 font-medium text-sm">{{ $type->name }}</span>
                                <form action="{{ route('rrff.settings.destroy_type', $type->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este tipo?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-1 rounded-md hover:bg-red-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden h-fit">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-800">Prioridades del Sistema</h2>
                    <p class="text-xs text-gray-500 mt-1">Niveles de urgencia predefinidos.</p>
                </div>
                
                <div class="p-6">
                    <div class="p-4 bg-blue-50 text-blue-800 text-sm rounded-lg mb-4 flex items-start border border-blue-100">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Estas prioridades son fijas para asegurar el correcto ordenamiento automático de los tickets.</span>
                    </div>

                    <ul class="space-y-2">
                        @foreach($priorities as $priority)
                            @php
                                $colors = [
                                    1 => 'bg-red-50 text-red-700 border-red-200',
                                    2 => 'bg-orange-50 text-orange-700 border-orange-200',
                                    3 => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                    4 => 'bg-green-50 text-green-700 border-green-200',
                                ];
                                $color = $colors[$priority->level] ?? 'bg-gray-50 text-gray-700 border-gray-200';
                            @endphp
                            <li class="flex justify-between items-center p-3 rounded-lg border {{ $color }}">
                                <span class="font-medium text-sm">{{ $priority->name }}</span>
                                <span class="text-xs font-bold uppercase tracking-wider opacity-80">Nivel {{ $priority->level }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden lg:col-span-2">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Talleres y Unidades</h2>
                        <p class="text-xs text-gray-500 mt-1">Equipos internos o externos para asignar trabajos.</p>
                    </div>
                </div>
                
                <div class="p-6">
                    <form action="{{ route('rrff.settings.store_assignment') }}" method="POST" class="flex gap-4 mb-6 items-end max-w-lg">
                        @csrf
                        <div class="flex-1">
                            <label class="block mb-1 text-xs font-medium text-gray-700">Nombre del Taller</label>
                            <input type="text" name="name" placeholder="Ej: Taller Electricidad" required class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block p-2.5">
                        </div>
                        <button type="submit" class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors">
                            Agregar
                        </button>
                    </form>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($assignments as $assign)
                            <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow group">
                                <div class="flex items-center gap-3">
                                    <div class="bg-purple-100 p-2 rounded-lg text-purple-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                    <span class="text-gray-800 font-medium text-sm">{{ $assign->name }}</span>
                                </div>
                                <form action="{{ route('rrff.settings.destroy_assignment', $assign->id) }}" method="POST" onsubmit="return confirm('¿Borrar este taller?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden lg:col-span-2">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-800">Catálogo de Insumos</h2>
                    <p class="text-xs text-gray-500 mt-1">Materiales disponibles para que los técnicos seleccionen.</p>
                </div>

                <div class="p-6">
                    <form action="{{ route('rrff.settings.store_supply') }}" method="POST" class="flex flex-col sm:flex-row gap-4 mb-8 items-end bg-gray-50 p-4 rounded-lg border border-gray-100">
                        @csrf
                        <div class="flex-1 w-full">
                            <label class="block mb-1 text-xs font-medium text-gray-700">Nombre del Insumo</label>
                            <input type="text" name="name" placeholder="Ej: Cable UTP Cat6" required class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5">
                        </div>
                        <div class="w-full sm:w-32">
                            <label class="block mb-1 text-xs font-medium text-gray-700">Unidad</label>
                            <input type="text" name="unit" placeholder="Ej: mts" class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5">
                        </div>
                        <button type="submit" class="w-full sm:w-auto text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors">
                            Agregar Insumo
                        </button>
                    </form>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($supplies as $supply)
                            <div class="flex justify-between items-center p-3 bg-white rounded-lg border border-gray-200 hover:border-green-400 transition-all hover:shadow-sm group">
                                <div class="flex flex-col">
                                    <span class="text-gray-800 font-medium text-sm">{{ $supply->name }}</span>
                                    <span class="text-xs text-gray-400 font-mono bg-gray-100 px-1.5 py-0.5 rounded w-fit mt-1">{{ $supply->unit }}</span>
                                </div>
                                <form action="{{ route('rrff.settings.destroy_supply', $supply->id) }}" method="POST" onsubmit="return confirm('¿Borrar?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>