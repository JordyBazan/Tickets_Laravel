<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Importación de Controladores
use App\Http\Controllers\PublicTicketController;
use App\Http\Controllers\RRFFAssignmentController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminRoleController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS (Sin Login)
|--------------------------------------------------------------------------
*/

// 1. Redirección inicial (Al formulario público)
Route::get('/', [PublicTicketController::class, 'create']);

// 2. Solicitud de Ticket (Formulario de ingreso)
Route::get('/solicitud', [PublicTicketController::class, 'create'])->name('public.ticket.create');
Route::post('/solicitud', [PublicTicketController::class, 'store'])->name('public.ticket.store');

// 3. Recepción (Cliente aprueba/rechaza trabajo terminado)
Route::get('/recepcion/{ticket_number}/{token}', [PublicTicketController::class, 'receive'])->name('public.ticket.receive');
Route::post('/recepcion/{ticket_number}/{token}', [PublicTicketController::class, 'approveOrReject'])->name('public.ticket.approve_reject');


/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (Requieren Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // --- DASHBOARD PRINCIPAL ---
    // Esta ruta usa el DashboardController que ya tiene la lógica de gráficos
    // y la redirección automática si es técnico.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // --- ZONA OPERATIVA (TÉCNICOS) ---
    
    Route::get('/mi-trabajo', [TechnicianController::class, 'index'])->name('technician.index');
    Route::get('/mi-trabajo/{id}', [TechnicianController::class, 'edit'])->name('technician.edit');
    Route::put('/mi-trabajo/{id}', [TechnicianController::class, 'update'])->name('technician.update');


    // --- ZONA ADMINISTRATIVA (JEFE RRFF / ADMIN) ---
    // Nota: La seguridad específica de roles (bloqueo a técnicos) está
    // dentro del __construct de cada Controlador para evitar errores de sintaxis aquí.

    // 1. Gestión de Tickets (Bandeja de Entrada y Asignación)
    Route::get('/rrff/tickets', [RRFFAssignmentController::class, 'index'])->name('rrff.tickets.index');
    Route::get('/rrff/tickets/{ticket}/editar', [RRFFAssignmentController::class, 'edit'])->name('rrff.tickets.edit');
    Route::put('/rrff/tickets/{ticket}', [RRFFAssignmentController::class, 'update'])->name('rrff.tickets.update');

    // 2. Gestión de Usuarios (CRUD Completo)
    Route::get('/rrff/usuarios', [AdminUserController::class, 'index'])->name('rrff.users.index');
    Route::get('/rrff/usuarios/crear', [AdminUserController::class, 'create'])->name('rrff.users.create');
    Route::post('/rrff/usuarios', [AdminUserController::class, 'store'])->name('rrff.users.store');
    Route::get('/rrff/usuarios/{id}/editar', [AdminUserController::class, 'edit'])->name('rrff.users.edit');
    Route::put('/rrff/usuarios/{id}', [AdminUserController::class, 'update'])->name('rrff.users.update');
    Route::delete('/rrff/usuarios/{id}', [AdminUserController::class, 'destroy'])->name('rrff.users.destroy');

    // 3. Configuración del Sistema (Mantenedores)
    Route::get('/rrff/configuracion', [AdminSettingsController::class, 'index'])->name('rrff.settings.index');
    
    // Tipos de Problema
    Route::post('/rrff/configuracion/tipo', [AdminSettingsController::class, 'storeProblemType'])->name('rrff.settings.store_type');
    Route::delete('/rrff/configuracion/tipo/{id}', [AdminSettingsController::class, 'destroyProblemType'])->name('rrff.settings.destroy_type');
    
    // Insumos / Suministros
    Route::post('/rrff/configuracion/insumo', [AdminSettingsController::class, 'storeSupply'])->name('rrff.settings.store_supply');
    Route::delete('/rrff/configuracion/insumo/{id}', [AdminSettingsController::class, 'destroySupply'])->name('rrff.settings.destroy_supply');
    
    // Talleres / Asignaciones
    Route::post('/rrff/configuracion/taller', [AdminSettingsController::class, 'storeAssignment'])->name('rrff.settings.store_assignment');
    Route::delete('/rrff/configuracion/taller/{id}', [AdminSettingsController::class, 'destroyAssignment'])->name('rrff.settings.destroy_assignment');

    // 4. Gestión de Roles y Permisos
    Route::get('/rrff/roles', [AdminRoleController::class, 'index'])->name('rrff.roles.index');
    Route::get('/rrff/roles/{role}/permisos', [AdminRoleController::class, 'editPermissions'])->name('rrff.roles.edit_permissions');
    Route::put('/rrff/roles/{role}/permisos', [AdminRoleController::class, 'updatePermissions'])->name('rrff.roles.update_permissions');

});

// Archivo de autenticación de Laravel Breeze
require __DIR__.'/auth.php';