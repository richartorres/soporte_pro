<?php
 require_once 'config/database.php'; 

try {
    $sql = "SELECT * FROM tickets WHERE estado IS NULL OR estado != 'cerrado' ORDER BY id DESC";
    
    $sentencia = $conexion->query($sql);
    $tickets = $sentencia->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al consultar los tickets: " . $e->getMessage();
    $tickets = []; 
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tickets - SoportePro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Gestión de Tickets - SoportePro</h1>

    <br><br>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Listado de Solicitudes</h3>
        <a href="crear_ticket.php" class="btn btn-primary">Crear Nuevo Ticket</a>
    </div>

    <br>

    <?php if (empty($tickets)): ?>
        <div class="alert alert-info text-center">
            Todavía no hay tickets registrados. ¡Sé el primero en crear uno!
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered shadow-sm align-middle bg-white">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 15%;">Título</th>
                        <th style="width: 15%;">Usuario</th>
                        <th style="width: 15%;">Departamento</th>
                        <th style="width: 20%;">Descripción</th>
                        <th style="width: 10%;">Prioridad</th>
                        <th style="width: 10%;">Fecha</th>
                        <th style="width: 10%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><strong>#<?php echo $ticket['id']; ?></strong></td>
                            <td><?php echo htmlspecialchars($ticket['titulo']); ?></td>
                            <td class="fw-semibold text-dark"><?php echo htmlspecialchars($ticket['nombre_usuario']); ?></td>
                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($ticket['departamento']); ?></span></td>
                            <td><?php echo htmlspecialchars($ticket['descripcion']); ?></td>
                            <td>
                                <span class="badge <?php 
                                    echo ($ticket['prioridad'] == 'alta') ? 'bg-danger' : 
                                         (($ticket['prioridad'] == 'media') ? 'bg-warning text-dark' : 'bg-success'); 
                                ?>">
                                    <?php echo ucfirst($ticket['prioridad']); ?>
                                </span>
                            </td>
                            <td class="text-muted small"><?php echo $ticket['fecha_creacion']; ?></td>
                            <td>
                                <a href="src/cerrar_ticket.php?id=<?php echo $ticket['id']; ?>" 
                                class="btn btn-sm btn-primary fw-bold text-white w-100" 
                                onclick="return confirmarResolucion();">
                                Resolver
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <br><br>

    <div class="d-flex justify-content-center">
        <a href="historial.php" class="btn btn-secondary fw-bold">Ver Historial</a>
    </div>

</div>

<br><br>

<script>
function confirmarResolucion() {
    return confirm("¿Confirmas que ya resolviste el problema de tu compañero y deseas cerrar este ticket?");
}
</script>

</body>
</html>