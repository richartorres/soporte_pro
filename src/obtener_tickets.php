<?php
// src/obtener_tickets.php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *"); // Permite que la app móvil consulte sin bloqueos
require_once '../config/database.php';

try {
    $sql = "SELECT id, titulo, nombre_usuario, departamento, descripcion, prioridad, estado, fecha_creacion 
            FROM tickets 
            WHERE estado = 'abierto' 
            ORDER BY id DESC";
            
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($tickets, JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>