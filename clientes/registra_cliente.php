<?php 
include ("../conexion_db.php");

$codigo = $_POST['codigo'];
$fecha = $_POST['fecha'];
$nombre = $_POST['publico'];

$mysqli = connectdb();

//echo "INSERT INTO clientes (clave,nombre_comercial,fecha_alta) VALUES ('".$codigo."','".$nombre."','".$fecha."');";

$query = "INSERT INTO clientes (clave,nombre_comercial,fecha_alta) VALUES ('".$codigo."','".$nombre."','".$fecha."');";

$query = $mysqli->query( $query );

unconnectdb($mysqli);
 
 header('Location: ../index.php');

 ?>
