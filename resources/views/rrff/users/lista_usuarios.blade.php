<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Gestión de Usuarios</h1>
        <a href="{{ route('rrff.users.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nuevo Usuario
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">{{ session('success') }}</div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-6 py-3">Nombre Completo</th>
                    <th class="px-6 py-3">RUT / Documento</th>
                    <th class="px-6 py-3">Correo</th>
                    <th class="px-6 py-3">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-bold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td class="px-6 py-4">{{ $user->document_number }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Activo</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">{{ $users->links() }}</div>
    </div>
</x-app-layout>