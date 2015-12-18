<?php 
include ("../conexion_db.php");

$codigo = $_POST['codigo'];
$fecha = $_POST['fecha'];
$nombre = $_POST['publico'];
$idCliente = $_POST['idCliente'];
$facVal = $_POST['facval'];

$mysqli = connectdb();

//echo "INSERT INTO clientes (clave,nombre_comercial,fecha_alta) VALUES ('".$codigo."','".$nombre."','".$fecha."');";

if ($idCliente == '0') {
	$query = "INSERT INTO clientes (clave,nombre_comercial,fecha_alta,facturacion) VALUES ('".$codigo."','".$nombre."','".$fecha."','".$facVal."');";
}
else {
	$query = "UPDATE clientes SET clave='".$codigo."', nombre_comercial='".$nombre."',facturacion='".$facVal."' WHERE id=".$idCliente;
}
//echo $query;

$query = $mysqli->query( $query );

unconnectdb($mysqli);
 
 header('Location: listado_clientes.php');

 ?>
