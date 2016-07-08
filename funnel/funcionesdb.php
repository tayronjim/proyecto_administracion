<?php 

	include("../conexion_db.php");

	function queryGeneral($query){
		$mysqli = connectdb();
		$resultado = $mysqli->query($query);
		unconnectdb($mysqli);
		return $resultado;
	}

	function ultimoProyecto(){
		$query = "SELECT MAX(id) as lastID FROM `proyecto`";
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function recuperaClientes(){
		$query = "SELECT * FROM `clientes`";
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function recuperakam(){
		$query = "SELECT * FROM `kam`";
		$resultado = queryGeneral($query);
		return $resultado;
	}
	
	// function recuperaRS($id_cliente){
	// 	$query = "SELECT facturacion as fac FROM clientes where id=".$id_cliente;
	// 	$resultado = queryGeneral($query);
	// 	return $resultado;	
	// }

	function nuevoFunnel($general,$cliente,$contrato){
		$dato_cliente = json_decode($cliente);
		$query = "INSERT into funnel (cliente, datos_proyecto, contrato) values ('".$cliente."','".$general."','".$contrato."');";
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function actualizaProy($general,$cliente,$contrato,$proyecto){
		$query = "UPDATE funnel SET cliente='".$cliente."', datos_proyecto='".$general."', contrato='".$contrato."' WHERE id=".$proyecto;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function nuevasActividades($actividad, $seguimiento, $proyecto){
		$query = "INSERT INTO actividades (id_funnel,actividad,seguimiento) values (".$proyecto.",'".$actividad."','".$seguimiento."')";
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function actualizaActividades($actividad, $seguimiento, $proyecto){

		$query = "UPDATE actividades SET actividad='".$actividad."', seguimiento='".$seguimiento."' where id_funnel=".$proyecto;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function listadoProyectos(){
		$query = "SELECT * FROM `funnel`";
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function recuperaProyectoCliente($proyecto){
		$query = "SELECT  * FROM `funnel` where id = ".$proyecto;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function buscaCliente($id_cliente){
		$query = "SELECT  * FROM `clientes` where id = ".$id_cliente;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function listadoActividades($proyecto){
		$query = "SELECT actividad, seguimiento from actividades where id_funnel = ".$proyecto;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function recuperaEstatus(){
		$query = "SELECT * FROM estatus_funnel";
		$resultado = queryGeneral($query);
		return $resultado;
	}
	function insertaProyecto($general,$cliente,$contrato,$facturacion){
		$query="INSERT INTO proyecto (cliente, datos_proyecto, facturacion, contrato) values (".$cliente.",".$general.",".$facturacion.",".$contrato.")";
		$resultado = queryGeneral($query);
		return $resultado;
	}
	function actualizaActividades($idFunnel,$idProyecto){
		$query = "UPDATE actividades SET id_proyecto = '".$idProyecto."' WHERE id_funnel = ".$idFunnel;
		$resultado = queryGeneral($query);
		return $resultado;
	}

?>