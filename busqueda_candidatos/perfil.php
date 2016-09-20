<!DOCTYPE html>
<html>
<head>
	<title>Perfil de Candidato</title>
	<script type="text/javascript" src="jquery-3.1.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
		});
	</script>
	<?php 

	include_once("conexion_db.php"); 

	$id = $_GET['id'];
	$query = "SELECT *, concat(`candidato`.Nombre,' ',`candidato`.ApPaterno,' ',`candidato`.ApMaterno) as nombre, ";
	$query .=	 "group_concat(DISTINCT '<li>',`candidato_estudios`.Institucion,' > ',`catestudio_grado`.Descripcion,' > ',(SELECT IF(`candidato_estudios`.IdEstudio2 = 0,`candidato_estudios`.DescrAlterna,`catestudio`.Descripcion)),'</li>') as estudios, ";
	$query .=	 "`candidato_extras`.Descripcion as extras, `candidato_generales`.*, ";
	$query .=	 "group_concat(DISTINCT '<li>Tel1: ',`candidato_generales`.Tel1,'</li>','<li>Tel2: ',`candidato_generales`.Tel2,'</li>','<li>Tel3: ',`candidato_generales`.Tel3,'</li>') as telefonos, ";
	$query .=	 "concat(candidato_generales.Dir_Ciudad,' ',candidato_generales.Dir_Estado) as recidencia, ";
	$query .=	 "group_concat(DISTINCT '<li>',`candidato_historial`.Empresa,' > ',`candidato_historial`.Puesto,'</li>') as historialLaboral, ";
	$query .=	 "group_concat(DISTINCT '<tr><td>',`candidato_idioma`.descripcion,'</td><td>',`candidato_idioma`.dominio,'</td></tr>') as idioma, ";
	$query .=	 "group_concat(DISTINCT '<tr><td>',(SELECT IF(`candidato_idiomas`.IdLengua=0,`candidato_idiomas`.DescrAlterna,`catlengua`.Descripcion)),'</td><td>Hablado:',`candidato_idiomas`.PorHablado,'/Escrito:',`candidato_idiomas`.PorHablado,'</td></tr>') as idiomas ";
	$query .="FROM `candidato` ";
	$query .=	 "LEFT JOIN `candidato_estudios` ON `candidato`.IdCandidato = `candidato_estudios`.IdCandidato ";
	$query .=	 "LEFT JOIN `catestudio_grado` ON `candidato_estudios`.IdGradoEstudio = `catestudio_grado`.IdGrado ";
	$query .=	 "LEFT JOIN `catestudio` ON `candidato_estudios`.IdEstudio2 = `catestudio`.IdEstudio2 ";
	$query .=	 "LEFT JOIN `candidato_extras` ON `candidato`.IdCandidato = `candidato_extras`.IdCandidato ";
	$query .=	 "LEFT JOIN `candidato_generales` ON `candidato`.IdCandidato = `candidato_generales`.IdCandidato ";
	$query .=	 "LEFT JOIN `candidato_historial` ON `candidato_historial`.IdCandidato = `candidato`.IdCandidato ";
	$query .=	 "LEFT JOIN `candidato_idioma` ON `candidato_idioma`.IdCandidato = `candidato`.IdCandidato ";
	$query .=	 "LEFT JOIN `candidato_idiomas` ON `candidato_idiomas`.IdCandidato = `candidato`.IdCandidato ";
	$query .=	 "LEFT JOIN `catlengua` ON `catlengua`.IdLengua = `candidato_idiomas`.IdLengua ";
	
	$query .="WHERE `candidato`.IdCandidato = ".$id." ";
	
	$query .="GROUP BY `candidato_estudios`.IdCandidato ";

	//echo $query;
	
	$connectdb = connectdb();
	
	$tablaCandidato = $connectdb->query($query);

	unconnectdb($connectdb);
	 ?>
	 <style type="text/css">
	 body{
	 	background-image: url("fondo-blanco-204663.jpg");
	 }
	 	#tblInfoCV td{
	 		padding: 6px;
	 		background-color: #EEEEEE;
	 	}
	 	#tblInfoCV .titulo{
	 		background-color: #DDD;
	 		font-weight: bold;
	 	}
	 </style>
</head>

<body>
	<?php $row = mysqli_fetch_assoc($tablaCandidato); ?>
	<table border="1" id="tblInfoCV">
		<tr>
			<td class="titulo">Nombre: </td><td><?php echo $row['nombre']; ?></td>
		</tr>
		<tr>
			<td class="titulo">eMail: </td><td><?php echo $row['eMail']; ?><br><?php echo $row['email2']; ?></td>
		</tr>
		<tr>
			<td class="titulo">Telefonos: </td><td><?php echo $row['telefonos']; ?></td>
		</tr>
		<tr>
			<td class="titulo">Linkedin: </td><td><?php echo $row['linkedin']; ?></td>
		</tr>
		<tr>
			<td class="titulo">Recidencia: </td><td><?php echo $row['recidencia']; ?></td>
		</tr>
		<tr>
			<td class="titulo">Sueldo deceado</td><td><?php echo $row['SueldoDes']; ?></td>
		</tr>
		<tr>
			<td class="titulo">Puesto Deceado: </td><td><?php echo $row['PuestoDes1']; ?><br><?php echo $row['PuestoDes2']; ?><br><?php echo $row['PuestoDes3']; ?></td>
		</tr>
		<tr>
			<td class="titulo">Estudios: </td><td><?php echo $row['estudios']; ?></td>
		</tr>
		<tr>
			<td colspan="2">
				<table border="1">
					<tr>
						<td class="titulo">Idioma</td><td class="titulo">Nivel</td>
					</tr>
					
						<?php echo $row['idioma']; ?>
						<?php echo $row['idiomas']; ?>
					
				</table>
			</td>
		</tr>
		<tr>
			<td class="titulo">historial laboral: </td><td><?php echo $row['historialLaboral']; ?></td>
		</tr>
		<tr>
			<td class="titulo">
				Descargar CV:
			</td>
			<td>
				<?php 
				$conn_id = ftp_connect('server325.com'); 
				$login_result = ftp_login($conn_id, 'buscador', 'Q!W"E#R$T%'); 

				if ((!$conn_id) || (!$login_result)) { 
				    echo "FTP connection has failed!";
				    exit; 
				}

				$files = ftp_nlist($conn_id, '/'.$id);
				$encontrado = 0;
				if ($files) {
					
					foreach ($files as $key => $value) {
						if ($value != "/".$id."/index.html" && $value != "/".$id."/." && $value != "/".$id."/..") {
							echo '<a href="http://www.diazmorones.com.mx/archivos/curriculum'.$value.'" target="_BLANK">Descargar</a>';
							$encontrado = 1;
							break;
						}
					}
					
				}
				if ($encontrado == 0) { echo "No Existe Archivo"; }
					
				ftp_close($conn_id);
				
				 ?>


			</td>
		</tr>
		

	</table>
			

</body>
</html>