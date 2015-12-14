<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<?php $proyecto = $_GET['p']; ?>
	<script type="text/javascript">
	$filasActividades = 0;
	$filasSeguimientos = 0;
	$proyecto = <?php echo $proyecto; ?>;
	$(document).ready(function(){
		//alert($proyecto);

		$.ajax({
 			type: "POST",
 			url: "control.php",
 			data: { "funcion" : "recuperaProyecto", "proyecto": $proyecto },
 			success: function(data){
 				//console.log(data);
 				var obj = JSON.parse(data);
 				$("#lblCliente").html(obj.Proyecto[0].nombre_comercial);
 				$("#lblRS").html(obj.Proyecto[0].razon_social);
 				$("#lblFInicio").html(obj.Proyecto[0].fecha_alta);
 				$("#lblFCierreIdeal").html(obj.Proyecto[0].fecha_cierre_ideal);
 				$("#lblTitulo").html(obj.Proyecto[0].titulo);
 			}
 		});

		$.ajax({
 			type: "POST",
 			url: "control.php",
 			data: { "funcion" : "listaActividades", "proyecto": $proyecto },
 			success: function(data){
 			 	var obj = JSON.parse(data);
 			 	$cont = 0;
	 				
	 			while(obj[$cont]){
 					$("#tblActividades tbody").append('<tr><td></td><td><input type="date" value="'+obj[$cont].fecha+'"></td><td colspan="2"> <textarea>'+obj[$cont].act+'</textarea></td></tr>');
 					$cont++;
				}
 			}
 		});

 		$.ajax({
 			type: "POST",
 			url: "control.php",
 			data: { "funcion" : "listaSeguimientos", "proyecto": $proyecto },
 			success: function(data){
 				console.log(data);
 				var obj = JSON.parse(data);
 			 	$filasSeguimientos = 0;
	 				
	 			while(obj[$filasSeguimientos]){
 					$("#tblSeguimientos tbody").append('<tr id="filaSeg_'+$filasSeguimientos+'"><td><input type="hidden" class="registroSeguimientos" id="numeroFilaSeg" value="'+$filasSeguimientos+'"></td><td><input type="date" id="fechaSeg_'+$filasSeguimientos+'" value="'+obj[$filasSeguimientos].fecha+'"> </td><td colspan="2"><textarea id="txtAreaSeg_'+$filasSeguimientos+'">'+obj[$filasSeguimientos].act+'</textarea></td><td><span class="btnAcepSeg" id="btnAcepSeg_'+$filasSeguimientos+'">[/]</span></td><td><span class="btnCancelSeg" id="btnCancelSeg_'+$filasSeguimientos+'">[X]</span></td></tr>');
 					$filasSeguimientos++;
				}
 				
 			}
 		});
	
		$("#guardaProyecto").click(function(){
	
			jsonActividades = [];
			jsonSeguimiento = [];
		
		    $(".registroActividades").each(function() {

		    	$fila = $(this).val();
		    	$fecha = $("#fecha_"+$fila).val();
		    	$actividad = $("#txtActividad_"+$fila).val();

		        item = {};
		     
		        item ["fecha"] = $fecha;
		        item ["act"] = $actividad;

		        jsonActividades.push(item);
		    });
		    
		    $(".registroSeguimientos").each(function() {

		    	$filaS = $(this).val();
		    	$fechaS = $("#fechaSeg_"+$filaS).val();
		    	$actividadS = $("#txtAreaSeg_"+$filaS).val();

		        itemS = {};
		     
		        itemS ["fecha"] = $fechaS;
		        itemS ["act"] = $actividadS;

		        jsonSeguimiento.push(itemS);
		    });
		    
		    jsonStringAct = JSON.stringify(jsonActividades);
		    jsonStringSeg = JSON.stringify(jsonSeguimiento);

		    console.log(jsonStringAct);
		    console.log(jsonStringSeg);

	 		$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "guardaRegistroActividades", "datos" : jsonStringAct, "proyecto" : $proyecto },
	 			success: function(data){
	 				 console.log(data);
	 			}
	 		}); 

	 		$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "guardaRegistroSeguimiento", "datos" : jsonStringSeg, "proyecto" : $proyecto },
	 			success: function(data){
	 				 console.log(data);
	 			}
	 		}); 

		});

		$("#btnMas").click(function(){
			$filasActividades ++;
			$("#tblActividades tbody").append('<tr id="fila_'+$filasActividades+'"><td><span class="btnMenos" id="btnMenos_'+$filasActividades+'">[-]</span><input type="hidden" class="registroActividades" id="numeroFila" value="'+$filasActividades+'"></td><td><input type="date" id="fecha_'+$filasActividades+'"></td><td colspan="2"> <textarea id="txtActividad_'+$filasActividades+'"></textarea></td></tr>');
		});

		$("#btnMasSeg").click(function(){
			$filasSeguimientos ++;
			$("#tblSeguimientos tbody").append('<tr id="filaSeg_'+$filasSeguimientos+'"><td><span class="btnMenosSeg" id="btnMenosSeg_'+$filasSeguimientos+'">[-]</span><input type="hidden" class="registroSeguimientos" id="numeroFilaSeg" value="'+$filasSeguimientos+'"></td><td><input type="date" id="fechaSeg_'+$filasSeguimientos+'"> </td><td colspan="2"><textarea id="txtAreaSeg_'+$filasSeguimientos+'"></textarea></td><td><span class="btnAcepSeg" id="btnAcepSeg_'+$filasSeguimientos+'">[/]</span></td><td><span class="btnCancelSeg" id="btnCancelSeg_'+$filasSeguimientos+'">[X]</span></td></tr>');
		});
		

		$(document).on('click','.btnMenos',function(){
			$elemento = this.id;
			$elementoSeparado = $elemento.split("_");
			$noFila = $elementoSeparado[1];
			$("#tblActividades tbody tr#fila_"+$noFila).remove();
		});

		$(document).on('click','.btnMenosSeg',function(){
			$elemento = this.id;
			$elementoSeparado = $elemento.split("_");
			$noFila = $elementoSeparado[1];
			$("#tblSeguimientos tbody tr#filaSeg_"+$noFila).remove();
		});


	}); // fin document ready

	</script>
</head>
<body>
<?php include_once("../header.htm"); ?>

<table> <!-- Cliente -->
	<tr>
		<td><b>Cliente:</b> <label id="lblCliente"></label> </td>
		<td><b>Razon Social:</b> <label id="lblRS"></label></td>
	</tr>
</table>
<table> <!-- Fecha Inicio -->
	<tr>
		<td><b>Fecha de Inicio: </b></td><td><label id="lblFInicio"></label></td>
	</tr>
</table>
<table> <!-- Fecha Cierre -->
	<tr>
		<td><b>Fecha de Cierre Ideal: </b></td><td><label id="lblFCierreIdeal"></label></td>
	</tr>
</table>
<br><br>

<b>Titulo de Proyecto: </b><label id="lblTitulo"></label>
<br><br>
<b>Estatus: </b>
<select class="formProyect" name="estatus">
	<option value="1">Nuevo Proyecto</option>
	<option value="2">En proceso</option>
	<option value="3">Cerrado en Garantia</option>
	<option value="4">Cerrrado Completo</option>
</select>
<br><br>
Proyecto Completado al: <span>0%</span>
<br><br>
<table border="1" id="tblActividades">
	<thead>
		<tr>
			<td></td><td>Registro de Actividades</td><td><span id="btnMas">[+]</span></td>
		</tr>
	</thead>
	<tbody>
		<!-- <tr id="fila_0">
			<td><span class="btnMenos" id="btnMenos_0">[-]</span></td><td> <input type="date" id="fecha_0"> </td><td colspan="2"> <textarea id="txtArea_0"></textarea> </td>
		</tr> -->
	</tbody>
</table>
<br><br>
<table border="1" id="tblSeguimientos">
	<thead>
		<tr>
			<td></td><td>Seguimiento</td><td><span id="btnMasSeg">[+]</span></td><td colspan="2"></td>
		</tr>
		
	</thead>
	<tbody>
		<!-- <tr id="filaSeg_0">
			<td><span class="btnMenosSeg" id="btnMenosSeg_0">[-]</span></td><td><input type="date" id="fechaSeg_0"> </td><td colspan="2"><textarea id="txtAreaSeg_0"></textarea></td><td><span class="btnAcepSeg" id="btnAcepSeg_0">[/]</span></td><td><span class="btnCancelSeg" id="btnCancelSeg_0">[X]</span></td>
		</tr> -->
	</tbody>
</table>
<br><br>
<input type="button" value="Guardar" id="guardaProyecto">
</body>
</html>