<?php

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


$titulo = htmlspecialchars($_POST['titulo']);
$descripcion = htmlspecialchars($_POST['descripcion']);
$prioridad  = $_POST['prioridad'];


try 
{

    $sql = "INSERT INTO tickets (titulo, descripcion, prioridad)
    VALUES (:titulo, :descripcion, :prioridad)";
 
    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ':titulo' => $titulo,
        ':descripcion' => $descripcion,
        ':prioridad' => $prioridad
        
    ]);

    header("location: ../index.php");

    exit;

} catch (PDOException $e) {
    echo "Error al guardar el ticket: " . $e->getMessage();
}


}


?>