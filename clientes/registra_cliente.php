<?php 
include ("../conexion_db.php");

$codigo = $_POST['codigo'];
$rs = $_POST['rs'];
$nombre = $_POST['publico'];

echo "INSERT INTO clientes (codigo,razon_social,nombre_publico) VALUES ('".$codigo."','".$rs."','".$nombre."');";

$query = "INSERT INTO clientes (codigo,razon_social,nombre_publico) VALUES ('".$codigo."','".$rs."','".$nombre."');";

$query = $mysqli->query( $query );

 ?>
