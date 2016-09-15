<?php session_start();

			
	

	if (isset($_SESSION["usuario"])) {
		if (time() - $_SESSION['LAST_ACTIVITY'] > 10) {
		    // last request was more than 30 minutes ago
			    session_unset();     // unset $_SESSION variable for the run-time 
			    session_destroy();   // destroy session data in storage

			   header('Location: sesion/login.php?rd='.$dirActual);
			}
			else{
				$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
			}
		echo $dirActual;
		//cierra_sesion();
	}
	else{
		header('Location: sesion/login.php?rd='.$dirActual);
	}
	
	
 
	function cierra_sesion(){
		session_unset(); 
		session_destroy(); 
	}
 ?>