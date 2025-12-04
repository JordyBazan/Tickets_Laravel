<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Registrar Nuevo Usuario</h1>
            <a href="{{ route('rrff.users.index') }}" class="text-blue-600 hover:underline font-medium">
                &larr; Volver a la lista
            </a>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200">
            <form action="{{ route('rrff.users.store') }}" method="POST">
                @csrf
                
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                        <input type="text" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ej: Miguel" required>
                    </div>

                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Apellido</label>
                        <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ej: Céspedes" required>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="document_number" class="block mb-2 text-sm font-medium text-gray-900">RUT (Documento)</label>
                        <input type="text" id="document_number" name="document_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="12345678-9" required>
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="nombre@hpep.cl" required>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Rol / Perfil</label>
                        <select name="role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="">Seleccione un rol...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Taller / Unidad (Solo Técnicos)</label>
                        <select name="ticket_assignment_id" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5">
                            <option value="">-- Ninguno / Administrativo --</option>
                            @foreach($talleres as $taller)
                                <option value="{{ $taller->id }}">{{ $taller->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña de acceso</label>
                        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="******" required minlength="6">
                    </div>
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center transition-colors">
                    Guardar Usuario
                </button>
            </form>
        </div>
    </div>
</x-app-layout>