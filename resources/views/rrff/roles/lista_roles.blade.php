<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Roles y Permisos</h1>
            <p class="mt-1 text-sm text-gray-500">Define qué puede hacer cada tipo de usuario en el sistema.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 text-sm text-green-700 bg-green-100 rounded-lg border-l-4 border-green-500">
                <span class="font-bold">¡Listo!</span> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nombre del Rol</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Usuarios Asignados</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($roles as $role)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-gray-900">{{ $role->title }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $role->users()->count() }} usuarios
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('rrff.roles.edit_permissions', $role->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold bg-indigo-50 px-3 py-1 rounded-md transition-colors hover:bg-indigo-100">
                                    Gestionar Permisos
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>