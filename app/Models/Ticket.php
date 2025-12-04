<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     */
    protected $fillable = [
        // Datos del solicitante
        'unit_service',
        'applicant_name',
        'applicant_email',
        'applicant_rut',
        'applicant_annex',
        
        // Datos del problema
        'problem_type_id',
        'initial_priority_id',
        'description',
        
        // --- 👇 ESTOS SON LOS QUE NO SE ESTÁN GUARDANDO 👇 ---
        'status_id',             // 👈 Importante
        'assigned_priority_id',  // 👈 Importante
        'assignment_type_id',    // 👈 Importante (Taller)
        'assigned_to_user_id',   // 👈 Importante (Técnico)
        // -----------------------------------------------------

        // Datos de ejecución
        'execution_details',
        'time_spent_hours',
        
        // Sistema
        'reception_approved',
        'reception_comments',
        'secure_token',
        'ticket_number',
        'closed_at',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     */
    protected $casts = [
        'closed_at' => 'datetime',
        'reception_approved' => 'boolean',
        'time_spent_hours' => 'decimal:2',
    ];

    /**
     * "The Boot Method": Lógica automática al crear un registro.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            // 1. Generar Token Seguro (para que el usuario apruebe/rechace sin login)
            if (empty($ticket->secure_token)) {
                $ticket->secure_token = Str::random(60);
            }

            // 2. Generar Número de Ticket Correlativo (OT-0001)
            if (empty($ticket->ticket_number)) {
                // Obtenemos el último ID insertado para calcular el siguiente
                // Nota: Esto es una aproximación simple. En sistemas de altísima concurrencia
                // se recomienda usar una secuencia de base de datos o transacciones.
                $lastTicket = Ticket::latest('id')->first();
                $nextId = $lastTicket ? $lastTicket->id + 1 : 1;
                
                // Formato: OT + 5 dígitos (ej: OT-00045)
                $ticket->ticket_number = 'OT-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
            }

            // 3. Asignar estado inicial "Abierta" si no viene definido
            if (empty($ticket->status_id)) {
                // Asumiendo que el ID 1 es "Abierta" en la tabla ticket_statuses
                $ticket->status_id = 1; 
            }
        });
    }

    /* -------------------------------------------------------------------------- */
    /* RELACIONES                                 */
    /* -------------------------------------------------------------------------- */

    /**
     * Tipo de problema (Eléctrico, Sanitario, etc.)
     */
    public function problemType()
    {
        return $this->belongsTo(TicketProblemType::class, 'problem_type_id');
    }

    /**
     * Prioridad Inicial (La que pone el usuario)
     */
    public function initialPriority()
    {
        return $this->belongsTo(TicketPriority::class, 'initial_priority_id');
    }

    /**
     * Prioridad Asignada (La real definida por RRFF)
     */
    public function assignedPriority()
    {
        return $this->belongsTo(TicketPriority::class, 'assigned_priority_id');
    }

    /**
     * Estado del Ticket (Abierta, Cerrada, etc.)
     */
    public function status()
    {
        return $this->belongsTo(TicketStatus::class, 'status_id');
    }

    /**
     * Técnico asignado (Usuario del sistema)
     */
    public function technician()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    /**
     * Tipo de asignación (Taller Interno o Empresa Externa)
     */
    public function assignmentType()
    {
        return $this->belongsTo(TicketAssignment::class, 'assignment_type_id');
    }

    /**
     * Materiales utilizados en esta OT
     */
    public function materials()
    {
        return $this->hasMany(TicketMaterial::class);
    }

    /**
     * Actualizaciones / Bitácora de avances
     */
    public function updates()
    {
        return $this->hasMany(TicketUpdate::class);
    }

    /**
     * Imágenes adjuntas (Usando la tabla 'images' polimórfica que ya tenías)
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}