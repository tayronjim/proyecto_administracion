<?php 
	//$mysqli = mysqli_connect("localhost", "root", "root", "control_clientes") or die("fallo conection");
 function connectdb(){
		//$connectdb = new mysqli("192.168.1.176:3306", "remoto", "", "control_clientes");
		$connectdb = new mysqli("localhost", "remoto", "", "control_clientes");
		mysqli_set_charset( $connectdb, 'utf8' );
		return $connectdb;
	}
function unconnectdb($connectdb){
		$connectdb->close();
	}
 ?>