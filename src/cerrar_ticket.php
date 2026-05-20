<?php

require_once '../config/database.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {

$id = (int)$_GET['id'];

    try
    {

   $sql = "UPDATE tickets SET estado = 'cerrado' WHERE id = :id";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([

    ':id' => $id

    ]);

   header("Location: ../index.php");
        exit;

    } catch (PDOException $e) 
        {
            echo "Error al cerrar el ticket: " . $e->getMessage();
            exit;
        }

} else {
    header("Location: ../index.php");
    exit;
}

?>