<?php 
	//$mysqli = mysqli_connect("localhost", "root", "root", "control_clientes") or die("fallo conection");
 function connectdb(){
		$connectdb = new mysqli("mysql.server325.com:3306", "dmausr", "Dma271", "diazmoron_cand");
		//$connectdb = new mysqli("localhost", "remoto", "", "diazmoron_cand");
		mysqli_set_charset( $connectdb, 'utf8' );
		return $connectdb;
	}
function unconnectdb($connectdb){
		$connectdb->close();
	}
 ?>