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
	function buscaCierreIdeal(){
		$query = "SELECT id, datos_proyecto FROM `proyecto`";
		$resultado = queryGeneral($query);
		return $resultado;	
	}
	
 ?>