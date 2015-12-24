<?php

	include('funcionesdb.php');

	$funcion = $_POST['funcion'];

	switch ($funcion) {
		case 'listado': listado(); break;
		case 'buscaClientes': buscaClientes($_POST['cliente']); break;
		case 'buscaRS': buscaRS($_POST['cliente']); break;
		case 'guardaCliente': guardaCliente($_POST['datos_cliente'], $_POST['datos_contacto'], $_POST['datos_facturacion']); break;
		
		
		default:
			# code...
			break;
	}

	function guardaCliente($cliente, $contacto, $facturacion){
		$datos = guardaDatos($cliente, $contacto, $facturacion);
	}

	function listado(){
		$listadoClientes = listadoClientes();
		while ($row = mysqli_fetch_assoc($listadoClientes)){
		    $cliente[] = $row;
		}
		$struct = array("Cliente" => $cliente);
		print json_encode($struct);
	}

	function buscaClientes($cliente){
		$clientes = recuperaCliente($cliente);
		// print_r($contacto);
		while ($row = mysqli_fetch_assoc($clientes)){
		    $cli[] = $row;
		}
		$struct = array("Cliente" => $cli);
		print json_encode($struct);
	}

	function buscaRS($cliente){
		$facturacion = recuperaFacturacion($cliente);
		// print_r($contacto);
		while ($row = mysqli_fetch_assoc($facturacion)){
		    $cli[] = $row;
		}
		$struct = array("Cliente" => $cli);
		print json_encode($struct);
	}


 ?>