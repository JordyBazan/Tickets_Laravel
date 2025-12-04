<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; background-color: #f3f4f6; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 8px; max-width: 500px; margin: 0 auto; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .badge { background: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .btn { display: block; text-align: center; background: #2563eb; color: white; padding: 10px; text-decoration: none; border-radius: 5px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="color: #1e3a8a; margin-top:0;">Nueva Solicitud Ingresada</h2>
        <p>Hola Jefe,</p>
        <p>Se ha registrado una nueva solicitud en el sistema que requiere su revisión y asignación.</p>
        
        <div style="background: #f8fafc; padding: 15px; border-radius: 6px; border: 1px solid #e2e8f0;">
            <p><strong>Solicitante:</strong> {{ $ticket->applicant_name }}</p>
            <p><strong>Unidad:</strong> {{ $ticket->unit_service }}</p>
            <p><strong>Prioridad Solicitada:</strong> {{ $ticket->initialPriority->name }}</p>
            <p><strong>Problema:</strong> {{ $ticket->description }}</p>
        </div>

        <a href="{{ route('rrff.tickets.edit', $ticket->id) }}" class="btn">Ir a Gestionar Ticket</a>
    </div>
</body>
</html>