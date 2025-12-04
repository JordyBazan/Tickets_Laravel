<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; background-color: #f3f4f6; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 8px; max-width: 500px; margin: 0 auto; border-left: 5px solid #16a34a; }
        .btn { display: block; text-align: center; background: #16a34a; color: white; padding: 10px; text-decoration: none; border-radius: 5px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="color: #14532d; margin-top:0;">Nueva Asignación</h2>
        <p>Hola <strong>{{ $ticket->technician->first_name }}</strong>,</p>
        <p>Se te ha asignado una nueva Orden de Trabajo.</p>
        
        <ul style="background: #f0fdf4; padding: 15px 30px; border-radius: 6px;">
            <li><strong>N° Ticket:</strong> {{ $ticket->ticket_number }}</li>
            <li><strong>Lugar:</strong> {{ $ticket->unit_service }}</li>
            <li><strong>Prioridad:</strong> {{ $ticket->initialPriority->name }}</li>
        </ul>

        <p><strong>Descripción:</strong><br> {{ $ticket->description }}</p>

        <a href="{{ route('technician.edit', $ticket->id) }}" class="btn">Ver y Ejecutar Trabajo</a>
    </div>
</body>
</html>