<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMaterial extends Model
{
    use HasFactory;

    // 🚨 ESTO ES LO QUE NECESITAS PARA QUE SE GUARDEN LOS INSUMOS
    protected $fillable = [
        'ticket_id',
        'user_id',
        'material_name',
        'quantity',
        'unit'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}