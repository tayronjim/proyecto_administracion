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
	
	function recuperaRS($id_cliente){
		$query = "SELECT facturacion as fac FROM clientes where id=".$id_cliente;
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function nuevoProyecto($general,$cliente,$contrato,$facturacion){
		
		$dato_cliente = json_decode($cliente);
		$query = "INSERT into proyecto (cliente, id_proyecto_hermano,datos_proyecto, facturacion, contrato) values ('".$cliente."',0,'".$general."','".$facturacion."','".$contrato."');";
		$resultado = queryGeneral($query);

		return $resultado;	
	}

	function actualizaProy($general,$cliente,$contrato,$facturacion,$proyecto){
		$query = "UPDATE proyecto SET cliente='".$cliente."', datos_proyecto='".$general."', facturacion='".$facturacion."', contrato='".$contrato."' WHERE id=".$proyecto;
		echo $query;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function nuevasActividades($proyecto){

		$query = "INSERT INTO actividades (id_proyecto) values (".$proyecto.")";
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function actualizaActividades($actividad, $seguimiento, $proyecto){

		$query = "UPDATE actividades SET actividad='".$actividad."', seguimiento='".$seguimiento."' where id_proyecto=".$proyecto;
		echo $query;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function listadoProyectos(){
		$query = "SELECT * FROM `proyecto`";
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function recuperaProyectoCliente($proyecto){
		$query = "SELECT  * FROM `proyecto` where id = ".$proyecto;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function buscaCliente($id_cliente){
		$query = "SELECT  * FROM `clientes` where id = ".$id_cliente;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function listadoActividades($proyecto){
		$query = "SELECT actividad, seguimiento from actividades where id_proyecto = ".$proyecto;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function recuperaEstatus(){
		$query = "SELECT * FROM estatus";
		$resultado = queryGeneral($query);
		return $resultado;
	}

?>