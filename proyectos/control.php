<?php 

	require_once("funcionesdb.php");

	$funcion = $_POST["funcion"];
	switch($funcion){
		case 'buscaClientes': buscaClientes(); break;
		case 'buscaRS': buscaRS($_POST["id_cliente"]); break;
		case 'guardaProyecto': guardaProyecto($_POST["datos"]); break;
		case 'guardaRegistroActividades': guardaRegistroActividades($_POST["datos"],$_POST["proyecto"]); break;
		case 'guardaRegistroSeguimiento': guardaRegistroSeguimiento($_POST["datos"],$_POST["proyecto"]); break;
		case 'listadoInicialProyectos': listadoInicialProyectos(); break;
		case 'recuperaProyecto': recuperaProyecto($_POST["proyecto"]); break;
		case 'listaActividades': listaActividades($_POST["proyecto"]); break;
		case 'listaSeguimientos': listaSeguimientos($_POST["proyecto"]); break;
		
		
		
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
		$ultimoProyecto = ultimoProyecto();

		$lastId = mysqli_fetch_assoc($ultimoProyecto);
		nuevasActividades($lastId['lastID']);
		nuevosSeguimientos($lastId['lastID']);
		print $lastId['lastID'];
	}

	function guardaRegistroActividades($datos, $proyecto){
		$actividadesGuardadas = actualizaActividades($datos, $proyecto);
		print $actividadesGuardadas;
	}

	function guardaRegistroSeguimiento($datos, $proyecto){
		$seguimientosGuardados = actualizaSeguimientos($datos, $proyecto);
		echo $seguimientosGuardados; 
	}

	function listadoInicialProyectos(){
		$listadoProyectos = listadoProyectos();
		while ($row = mysqli_fetch_assoc($listadoProyectos)){
		    $proyectos[] = $row;
		}
		$struct = array("Proyectos" => $proyectos);
		print json_encode($struct);
	}

	function recuperaProyecto($proyecto){
		$listadoProyecto = recuperaProyectoCliente($proyecto);
		while ($row = mysqli_fetch_assoc($listadoProyecto)){
		    $proy[] = $row;
		}
		$struct = array("Proyecto" => $proy);
		print json_encode($struct);
	}

	function listaActividades($proyecto){
		$listadoActividades = listadoActividades($proyecto);
		
		$proy =  mysqli_fetch_assoc($listadoActividades);
		
		echo $proy['actividad'];
	}

	function listaSeguimientos($proyecto){
		$listadoSeguimientos = listadoSeguimientos($proyecto);
		
		    $proy = mysqli_fetch_assoc($listadoSeguimientos);
		
		print $proy['actividad'];
	}

 ?>