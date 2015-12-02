<?php 

	include("../conexion_db.php");

	function queryGeneral($query){
		$mysqli = connectdb();
		$resultado = $mysqli->query($query);
		unconnectdb($mysqli);
		return $resultado;
	}

	function recuperaClientes(){
		$query = "SELECT * FROM `clientes`";
		$resultado = queryGeneral($query);
		return $resultado;	
	}
	
	function recuperaRS($id_cliente){
		$query = "SELECT * from registro_facturacion where id_cliente=".$id_cliente;
		$resultado = queryGeneral($query);
		return $resultado;	
	}

	function nuevoProyecto($datos){
		$j = json_decode($datos);
		foreach ($j as $key => $value) {
			$obj[$value->name] = $value->value;
		}

		$query = "INSERT into proyecto (id_cliente, id_rs, id_proyecto_hermano,titulo, fecha_alta, fecha_cierre_ideal, fecha_cierre_real, estatus) values (".$obj['cliente'].",".$obj['razonS'].",0,'".$obj['txtTituloProyecto']."','".$obj['fIniD'].$obj['fIniM'].$obj['fIniY']."','".$obj['fCIdealD'].$obj['fCIdealM'].$obj['fCIdealY']."','00000000',".$obj['estatus'].");";
		echo $query;
		$resultado = queryGeneral($query);
		return $resultado;	
	}

 ?>