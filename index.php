
<?php
 require_once 'config/database.php'; 

 $sql = "SELECT *  FROM tickets ORDER BY fecha_creacion DESC";

 $sentencia = $conexion->query($sql);

 $tickets = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tickets - SoportePro</title>

    <!-- CDN de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">


<div class="container mt-5">
    <h1 class="text-center mb-4">Gestión de Tickets - SoportePro</h1>


    <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Listado de Solicitudes</h3>
    <a href="crear_ticket.php" class="btn btn-primary">Crear Nuevo Ticket</a>
    </div>

    
    <?php if (empty($tickets)): ?>
        <!-- Si no hay tickets, mostramos un aviso -->
        <div class="alert alert-info text-center">
            Todavía no hay tickets registrados. ¡Sé el primero en crear uno!
        </div>
    <?php else: ?>
        <!-- Si HAY tickets, creamos la tabla -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Prioridad</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?php echo $ticket['id']; ?></td>
                            <td><?php echo htmlspecialchars($ticket['titulo'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($ticket['descripcion'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <!-- Ponemos un color según la prioridad -->
                                <span class="badge <?php 
                                    echo ($ticket['prioridad'] == 'alta') ? 'bg-danger' : 
                                         (($ticket['prioridad'] == 'media') ? 'bg-warning text-dark' : 'bg-success'); 
                                ?>">
                                    <?php echo ucfirst($ticket['prioridad']); ?>
                                </span>
                            </td>
                            <td><?php echo $ticket['fecha_creacion']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>


</body>
</html>
