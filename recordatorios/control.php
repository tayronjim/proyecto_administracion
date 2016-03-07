<?php 
	include('funcionesdb.php');

	$funcion = $_POST['funcion'];

	switch ($funcion) {
		case 'seguimientos': seguimientos(); break;
		case 'datosProyectos': datosProyectos(); break;
		
		
		
		default:
			# code...
			break;
	}

	function seguimientos(){
		$listadoSeguimientos = buscaSeguimientos();
		while ($row = mysqli_fetch_assoc($listadoSeguimientos)){
		    $seguimiento[] = $row;
		}
		$struct = array("Seguimiento" => $seguimiento);
		print json_encode($struct);
		
	}
	function datosProyectos(){
		$listadoCierres = buscaDatosProyectos();
		while ($row = mysqli_fetch_assoc($listadoCierres)){
		    $cierre[] = $row;
		}
		$struct = array("proyecto" => $cierre);
		print json_encode($struct);
		
	}

	// function enFechaDeGarantia(){
	// 	$listadoGarantia = buscaFechaGarantia();
	// 	while ($row = mysqli_fetch_assoc($listadoGarantia)){
	// 	    $garantias[] = $row;
	// 	}
	// 	$struct = array("Cierre" => $garantias);
	// 	print json_encode($struct);
	// }
 ?>