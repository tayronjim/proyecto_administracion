<?php

	include('funcionesdb.php');

	$funcion = $_POST['funcion'];

	switch ($funcion) {
		case 'listado': listado(); break;
		
		default:
			# code...
			break;
	}

	function listado(){
		$listadoClientes = listadoClientes();
		while ($row = mysqli_fetch_assoc($listadoClientes)){
		    $cliente[] = $row;
		}
		$struct = array("Cliente" => $cliente);
		print json_encode($struct);
	}
 ?>