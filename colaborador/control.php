<?php 
	include('funcionesdb.php');

	$funcion = $_POST['funcion'];

	switch ($funcion) {
		case 'listaColaborador': listaColaborador(); break;
		case 'guardaColaborador': guardaColaborador($_POST['datos']); break;
		case 'actualizaColaborador': actualizaColaborador($_POST['id'], $_POST['datos']); break;
		case 'buscaColaborador': buscaColaborador($_POST['id']); break;
		
		

	
		default:
			# code...
			break;
	}

	function listaColaborador(){
		$lista = listaCol();
		while ($value = mysqli_fetch_assoc($lista)) {
			$col[] = $value;
		}
		$struct = array("Col" => $col);
		
		print json_encode($col);
	}

	function guardaColaborador($datos){
		$guardado = guardaCol($datos);
		echo $guardado;
		// while ($row = mysqli_fetch_assoc($listadoClientes)){
		//     $cliente[] = $row;
		// }
		// $struct = array("Cliente" => $cliente);
		// print json_encode($struct);
	}

		function actualizaColaborador($id, $datos){
		$guardado = actualizaCol($id, $datos);
		// while ($row = mysqli_fetch_assoc($listadoClientes)){
		//     $cliente[] = $row;
		// }
		// $struct = array("Cliente" => $cliente);
		// print json_encode($struct);
	}

	function buscaColaborador($id){
		$colaborador = buscaCol($id);
		foreach (mysqli_fetch_assoc($colaborador) as $key => $value) {
			$col[$key] = $value;
		}
		
		print json_encode($col);
	}

 ?>