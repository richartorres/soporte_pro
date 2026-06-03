<?php
// src/resolver_ticket.php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leer el JSON entrante desde la app móvil
    $jsonData = file_get_contents($_POST['id'] ? 'php://input' : 'php://input');
    $data = json_decode($jsonData, true);
    
    // Validar si viene por JSON o por POST estándar
    $id = $data['id'] ?? $_POST['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "ID del ticket requerido"]);
        exit;
    }

    try {
        $sql = "UPDATE tickets SET estado = 'resuelto' WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id' => $id]);

        echo json_encode(["status" => "success", "message" => "Ticket marcado como resuelto"]);
        
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
?>