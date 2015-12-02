<?php 

	require_once("funcionesdb.php");

	$funcion = $_POST["funcion"];
	switch($funcion){
		
		case 'buscaClientes': buscaClientes(); break;
		case 'buscaRS': buscaRS($_POST["id_cliente"]); break;
		case 'guardaProyecto': guardaProyecto($_POST["datos"]); break;
		
		
	}
	function buscaClientes(){
		$clientes = recuperaClientes();
		// print_r($contacto);
		while ($row = mysqli_fetch_assoc($clientes)){
		    $cliente[] = $row;
		}
		$struct = array("Cliente" => $cliente);
		print json_encode($struct);
	}
	function buscaRS($id_cliente)
	{
		$rs = recuperaRS($id_cliente);
		// print_r($contacto);
		while ($row = mysqli_fetch_assoc($rs)){
		    $clienteRS[] = $row;
		}
		$struct = array("RS" => $clienteRS);
		print json_encode($struct);
	}

	function guardaProyecto($datos){
		$proyectoGuardado = nuevoProyecto($datos);
		print $proyectoGuardado;
	}

 ?>