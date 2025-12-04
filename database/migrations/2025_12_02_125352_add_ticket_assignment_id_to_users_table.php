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
        Schema::table('users', function (Blueprint $table) {
            // Agregamos la columna que puede ser nula (porque los Jefes no tienen taller)
            $table->foreignId('ticket_assignment_id')
                ->nullable()
                ->after('document_type_id') // Para ordenar visualmente
                ->constrained('ticket_assignments'); // Relación con la tabla de talleres
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
