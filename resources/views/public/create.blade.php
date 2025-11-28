<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Mantención - HPEP</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 antialiased">

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden p-8">
        
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900">
                Solicitud de Mantención / O.T.
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Hospital Psiquiátrico El Peral - Recursos Físicos
            </p>
        </div>

        @if(session('success'))
            <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <div class="ms-3 text-sm font-medium">
                    <span class="font-bold">¡Excelente!</span> {{ session('success') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-success" aria-label="Close">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                <span class="font-medium">Por favor corrija los siguientes errores:</span>
                <ul class="mt-1.5 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('public.ticket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6 border-b border-gray-200 pb-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">1. Datos del Solicitante</h3>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    
                    <div class="col-span-2 sm:col-span-1">
                        <label for="unit_service" class="block mb-2 text-sm font-medium text-gray-900">Unidad / Servicio</label>
                        <select id="unit_service" name="unit_service" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="">Seleccione...</option>
                            @foreach($services as $item)
                                <option value="{{ $item->servicio }}">{{ $item->servicio }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="applicant_name" class="block mb-2 text-sm font-medium text-gray-900">Nombre Completo</label>
                        <input type="text" id="applicant_name" name="applicant_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ej: Juan Pérez" required>
                    </div>

                    <div>
                        <label for="applicant_rut" class="block mb-2 text-sm font-medium text-gray-900">RUT</label>
                        <input type="text" id="applicant_rut" name="applicant_rut" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="12345678-9" required>
                    </div>

                    <div>
                        <label for="applicant_annex" class="block mb-2 text-sm font-medium text-gray-900">Anexo</label>
                        <input type="text" id="applicant_annex" name="applicant_annex" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ej: 26500" required>
                    </div>

                    <div class="col-span-2">
                        <label for="applicant_email" class="block mb-2 text-sm font-medium text-gray-900">Correo Electrónico</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                    <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                </svg>
                            </div>
                            <input type="email" id="applicant_email" name="applicant_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="nombre@redsalud.gob.cl" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">2. Datos del Problema</h3>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    
                    <div>
                        <label for="problem_type_id" class="block mb-2 text-sm font-medium text-gray-900">Tipo de Problema</label>
                        <select id="problem_type_id" name="problem_type_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            @foreach($problemTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="initial_priority_id" class="block mb-2 text-sm font-medium text-gray-900">Prioridad (Según su criterio)</label>
                        <select id="initial_priority_id" name="initial_priority_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descripción del Problema</label>
                        <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Describa el problema con el mayor detalle posible..." required></textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="photo">Subir Foto (Opcional)</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="photo_help" id="photo" name="photo" type="file" accept="image/*">
                        <p class="mt-1 text-sm text-gray-500" id="photo_help">JPG o PNG (Máx. 5MB).</p>
                    </div>
                </div>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center transition-colors duration-200 w-full">
                Enviar Solicitud
            </button>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>