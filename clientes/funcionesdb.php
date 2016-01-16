<?php 
	include("../conexion_db.php");

	function queryGeneral($query){
		$mysqli = connectdb();
		$resultado = $mysqli->query($query);
		unconnectdb($mysqli);
		return $resultado;
	}

	function listadoClientes(){
		$query = "SELECT * FROM `clientes`";
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function recuperaCliente($cliente){
		$query = "SELECT * FROM `clientes` where id=".$cliente;
		$resultado = queryGeneral($query);
		return $resultado;	
	}
	function guardaDatos($cliente, $contacto, $facturacion){
		$query = "INSERT INTO clientes (datos_cliente, datos_contacto, facturacion) VALUES ('".$cliente."','".$contacto."','".$facturacion."');";
		$resultado = queryGeneral($query);
		return $resultado;
	}
	function actualizaDatos($cliente, $contacto, $facturacion,$id){
		$query = "UPDATE clientes SET datos_cliente='".$cliente."', datos_contacto='".$contacto."', facturacion='".$facturacion."' WHERE id=".$id;
		//$query = "INSERT INTO clientes (datos_cliente, datos_contacto, facturacion) VALUES ('".$cliente."','".$contacto."','".$facturacion."');";
		$resultado = queryGeneral($query);
		return $resultado;
	}
 ?>