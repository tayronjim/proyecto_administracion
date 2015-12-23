<?php 
	//$mysqli = mysqli_connect("localhost", "root", "root", "control_clientes") or die("fallo conection");
 function connectdb(){
		$connectdb = new mysqli("localhost", "root", "", "control_clientes");
		mysqli_set_charset( $connectdb, 'utf8' );
		return $connectdb;
	}
function unconnectdb($connectdb){
		$connectdb->close();
	}
 ?>