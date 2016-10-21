<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#btnBuscar").click(function(){

			});

		});
		function abrePerfil($id){
			
			window.open('perfil.php?id='+$id,'_BLANK')

		}
	</script>
	<style type="text/css">
	body{
		background-color: #EEE;
		font-family: arial;
	}
		.header{
			width: 100%;
			height: 80px;
			border:1px solid black;
			background-color: #335599;
			color: #FFF;
		}
		.menuleft{
			width: 200px;
			float: left;
			border:1px solid black;
			padding: 10px;
		}
		.cuerpo{
			width: auto;
			max-width: 85%;
			
			float: left;
		}
		thead td{
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #3C63B3), color-stop(1, #4D80E6) );
			color: #FFF;
			padding: 10px;
			text-align: center;
		}
		.filaResultado > td{
			background-color: #FFF;
			font-size: 12px;
			padding: 5px;
		}
		
		.filaResultado:hover > td{
			background-color: RGB(0,172,237);
			cursor: pointer;
		}
		.filaResultado ul{
			padding-left: 15px;
		}
	</style>
</head>
	

<body>
<?php 

	include_once("conexion_db.php"); 

	
function checkBusqueda(){
	$claveErr = $emailErr = "";
	$nombre = $email = $gender = $comment = $website = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	  
	 

	 
	  $empresa = test_input($_POST["empresa"]); 
	  echo $empresa." ";
	  $findJob = "`candidato_historial`.Empresa LIKE '%".$empresa."%' AND ";

	  $salarioMayor = test_input($_POST["salarioMayor"]);
	  $salarioMenor = test_input($_POST["salarioMenor"]);
	  echo "(".$salarioMayor. "->".$salarioMenor.") ";
	  $findSalario = "(candidato_generales.SueldoDes > ".$salarioMenor." AND candidato_generales.SueldoDes < ".$salarioMayor.") OR candidato_generales.SueldoDes = 0 ";


	  $puesto = test_input($_POST["puesto"]); 
	  echo $puesto." ";
	  $findPuesto = "`candidato_historial`.Puesto LIKE '%".$puesto."%' AND ";

	  $residencia = test_input($_POST["residencia"]);
	  echo $residencia." ";
	  $nombre = test_input($_POST["nombre"]); 
	  echo $nombre." ";
	  $findName = "concat(`candidato`.Nombre,' ',`candidato`.ApPaterno,' ',`candidato`.ApMaterno) LIKE '%".$nombre."%' AND ";
	  $findRecidence = "concat(candidato_generales.Dir_Ciudad,' ',candidato_generales.Dir_Estado) LIKE '%".$residencia."%' AND ";
	  $conocimientos = test_input($_POST["conocimientos"]);
	  echo $conocimientos." ";
	  $findKnowed ="";
	  $output = preg_split( "/,/", $conocimientos);
	  foreach ($output as $key => $value) { $findKnowed .= "(SELECT IF(`candidato_extras`.IdCandidato > 0, `candidato_extras`.Descripcion LIKE '%".test_input($value)."%', 1)) AND "; }
	  
	  

	   $busqueda = busqueda($findName,$findRecidence,$findKnowed,$findJob,$findPuesto,$findSalario);
	  
	 	return $busqueda;
	}
	return 0;
}
	

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function busqueda($nombre,$residencia,$conocimientos,$empresa,$puesto,$SueldoDes){
	$contador = "SELECT COUNT(`IdCandidato`) as contador FROM `candidato` WHERE 1";

	$query = "SELECT `candidato`.IdCandidato, concat(`candidato`.Nombre,' ',`candidato`.ApPaterno,' ',`candidato`.ApMaterno) as nombre, `candidato`.eMail, ";
	//$query .=	 "group_concat(DISTINCT '<li>',`candidato_estudios`.Institucion,' > ',`catestudio_grado`.Descripcion,'</li>') as estudios, ";
	$query .=	 "`candidato_extras`.Descripcion as extras, `candidato_generales`.*, ";
	$query .=	 "group_concat(DISTINCT '<li>',`candidato_historial`.Empresa,' > ',`candidato_historial`.Puesto,'</li>') as historialLaboral ";
	$query .="FROM `candidato` ";
	//$query .=	 "INNER JOIN `candidato_estudios` ON `candidato`.IdCandidato = `candidato_estudios`.IdCandidato ";
	//$query .=	 "INNER JOIN `catestudio_grado` ON `candidato_estudios`.IdGradoEstudio = `catestudio_grado`.IdGrado ";
	$query .=	 "LEFT JOIN `candidato_extras` ON `candidato`.IdCandidato = `candidato_extras`.IdCandidato ";
	$query .=	 "LEFT JOIN `candidato_generales` ON `candidato`.IdCandidato = `candidato_generales`.IdCandidato ";
	$query .=	 "LEFT JOIN `candidato_historial` ON `candidato_historial`.IdCandidato = `candidato`.IdCandidato ";
	$query .="WHERE ";
	$query .=	 $nombre;
	$query .=	 $residencia;
	//$query .=	 "Institucion LIKE '%u%' AND ";
	$query .=	 $conocimientos;
	$query .=	 $empresa;
	$query .=	 $puesto;
	$query .=	 $SueldoDes;
	$query .=	 "1 ";
	$query .="GROUP BY `candidato_historial`.IdCandidato ";
	$query .="ORDER BY `candidato`.IdCandidato limit 0,100";

	//echo $query;

	$connectdb = connectdb();
	
	$tablaCandidato = $connectdb->query($query);

	unconnectdb($connectdb);

	return $tablaCandidato;

}

	


?>
<div class="header"><h1>BUSQUEDA DE CANDIDATOS</h1></div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	<div class="menuleft">
		<b>Filtro:</b><br><br>
		Nombre:<br>
		<input type="text" name="nombre" id="nombre"><br>
		<!-- eMail:<br>
		<input type="text"><br> -->
		Residencia:<br>
		<input type="text" name="residencia" id="residencia"><br>
		Conocimientos:<br>
		<input type="text" name="conocimientos" id="conocimientos"><br>
		<!-- Giro:<br>
		<input type="text"><br> -->
		Empresa:<br>
		<input type="text" name="empresa" id="empresa"><br>
		Puesto:<br>
		<input type="text" name="puesto" id="puesto"><br>
		<br>
		Sueldo Deseado:<br>
		<input type="text" name="salarioMenor" id="salarioMenor">-<input type="text" name="salarioMayor" id="salarioMayor"><br>
		<br>
		<input type="submit" value="Buscar" id="btnBuscar">
		<br><br>
		<div style="border:1px solid black; padding-left:3px; font-size:12px;">
			+ Texto Obligatorio (AND)<br>
			- Texto a Ignorar (NOT)<br>
			, Texto Optativo (OR)<br>
		</div>
		<br>
		<?php 
			$contador = "SELECT COUNT(`IdCandidato`) as contador FROM `candidato` WHERE 1";
			$connectdb = connectdb();
			$totalCandidatos = $connectdb->query($contador);
			unconnectdb($connectdb);
			$contCand = mysqli_fetch_assoc($totalCandidatos);
			echo "<label style='font-size:13px; font-weight:bold;'>Candidatos Registrados: ".$contCand['contador']."</label>";
		 ?>
			
	</div>
</form>

<div class="cuerpo">
<div id="check"></div>
	<table border="1">
		<thead>
			<tr>
				<td width="200px">Candidato</td>
				<td width="210px">eMail</td>
				<!-- <td>Instituto</td> -->
				<td width="260px">Conocimientos</td>
				<td width="150px">Residencia</td>
				<td width="310px">Historial Laboral</td>
			</tr>
		</thead>
		<tbody>
			<?php 
				$idCandidato = "";
				$nombre = "";
				$email = "";
				//$estudios = "";
				$conocimientos = "";
				$residencia = "";
				$historialLaboral = "";
				$SueldoDes = "";

				$tablaCandidato = checkBusqueda();
				if ($tablaCandidato) {
					$alt = -1;
					while ($row = mysqli_fetch_assoc($tablaCandidato)) {
						
							$idCandidato = $row['IdCandidato'];
							$nombre = $row['nombre'];
							$email = $row['eMail'];
							//$estudios = $row['estudios'];
							$conocimientos = $row['extras'];
							$residencia = $row['Dir_Ciudad']."<br>".$row['Dir_Estado']."<br>".$row['Dir_Pais'];
							$historialLaboral = $row['historialLaboral'];
							
							
							echo "<tr class='filaResultado' id='".$idCandidato."' onclick='abrePerfil(this.id);'><td>".$nombre."</td><td>".$email."</td><td>".$conocimientos."</td><td>".$residencia."</td><td><ul>".$historialLaboral."</ul></td></tr>";

							$alt = $alt * -1;

					}
				}

					


			?>
			

		</tbody>
	</table>

</div>


</body>
</html>

