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
		.header{
			width: 100%;
			height: 80px;
			border:1px solid black;
		}
		.menuleft{
			width: 200px;
			float: left;
			border:1px solid black;
		}
		.cuerpo{
			width: 80%;
			border: 1px solid black;
			float: left;
		}
	</style>
</head>
	
RAFAEL AGUILAR OLIVARES

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
	  
	  

	   $busqueda = busqueda($findName,$findRecidence,$findKnowed,$findJob,$findPuesto);
	  
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

function busqueda($nombre,$residencia,$conocimientos,$empresa,$puesto){

	$query = "SELECT `candidato`.IdCandidato, concat(`candidato`.Nombre,' ',`candidato`.ApPaterno,' ',`candidato`.ApMaterno) as nombre, `candidato`.eMail, ";
	//$query .=	 "group_concat(DISTINCT '<li>',`candidato_estudios`.Institucion,' > ',`catestudio_grado`.Descripcion,'</li>') as estudios, ";
	$query .=	 "`candidato_extras`.Descripcion as extras, `candidato_generales`.*, ";
	$query .=	 "group_concat(DISTINCT '<li>',`candidato_historial`.Empresa,' > ',`candidato_historial`.Puesto,'</li>') as historialLaboral ";
	$query .="FROM `candidato` ";
	//$query .=	 "INNER JOIN `candidato_estudios` ON `candidato`.IdCandidato = `candidato_estudios`.IdCandidato ";
	//$query .=	 "INNER JOIN `catestudio_grado` ON `candidato_estudios`.IdGradoEstudio = `catestudio_grado`.IdGrado ";
	$query .=	 "LEFT JOIN `candidato_extras` ON `candidato`.IdCandidato = `candidato_extras`.IdCandidato ";
	$query .=	 "INNER JOIN `candidato_generales` ON `candidato`.IdCandidato = `candidato_generales`.IdCandidato ";
	$query .=	 "LEFT JOIN `candidato_historial` ON `candidato_historial`.IdCandidato = `candidato`.IdCandidato ";
	$query .="WHERE ";
	$query .=	 $nombre;
	$query .=	 $residencia;
	//$query .=	 "Institucion LIKE '%u%' AND ";
	$query .=	 $conocimientos;
	$query .=	 $empresa;
	$query .=	 $puesto;
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
		Filtro:<br><br>
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
		<input type="submit" value="Buscar" id="btnBuscar">
		<br>
		<div style="border:1px solid black; padding-left:3px;">
			+ Texto Obligatorio (AND)<br>
			- Texto a Ignorar (NOT)<br>
			, Texto Optativo (OR)<br>
		</div>
	</div>
</form>

<div class="cuerpo">
<div id="check"></div>
	<table border="1">
		<thead>
			<tr>
				<td>Candidato</td>
				<td>eMail</td>
				<!-- <td>Instituto</td> -->
				<td>Conocimientos</td>
				<td>Residencia</td>
				<td>Historial Laboral</td>
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

				$tablaCandidato = checkBusqueda();
				if ($tablaCandidato) {
					while ($row = mysqli_fetch_assoc($tablaCandidato)) {
						
							$idCandidato = $row['IdCandidato'];
							$nombre = $row['nombre'];
							$email = $row['eMail'];
							//$estudios = $row['estudios'];
							$conocimientos = $row['extras'];
							$residencia = $row['Dir_Ciudad']." ".$row['Dir_Estado']." ".$row['Dir_Pais'];
							$historialLaboral = $row['historialLaboral'];
							
							echo "<tr id='".$idCandidato."' onclick='abrePerfil(this.id);'><td>".$nombre."</td><td>".$email."</td><td>".$conocimientos."</td><td>".$residencia."</td><td><ul>".$historialLaboral."</ul></td></tr>";

					}
				}

					


			?>
			

		</tbody>
	</table>

</div>


</body>
</html>

