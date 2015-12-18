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

	function nuevoProyecto($datos){
		$j = json_decode($datos);

		foreach ($j as $key => $value) {
			$obj[$value->name] = $value->value;
		}

		$query = "INSERT into proyecto (id_cliente, id_rs, id_proyecto_hermano,titulo, fecha_alta, fecha_cierre_ideal, fecha_cierre_real, estatus) values (".$obj['cliente'].",".$obj['razonS'].",0,'".$obj['txtTituloProyecto']."','".$obj['fIniD'].$obj['fIniM'].$obj['fIniY']."','".$obj['fCIdealD'].$obj['fCIdealM'].$obj['fCIdealY']."','00000000',1);";
		
		$resultado = queryGeneral($query);

		return $resultado;	
	}

	function nuevasActividades($proyecto){
		// $jAct = json_decode($datos);
		// $datos = "";
		// foreach ($jAct as $key => $value) {
		// 	$datos = $datos.'('.$proyecto.',"'. $value->fecha .'","'. $value->act .'"), ';
		// }

		$query = "INSERT INTO actividades (id_proyecto) values (".$proyecto.")";
		$resultado = queryGeneral($query);
		echo $query;
	}

	function actualizaActividades($datos, $proyecto){
		// $jAct = json_decode($datos);
		// $datos = "";
		// foreach ($jAct as $key => $value) {
		// 	$datos = $datos.'('.$proyecto.',"'. $value->fecha .'","'. $value->act .'"), ';
		// }

		$query = "UPDATE actividades SET actividad='".$datos."' where id_proyecto=".$proyecto;
		$resultado = queryGeneral($query);
		echo $query;
	}

	function nuevosSeguimientos($proyecto){
		$query = "INSERT INTO seguimiento (id_proyecto) values (".$proyecto.")";
		$resultado = queryGeneral($query);
		echo $query;
	}

	function actualizaSeguimientos($datos, $proyecto){
		// $jSeg = json_decode($datos);
		// $datos = "";
		// foreach ($jSeg as $key => $value) {
		// 	$datos = $datos.'('.$proyecto.',"'. $value->fecha .'","'. $value->act .'"), ';
		// }

		$query = "UPDATE seguimiento SET actividad='".$datos."' where id_proyecto=".$proyecto;
		$resultado = queryGeneral($query);
		echo $query;
	}

	function listadoProyectos(){
		$query = "SELECT `proyecto`.id as proy_id, `proyecto`.titulo as proy_titulo,`proyecto`.fecha_alta as proy_alta, `proyecto`.fecha_cierre_ideal as proy_cierre_ideal, `proyecto`.estatus as proy_estatus, `fac`.razon_social, `clientes`.clave,`clientes`.nombre_comercial FROM `proyecto` left join registro_facturacion as fac on proyecto.id_rs=fac.id left join clientes on fac.id_cliente= clientes.id ";
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function recuperaProyectoCliente($proyecto){
		$query = "SELECT  `proyecto`.*, `fac`.razon_social, `clientes`.nombre_comercial FROM `proyecto` left join registro_facturacion as fac on proyecto.id_rs=fac.id left join clientes on fac.id_cliente= clientes.id where `proyecto`.id = ".$proyecto;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function listadoActividades($proyecto){
		$query = "SELECT actividad from actividades where id_proyecto = ".$proyecto;
		$resultado = queryGeneral($query);
		return $resultado;
	}

	function listadoSeguimientos($proyecto){
		$query = "SELECT actividad from seguimiento where id_proyecto = ".$proyecto;
		$resultado = queryGeneral($query);
		return $resultado;
	}
	

 ?>