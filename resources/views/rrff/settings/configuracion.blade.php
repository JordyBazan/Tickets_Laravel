<x-app-layout>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Configuración de Sistema</h1>
    </div>

    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            <span class="font-medium">¡Listo!</span> {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Error:</span> {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white p-6 rounded-lg shadow h-fit">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Tipos de Problema</h2>
            <p class="text-sm text-gray-500 mb-4">Agrega aquí las categorías de fallas (ej: Gasfitería, Redes, Climatización).</p>
            
            <form action="{{ route('rrff.settings.store_type') }}" method="POST" class="flex gap-2 mb-6">
                @csrf
                <input type="text" name="name" placeholder="Ej: Aire Acondicionado" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2">Agregar</button>
            </form>

            <ul class="space-y-2">
                @foreach($problemTypes as $type)
                    <li class="flex justify-between items-center p-3 bg-gray-50 rounded border border-gray-200 hover:bg-gray-100">
                        <span class="text-gray-700 font-medium">{{ $type->name }}</span>
                        <form action="{{ route('rrff.settings.destroy_type', $type->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este tipo?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white p-6 rounded-lg shadow h-fit">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Prioridades del Sistema</h2>
            
            <div class="p-4 bg-blue-50 text-blue-800 text-sm rounded mb-4 flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"></path></svg>
                <span>Las prioridades son <b>estándar</b> para asegurar que el ordenamiento automático de los tickets funcione correctamente.</span>
            </div>

            <ul class="space-y-2">
                @foreach($priorities as $priority)
                    <li class="flex justify-between items-center p-3 bg-gray-50 rounded border border-gray-200">
                        <span class="text-gray-700 font-medium">{{ $priority->name }}</span>
                        @php
                            $colors = [
                                1 => 'bg-red-100 text-red-800',
                                2 => 'bg-orange-100 text-orange-800',
                                3 => 'bg-yellow-100 text-yellow-800',
                                4 => 'bg-green-100 text-green-800',
                            ];
                            $color = $colors[$priority->level] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="{{ $color }} text-xs font-bold px-2.5 py-0.5 rounded border border-opacity-20 border-gray-400">
                            Nivel {{ $priority->level }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white p-6 rounded-lg shadow h-fit">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Talleres / Unidades</h2>
            <p class="text-sm text-gray-500 mb-4">Destinos para derivar el trabajo (Internos o Externos).</p>
            
            <form action="{{ route('rrff.settings.store_assignment') }}" method="POST" class="flex gap-2 mb-6">
                @csrf
                <input type="text" name="name" placeholder="Ej: Taller Electricidad" required 
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2">
                    Agregar
                </button>
            </form>

            <ul class="space-y-2">
                @foreach($assignments as $assign)
                    <li class="flex justify-between items-center p-3 bg-gray-50 rounded border border-gray-200 hover:bg-gray-100">
                        <span class="text-gray-700 font-medium">{{ $assign->name }}</span>
                        
                        <form action="{{ route('rrff.settings.destroy_assignment', $assign->id) }}" method="POST" onsubmit="return confirm('¿Borrar este taller?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

</x-app-layout>