<?php 
	include("../conexion_db.php");

	function queryGeneral($query){
		$mysqli = connectdb();
		$resultado = $mysqli->query($query);
		unconnectdb($mysqli);
		return $resultado;
	}

	function listaCol(){
		$query = "SELECT * FROM `kam` ";
		//echo $query;
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function guardaCol($datos){
		$query = "INSERT INTO `kam` (`datos`) VALUES ('".$datos."');";

		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function actualizaCol($id, $datos){
		$query = "UPDATE `kam` SET `datos`='".$datos."' WHERE `id`=".$id;
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function buscaCol($id){
		$query = "SELECT `datos` FROM `kam` WHERE `id`=".$id;
		//echo $query;
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	
 ?>