<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number', 20)->unique()->nullable(); // Se genera automático
            
            // Datos del solicitante
            $table->string('unit_service'); // Unidad/Servicio
            $table->string('applicant_name', 150);
            $table->string('applicant_email');
            $table->string('applicant_rut', 12);
            $table->string('applicant_annex', 20)->nullable();
            
            // Detalles del problema (Llaves foráneas)
            $table->foreignId('problem_type_id')->constrained('ticket_problem_types');
            $table->foreignId('initial_priority_id')->constrained('ticket_priorities');
            $table->foreignId('assigned_priority_id')->nullable()->constrained('ticket_priorities');
            
            $table->text('description');
            
            // Gestión interna
            $table->foreignId('status_id')->constrained('ticket_statuses');
            $table->foreignId('assigned_to_user_id')->nullable()->constrained('users');
            $table->foreignId('assignment_type_id')->nullable()->constrained('ticket_assignments');
            
            // Ejecución y Cierre
            $table->text('execution_details')->nullable();
            $table->decimal('time_spent_hours', 8, 2)->nullable();
            
            // Recepción del usuario
            $table->boolean('reception_approved')->default(0);
            $table->text('reception_comments')->nullable();
            $table->string('secure_token', 60)->nullable();
            $table->timestamp('closed_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
