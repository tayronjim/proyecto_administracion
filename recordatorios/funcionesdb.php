<?php 
	include("../conexion_db.php");

	function queryGeneral($query){
		$mysqli = connectdb();
		$resultado = $mysqli->query($query);
		unconnectdb($mysqli);
		return $resultado;
	}

	function buscaSeguimientos(){
		$query = "SELECT id_proyecto, seguimiento FROM `actividades`";
		$resultado = queryGeneral($query);
		return $resultado;	
	}
	function buscaDatosProyectos(){
		$query = "SELECT id, datos_proyecto, contrato, facturacion FROM `proyecto`";
		$resultado = queryGeneral($query);
		return $resultado;	
	}
	function filtraProyecto($id){
		$query = "SELECT * FROM `proyecto` WHERE id=".$id;
		$resultado = queryGeneral($query);
		return $resultado;
	}
	function filtraCliente($id){
		$query = "SELECT datos_cliente FROM `clientes` WHERE id=".$id;
		$resultado = queryGeneral($query);
		return $resultado;
	}
	
	// function buscaFechaGarantia(){
	// 	$query = "SELECT id, datos_proyecto, contrato FROM `proyecto`";
	// 	$resultado = queryGeneral($query);
	// 	return $resultado;	
	// }
 ?>