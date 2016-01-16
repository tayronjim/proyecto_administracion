<?php 
	include('funcionesdb.php');

	$funcion = $_POST['funcion'];

	switch ($funcion) {
		case 'seguimientos': seguimientos(); break;
		
		
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
 ?>