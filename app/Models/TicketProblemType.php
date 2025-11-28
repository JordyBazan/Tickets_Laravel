<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketProblemType extends Model
{
    use HasFactory;

    // ESTA LÍNEA ES LA QUE TE FALTA:
    protected $fillable = ['name'];
}