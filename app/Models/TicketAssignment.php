<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAssignment extends Model
{
    use HasFactory;

    // Habilitar guardado masivo
    protected $fillable = ['name', 'is_internal'];
}