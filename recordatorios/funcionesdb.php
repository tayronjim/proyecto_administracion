<?php 
	include("../conexion_db.php");

	function queryGeneral($query){
		$mysqli = connectdb();
		$resultado = $mysqli->query($query);
		unconnectdb($mysqli);
		return $resultado;
	}

	function buscaSeguimientos($columna){
		
		$query = "SELECT ".$columna.", seguimiento FROM `actividades` WHERE ".$columna." != 0";
		$resultado = queryGeneral($query);
		return $resultado;	
	}
	function buscaDatosProyectos($area){
		if ($area == "funnel") {
			$query = "SELECT id, datos_proyecto, contrato FROM `funnel`";	
		}
		if ($area == "proyecto") {
			$query = "SELECT id, datos_proyecto, contrato, facturacion FROM `proyecto`";
		}
		
		$resultado = queryGeneral($query);
		return $resultado;	
	}
	function filtraProyecto($id,$area){
		$query = "SELECT * FROM `".$area."` WHERE id=".$id;
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