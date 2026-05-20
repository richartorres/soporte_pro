<?php 
// 1. Conectamos la base de datos
require_once 'config/database.php'; 

// 2. Consulta Backend modificada: SOLO los resueltos/cerrados
try {
    $sql = "SELECT * FROM tickets WHERE estado = 'cerrado' ORDER BY fecha_creacion DESC";
    $sentencia = $conexion->query($sql);
    $tickets = $sentencia->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al consultar el historial: " . $e->getMessage();
    $tickets = []; 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoportePro - Historial de Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-secondary mb-0 fw-bold">Historial de Tickets Resueltos</h1>
            <a href="index.php" class="btn btn-outline-dark fw-bold">← Volver al Panel</a>
        </div>
        
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white fw-bold py-3">
                Registro Histórico de Fallas Técnicas Solucionadas
            </div>
            <div class="card-body p-4">
                
                <?php if (empty($tickets)): ?>
                    <div class="alert alert-warning text-center my-3 fw-semibold" role="alert">
                        No hay un historial registrado todavía.
                    </div>
                <?php else: ?>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Título del Problema</th>
                                    <th>Descripción de la Falla</th>
                                    <th>Prioridad</th>
                                    <th>Fecha de Reporte</th>
                                    <th>Estado del Ticket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tickets as $ticket): ?>
                                    <tr>
                                        <td class="fw-bold">#<?php echo $ticket['id']; ?></td>
                                        <td><?php echo htmlspecialchars($ticket['titulo'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="text-muted small"><?php echo htmlspecialchars($ticket['descripcion'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        
                                        <td>
                                            <?php 
                                            $prioridad = strtolower($ticket['prioridad']);
                                            if ($prioridad === 'alta') {
                                                echo '<span class="badge bg-danger">Alta</span>';
                                            } elseif ($prioridad === 'media') {
                                                echo '<span class="badge bg-warning text-dark">Media</span>';
                                            } else {
                                                echo '<span class="badge bg-success">Baja</span>';
                                            }
                                            ?>
                                        </td>
                                        
                                        <td class="text-muted small"><?php echo $ticket['fecha_creacion']; ?></td>
                                        
                                        <td>
                                            <span class="badge bg-success px-3 py-2 fw-bold text-uppercase">Solucionado</span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                <?php endif; ?>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>