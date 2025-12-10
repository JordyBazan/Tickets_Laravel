<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud - HPEP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <style>
        /* Un fondo suave con patrón para que no se vea plano */
        body { 
            background-color: #f8fafc; 
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="antialiased text-gray-800">

<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

    <div class="w-full flex justify-end p-4">
        <a href="{{ route('login') }}" 
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Ingreso Funcionarios
            <svg class="w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-lg text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-tr from-blue-600 to-blue-400 shadow-lg mb-4 transform transition hover:scale-110 duration-300">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Solicitud de Mantención</h2>
        <p class="mt-2 text-sm text-gray-600 font-medium">Departamento de Recursos Físicos • Hospital El Peral</p>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-4xl">
        <div class="bg-white/90 backdrop-blur-sm py-8 px-6 shadow-2xl sm:rounded-2xl sm:px-12 border border-white/50">
            
            @if(session('success'))
                <div class="mb-8 rounded-xl bg-green-50 p-4 border border-green-200 flex items-start shadow-sm animate-fade-in-down">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-bold text-green-900">¡Recibido!</h3>
                        <div class="mt-1 text-sm text-green-700">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-8 rounded-xl bg-red-50 p-4 border border-red-200 shadow-sm">
                    <div class="flex">
                        <svg class="h-5 w-5 text-red-400 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                        <h3 class="text-sm font-medium text-red-800">Por favor corrige los errores</h3>
                    </div>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-700 ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('public.ticket.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-lg font-bold text-gray-900 flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-bold mr-2 ring-4 ring-white">1</span>
                            Datos del Solicitante
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-6 sm:grid-cols-6 pt-2">
                    
                    <div class="sm:col-span-3">
                        <label for="unit_service" class="block text-sm font-bold text-gray-700 mb-1">Unidad / Servicio</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <input list="services_list" name="unit_service" id="unit_service" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-2.5 transition-shadow" placeholder="Escribe para buscar..." required autocomplete="off">
                            <datalist id="services_list">
                                @foreach($services as $item)
                                    <option value="{{ $item->servicio }}">
                                @endforeach
                            </datalist>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Puedes escribir el nombre de tu unidad para buscarla.</p>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="applicant_name" class="block text-sm font-bold text-gray-700 mb-1">Nombre Completo</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" name="applicant_name" id="applicant_name" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-2.5" placeholder="Ej: Juan Pérez" required>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="applicant_rut" class="block text-sm font-bold text-gray-700 mb-1">RUT</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                            </div>
                            <input type="text" name="applicant_rut" id="applicant_rut" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-2.5" placeholder="12345678-9" required>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="applicant_annex" class="block text-sm font-bold text-gray-700 mb-1">Anexo</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <input type="text" name="applicant_annex" id="applicant_annex" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-2.5" placeholder="Ej: 26500" required>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="applicant_email" class="block text-sm font-bold text-gray-700 mb-1">Email Institucional</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input type="email" name="applicant_email" id="applicant_email" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-2.5" placeholder="@redsalud.gob.cl" required>
                        </div>
                    </div>
                </div>

                <div class="relative pt-6">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-lg font-bold text-gray-900 flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-bold mr-2 ring-4 ring-white">2</span>
                            Detalles del Problema
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6 pt-2">
                    
                    <div class="sm:col-span-3">
                        <label for="problem_type_id" class="block text-sm font-bold text-gray-700 mb-1">Tipo de Problema</label>
                        <select id="problem_type_id" name="problem_type_id" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-lg py-2.5 bg-gray-50" required>
                            @foreach($problemTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="initial_priority_id" class="block text-sm font-bold text-gray-700 mb-1">Prioridad (Tu Criterio)</label>
                        <select id="initial_priority_id" name="initial_priority_id" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-lg py-2.5 bg-gray-50" required>
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="description" class="block text-sm font-bold text-gray-700 mb-1">¿Qué está pasando?</label>
                        <textarea id="description" name="description" rows="4" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-lg p-3 placeholder-gray-400" placeholder="Ej: Hay una filtración de agua en el baño de pacientes de la sala 2..." required></textarea>
                    </div>

                    <div class="sm:col-span-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Evidencia Fotográfica (Opcional)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-blue-50 hover:border-blue-400 transition-colors cursor-pointer group bg-gray-50">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-2">
                                        <span>Seleccionar archivo</span>
                                        <input id="photo" name="photo" type="file" class="sr-only" accept="image/*" onchange="previewFile()">
                                    </label>
                                    <p class="pl-1">o arrastrar aquí</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG hasta 5MB</p>
                                <p id="file-name" class="text-xs text-blue-600 font-bold mt-2 hidden"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent shadow-lg text-lg font-bold rounded-xl text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 transform transition hover:scale-[1.01] duration-200">
                        Enviar Solicitud
                    </button>
                </div>
            </form>
        </div>
        
        <div class="text-center mt-8 space-y-2">
            <p class="text-xs text-gray-500">Sistema de Gestión de Mantenimiento v1.0</p>
            <p class="text-xs text-gray-400">© {{ date('Y') }} Hospital El Peral - Informática</p>
        </div>
    </div>
</div>

<script>
    // Script pequeño para mostrar el nombre del archivo seleccionado
    function previewFile() {
        const input = document.getElementById('photo');
        const fileNameDisplay = document.getElementById('file-name');
        if(input.files.length > 0) {
            fileNameDisplay.textContent = 'Archivo seleccionado: ' + input.files[0].name;
            fileNameDisplay.classList.remove('hidden');
        } else {
            fileNameDisplay.classList.add('hidden');
        }
    }
</script>

</body>
</html>