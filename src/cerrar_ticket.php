<?php

require_once '../config/database.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {

$id = (int)$_GET['id'];

    try
    {

   $sql = "DELETE FROM tickets WHERE id = :id";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([

    ':id' => $id

    ]);

   header("Location: ../index.php");
        exit;

    } catch (PDOException $e) 
        {
            echo "Error al eliminar el ticket: " . $e->getMessage();
        }

} else {
    header("Location: ../index.php");
    exit;
}

?>