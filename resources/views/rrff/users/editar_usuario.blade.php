<x-app-layout>
    <div class="max-w-4xl mx-auto py-6 px-4">
        
        <!-- Encabezado -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Editar Usuario: {{ $user->first_name }}</h1>
            <a href="{{ route('rrff.users.index') }}" class="text-blue-600 hover:underline font-medium flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver a la lista
            </a>
        </div>

        <div class="bg-white p-8 rounded-lg shadow border border-gray-200">
            <form action="{{ route('rrff.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    
                    <!-- Datos Personales -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Apellido</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">RUT</label>
                        <input type="text" name="document_number" value="{{ $user->document_number }}" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" required>
                    </div>

                    <!-- Cambio de Contraseña -->
                    <div class="col-span-2 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Nueva Contraseña (Opcional)</label>
                        <input type="password" name="password" class="bg-white border border-gray-300 text-sm rounded-lg block w-full p-2.5" placeholder="Déjalo vacío si no quieres cambiarla">
                        <p class="text-xs text-gray-500 mt-1">Solo llena esto si quieres restablecer la clave del usuario.</p>
                    </div>

                    <hr class="col-span-2 my-2 border-gray-200">

                    <!-- ROL -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-blue-800">Rol / Perfil</label>
                        <select name="role_id" class="bg-blue-50 border border-blue-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                    {{ $role->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- TALLER -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Taller (Solo Técnicos)</label>
                        <select name="ticket_assignment_id" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                            <option value="">-- Ninguno / Administrativo --</option>
                            @foreach($talleres as $taller)
                                <option value="{{ $taller->id }}" {{ $user->ticket_assignment_id == $taller->id ? 'selected' : '' }}>
                                    {{ $taller->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ESTADO -->
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Estado de la cuenta</label>
                        <select name="status" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>🟢 Activo (Puede entrar)</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>🔴 Inactivo (Bloqueado)</option>
                        </select>
                    </div>
                </div>

                <!-- SECCIÓN DE PERMISOS EXCEPCIONALES -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Permisos Directos (Excepciones)</h3>
                    <p class="text-sm text-gray-500 mb-4">
                        Otorga permisos adicionales a este usuario, independientemente de su rol.
                        <br>
                        <span class="text-xs text-indigo-600 font-bold bg-indigo-50 px-2 py-1 rounded">Nota: Los marcados y deshabilitados se heredan del Rol.</span>
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($permissions as $menu => $perms)
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <h4 class="font-bold text-gray-700 uppercase text-xs border-b border-gray-300 mb-3 pb-1">{{ $menu }}</h4>
                                <div class="space-y-2">
                                    @foreach($perms as $perm)
                                        @php
                                            // Verificar si lo tiene por ROL (CORREGIDO: permissions.id)
                                            $hasViaRole = $user->roles()->whereHas('permissions', function($q) use ($perm) {
                                                $q->where('permissions.id', $perm->id);
                                            })->exists();
                                            
                                            // Verificar si lo tiene DIRECTAMENTE
                                            $hasDirect = $user->permissions->contains($perm->id);
                                        @endphp

                                        <div class="flex items-start">
                                            <div class="flex h-5 items-center">
                                                <input id="perm_{{ $perm->id }}" 
                                                       name="direct_permissions[]" 
                                                       value="{{ $perm->id }}" 
                                                       type="checkbox" 
                                                       class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 disabled:bg-gray-200 disabled:text-gray-400 cursor-pointer disabled:cursor-not-allowed"
                                                       {{ $hasDirect ? 'checked' : '' }}
                                                       {{ $hasViaRole ? 'checked disabled' : '' }}
                                                >
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="perm_{{ $perm->id }}" class="font-medium {{ $hasViaRole ? 'text-gray-400' : 'text-gray-700 cursor-pointer' }}">
                                                    {{ $perm->title }}
                                                </label>
                                                @if($hasViaRole)
                                                    <span class="text-[10px] text-gray-400 ml-1 block">(Por Rol)</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Actualizar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>