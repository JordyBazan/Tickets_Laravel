<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'material_name',
        'quantity',
        'unit'
    ];

    // Relación con el Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}