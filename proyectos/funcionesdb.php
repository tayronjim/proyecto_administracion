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
	
	function recuperaRS($id_cliente){
		//$query = "SELECT * from registro_facturacion where id_cliente=".$id_cliente;
		$query = "SELECT facturacion as fac FROM clientes where id=".$id_cliente;
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function nuevoProyecto($general,$cliente,$contrato,$facturacion){
		

		$dato_cliente = json_decode($cliente);

		$query = "INSERT into proyecto (cliente,id_cliente, id_rs, id_proyecto_hermano,datos_proyecto, facturacion, contrato) values ('".$cliente."',".$dato_cliente->cliente.",".$dato_cliente->razonS.",0,'".$general."','".$facturacion."','".$contrato."');";
		
		$resultado = queryGeneral($query);

		return $resultado;	
	}

	function actualizaProy($general,$cliente,$contrato,$facturacion,$proyecto){
		$query = "UPDATE proyecto SET cliente='".$cliente."', datos_proyecto='".$general."', facturacion='".$facturacion."', contrato='".$contrato."' WHERE id=".$proyecto;
	}

	function nuevasActividades($proyecto){
		// $jAct = json_decode($datos);
		// $datos = "";
		// foreach ($jAct as $key => $value) {
		// 	$datos = $datos.'('.$proyecto.',"'. $value->fecha .'","'. $value->act .'"), ';
		// }

		$query = "INSERT INTO actividades (id_proyecto) values (".$proyecto.")";
		$resultado = queryGeneral($query);
		// echo $query;
	}

	function actualizaActividades($actividad, $seguimiento, $proyecto){

		$query = "UPDATE actividades SET actividad='".$actividad."', seguimiento='".$seguimiento."' where id_proyecto=".$proyecto;
		$resultado = queryGeneral($query);
		echo $query;
	}

	function nuevosSeguimientos($proyecto){
		$query = "INSERT INTO seguimiento (id_proyecto) values (".$proyecto.")";
		$resultado = queryGeneral($query);
		echo $query;
	}

	// function actualizaSeguimientos($datos, $proyecto){
	// 	// $jSeg = json_decode($datos);
	// 	// $datos = "";
	// 	// foreach ($jSeg as $key => $value) {
	// 	// 	$datos = $datos.'('.$proyecto.',"'. $value->fecha .'","'. $value->act .'"), ';
	// 	// }

	// 	$query = "UPDATE seguimiento SET actividad='".$datos."' where id_proyecto=".$proyecto;
	// 	$resultado = queryGeneral($query);
	// 	echo $query;
	// }

	function listadoProyectos(){
		$query = "SELECT `proyecto`.id as proy_id, `proyecto`.titulo as proy_titulo,`proyecto`.fecha_alta as proy_alta, `proyecto`.fecha_cierre_ideal as proy_cierre_ideal, `proyecto`.estatus as proy_estatus, `fac`.razon_social, `clientes`.clave,`clientes`.nombre_comercial FROM `proyecto` left join registro_facturacion as fac on proyecto.id_rs=fac.id left join clientes on fac.id_cliente= clientes.id ";
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

	// function listadoSeguimientos($proyecto){
	// 	$query = "SELECT seguimiento from seguimiento where id_proyecto = ".$proyecto;
	// 	$resultado = queryGeneral($query);
	// 	return $resultado;
	// }
	

 ?>