<?php 

	require_once("funcionesdb.php");

	$funcion = $_POST["funcion"];
	switch($funcion){
		case 'buscaClientes': buscaClientes(); break;
		case 'guardaProyecto': guardaProyecto($_POST["general"],$_POST['cliente'],$_POST["contrato"],$_POST["actividades"],$_POST["seguimiento"], $_POST["proyecto"]); break;
		case 'listadoInicialProyectos': listadoInicialProyectos(); break;
		case 'recuperaProyecto': recuperaProyecto($_POST["proyecto"]); break;
		case 'listaActividades': listaActividades($_POST["proyecto"]); break;
		case 'buscaKam': buscaKam(); break;
		case 'buscaEstatus': buscaEstatus(); break;
		case 'buscaUltimoID': buscaUltimoID(); break;
		case 'pasaAProyecto':pasaAProyecto($_POST["general"],$_POST['cliente'],$_POST["contrato"], $_POST["proyecto"], $_POST["facturacion"]); break;
		
		
	}

	function buscaClientes(){
		$clientes = recuperaClientes();
		while ($row = mysqli_fetch_assoc($clientes)){
		    $cliente[] = $row;
		}
		$struct = array("Cliente" => $cliente);
		print json_encode($cliente);
	}

	function buscaKam(){
		$res = recuperakam();
		while ($row = mysqli_fetch_assoc($res)){
		    $kam[] = $row;
		}
		print json_encode($kam);
	}

	function buscaUltimoID(){
		$ultimoProyecto = ultimoFunnel();
			$row = mysqli_fetch_assoc($ultimoProyecto);
		print json_encode($row['lastID']);
	}

	function guardaProyecto($general,$cliente,$contrato,$actividades,$seguimiento,$proyecto){
		if ($proyecto == 0) {
			$proyectoGuardado = nuevoFunnel($general,$cliente,$contrato);
			$ultimoProyecto = ultimoFunnel();
			$lastId = mysqli_fetch_assoc($ultimoProyecto);
			$actividadSeg = nuevasActividades($actividades,$seguimiento,$lastId['lastID']);
			echo $actividadSeg;
		}
		else{
			$proyectoGuardado = actualizaProy($general,$cliente,$contrato,$proyecto);
			$actividadSeg = actualizaActividades($actividades,$seguimiento,$proyecto);
		}
	}

	function listadoInicialProyectos(){
		$listadoProyectos = listadoProyectos();
		while ($row = mysqli_fetch_assoc($listadoProyectos)){
		    $cliente = json_decode($row['cliente']);
		    $busqueda_cliente = buscaCliente($cliente->cliente);
			$cli[0] = mysqli_fetch_assoc($busqueda_cliente);
			$row['cliente'] = array("ids"=>$row['cliente'],"otros"=>$cli[0]);
			
			$proy[] = $row;
			
		}

		$listadoEstatus = recuperaEstatus();
		while ($row = mysqli_fetch_assoc($listadoEstatus)){
		    $estatus[$row['clave']] = $row;
		}

		$struct = array("Proyectos" => $proy, "Estatus" => $estatus);
		print json_encode($struct);
		
	}

	function recuperaProyecto($proyecto){
		$listadoProyecto = recuperaProyectoCliente($proyecto);
		while ($row = mysqli_fetch_assoc($listadoProyecto)){
		    $proy[] = $row;
		    $cliente = json_decode($row['cliente']);
		}
		
		$busqueda_cliente = buscaCliente($cliente->cliente);
		$cli[] = mysqli_fetch_assoc($busqueda_cliente);

		$listadoEstatus = recuperaEstatus();
		while ($row = mysqli_fetch_assoc($listadoEstatus)){
		    $estatus[] = $row;
		}

		$struct = array("Proyecto" => $proy, "Cliente" => $cli, "Estatus" => $estatus);
		print json_encode($struct);
	}

	function listaActividades($proyecto){
		$listadoActividades = listadoActividades($proyecto);
		$proy =  mysqli_fetch_assoc($listadoActividades);
		echo '{"actividad":'.$proy['actividad'].',"seguimiento":'.$proy['seguimiento'].'}';
	}

	function buscaEstatus(){
		$res = recuperaEstatus();
		while ($row = mysqli_fetch_assoc($res)){
		    $estatus[] = $row;
		}
		print json_encode($estatus);
	}
	function pasaAProyecto($general,$cliente,$contrato,$idFunnel,$facturacion){
			$actividadHeredada = "0";
		 	
		 	if ($proyectoGuardado = insertaProyecto($general,$cliente,$contrato,$facturacion)) {
		 		$lastId = mysqli_fetch_assoc(ultimoProyecto());
			 	
			 	$actividadSeg = heredaActividades($idFunnel,$lastId['lastID']);
			 	$actividadHeredada = "1";
		 	}
			
		 	echo $actividadHeredada;
	}
 ?>