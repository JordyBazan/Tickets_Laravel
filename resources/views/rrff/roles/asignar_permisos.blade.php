<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">
        
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">
                Permisos para: <span class="text-indigo-600">{{ $role->title }}</span>
            </h1>
            <a href="{{ route('rrff.roles.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">← Volver</a>
        </div>

        <form action="{{ route('rrff.roles.update_permissions', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($permissionsGrouped as $modulo => $permisos)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide">{{ $modulo }}</h3>
                        </div>
                        <div class="p-4 space-y-3">
                            @foreach($permisos as $permiso)
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="perm_{{ $permiso->id }}" 
                                               name="permissions[]" 
                                               value="{{ $permiso->id }}" 
                                               type="checkbox" 
                                               class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                               {{ $role->permissions->contains($permiso->id) ? 'checked' : '' }}>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="perm_{{ $permiso->id }}" class="font-medium text-gray-700 cursor-pointer select-none">
                                            {{ $permiso->permission }}
                                        </label>
                                        <p class="text-gray-500 text-xs">{{ $permiso->title }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 shadow-lg transform transition hover:-translate-y-0.5">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</x-app-layout>