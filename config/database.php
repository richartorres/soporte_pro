<?php

$host = "bhkakiz7f9mdp8uua5cx-mysql.services.clever-cloud.com";
$db_name = "bhkakiz7f9mdp8uua5cx";
$username = "u2psihec0lpgivkg";
$password = "UhzbWcsxjgJDfKzDdzkn";
$port = "3306";

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