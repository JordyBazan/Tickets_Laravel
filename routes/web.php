<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicTicketController;
use App\Http\Controllers\RRFFAssignmentController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminUserController;

// 1. Redirección inicial
Route::get('/', [PublicTicketController::class, 'create']);
Route::get('/dashboard', function () {
    return redirect()->route('rrff.tickets.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// 2. Rutas Públicas (Solicitud)
Route::get('/solicitud', [PublicTicketController::class, 'create'])->name('public.ticket.create');
Route::post('/solicitud', [PublicTicketController::class, 'store'])->name('public.ticket.store');

// 3. Rutas Protegidas (Panel RRFF)
Route::middleware(['auth'])->group(function () {
    Route::get('/rrff/tickets', [RRFFAssignmentController::class, 'index'])->name('rrff.tickets.index');
    Route::get('/rrff/tickets/{ticket}/editar', [RRFFAssignmentController::class, 'edit'])->name('rrff.tickets.edit');
    Route::put('/rrff/tickets/{ticket}', [RRFFAssignmentController::class, 'update'])->name('rrff.tickets.update');
});

// 4. Recepción
Route::get('/recepcion/{ticket}/{token}', [PublicTicketController::class, 'receive'])->name('public.ticket.receive');
Route::post('/recepcion/{ticket}/{token}', [PublicTicketController::class, 'approveOrReject'])->name('public.ticket.approve_reject');


// Rutas de Configuración / Mantenedores
Route::get('/rrff/configuracion', [App\Http\Controllers\AdminSettingsController::class, 'index'])->name('rrff.settings.index');
Route::post('/rrff/configuracion/tipo', [App\Http\Controllers\AdminSettingsController::class, 'storeProblemType'])->name('rrff.settings.store_type');
Route::delete('/rrff/configuracion/tipo/{id}', [App\Http\Controllers\AdminSettingsController::class, 'destroyProblemType'])->name('rrff.settings.destroy_type');


// Rutas para TALLERES / ASIGNACIONES
    Route::post('/rrff/configuracion/taller', [App\Http\Controllers\AdminSettingsController::class, 'storeAssignment'])->name('rrff.settings.store_assignment');
    Route::delete('/rrff/configuracion/taller/{id}', [App\Http\Controllers\AdminSettingsController::class, 'destroyAssignment'])->name('rrff.settings.destroy_assignment');


// GESTIÓN DE USUARIOS
Route::get('/rrff/usuarios', [App\Http\Controllers\AdminUserController::class, 'index'])->name('rrff.users.index');
Route::get('/rrff/usuarios/crear', [App\Http\Controllers\AdminUserController::class, 'create'])->name('rrff.users.create');
Route::post('/rrff/usuarios', [App\Http\Controllers\AdminUserController::class, 'store'])->name('rrff.users.store');

// 5. Archivo de autenticación
require __DIR__.'/auth.php';