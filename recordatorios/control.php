<?php 
	include('funcionesdb.php');

	$funcion = $_POST['funcion'];

	switch ($funcion) {
		case 'seguimientos': seguimientos($_POST['area']); break;
		case 'datosProyectos': datosProyectos($_POST['area']); break;
		
		
		
		default:
			# code...
			break;
	}

	function seguimientos($area){
		if ($area == "funnel") {
			$columna = "id_funnel";
		}
		if ($area == "proyecto") {
			$columna = "id_proyecto";
		}
		$listadoSeguimientos = buscaSeguimientos($columna);
		while ($row = mysqli_fetch_assoc($listadoSeguimientos)){
		    
		    $proyecto = filtraProyecto($row[$columna],$area);
		    $proy[0] = mysqli_fetch_assoc($proyecto);
		    $row['proyecto'] = $proy[0]['datos_proyecto'];
		    $cliente = json_decode($proy[0]['cliente']);
		   // print_r($cliente);
		    $cli[0] = mysqli_fetch_assoc(filtraCliente($cliente->cliente));
		    //print_r($cli[0]);
		    $row['cliente'] = $cli[0]['datos_cliente'];
		    $seguimiento[] = $row;
		}
		$struct = array("Seguimiento" => $seguimiento);
		print json_encode($struct);
		
	}
	function datosProyectos($area){
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