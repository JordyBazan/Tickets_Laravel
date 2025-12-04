<x-app-layout>
    <div class="max-w-full mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestión de Personal</h1>
                <p class="mt-1 text-sm text-gray-500">Administración de cuentas de técnicos y jefaturas.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('rrff.users.create') }}" class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Nuevo Usuario
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 text-sm text-green-700 bg-green-100 rounded-lg border-l-4 border-green-500" role="alert">
                <span class="font-bold">¡Listo!</span> {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nombre Completo</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Correo Electrónico</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">RUT</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Rol / Taller</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <div class="flex items-center">
                                        <div class="h-9 w-9 flex-shrink-0 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                            {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="font-semibold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $user->email }}
                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 font-mono">
                                    {{ $user->document_number }}
                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <div class="flex flex-col items-start gap-1">
                                        @php
                                            $roleName = $user->roles->first()?->title ?? 'Sin Rol';
                                            $badgeColor = match($roleName) {
                                                'Administrador' => 'bg-purple-100 text-purple-700 border-purple-200',
                                                'Jefe RRFF' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                'Técnico' => 'bg-orange-100 text-orange-700 border-orange-200',
                                                default => 'bg-gray-100 text-gray-600 border-gray-200'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium border {{ $badgeColor }}">
                                            {{ $roleName }}
                                        </span>

                                        @if($user->taller)
                                            <span class="text-xs text-gray-500 flex items-center">
                                                <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                                {{ Str::limit($user->taller->name, 20) }}
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-center">
                                    @if($user->status == 1)
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Activo</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Inactivo</span>
                                    @endif
                                </td>

                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('rrff.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 p-1.5 rounded-md transition-colors" title="Editar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <form action="{{ route('rrff.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Eliminar a {{ $user->first_name }}?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-1.5 rounded-md transition-colors" title="Eliminar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="border-t border-gray-200 bg-gray-50 px-4 py-3 sm:px-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>