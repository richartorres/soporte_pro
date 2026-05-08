<?php

$host = "localhost";
$db_name = "gestion_tickets";
$username = "root";
$password = "";

try 
{

$conexion = new PDO("mysql:host=$host; dbname=$db_name;charset=utf8mb4", $username, $password);

$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) 

{
echo "Error de conexión!:" . $e->getMessage();
exit; 
}

?>