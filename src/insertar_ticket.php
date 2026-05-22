<?php

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


$titulo = htmlspecialchars($_POST['titulo']);
    $nombre_usuario = htmlspecialchars($_POST['nombre_usuario']);
    $departamento = htmlspecialchars($_POST['departamento']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $prioridad = $_POST['prioridad'];


try 
{

    $sql = "INSERT INTO tickets (titulo, nombre_usuario, departamento, descripcion, prioridad, estado, fecha_creacion) 
                VALUES (:titulo, :nombre_usuario, :departamento, :descripcion, :prioridad, 'abierto', NOW())";
 
    $stmt = $conexion->prepare($sql);

    $stmt->execute([

            ':titulo'         => $titulo,
            ':nombre_usuario' => $nombre_usuario,
            ':departamento'   => $departamento,
            ':descripcion'    => $descripcion,
            ':prioridad'      => $prioridad
        
    ]);

    header("Location: ../agradecimiento.php");

    exit;

} catch (PDOException $e) {
    echo "Error al guardar el ticket: " . $e->getMessage();
}


}


?>