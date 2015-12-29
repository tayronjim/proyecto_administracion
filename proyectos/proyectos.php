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

			$.ajax({ // Busca datos del proyecto
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "recuperaProyecto", "proyecto": $proyecto },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				var cliente = JSON.parse(obj.Cliente[0].datos_cliente);
	 				var rs = JSON.parse(obj.Cliente[0].facturacion);

	 				var datos_cliente = JSON.parse(obj.Proyecto[0].cliente);
	 				var datos_proyecto = JSON.parse(obj.Proyecto[0].datos_proyecto);
	 				var datos_contrato = JSON.parse(obj.Proyecto[0].contrato);
	 				var datos_facturacion = JSON.parse(obj.Proyecto[0].facturacion);

	 				$("#txtwbs").val(datos_proyecto.wbs);
	 				$("#txtcta").val(datos_proyecto.cta);
	 				$("#txtsem").val(datos_proyecto.sem);
	 				$("#txtCliente").val(cliente.publico);
	 				$.each(rs, function($key, $value){
	 					if ($value.idfac == datos_cliente.razonS) {$("#txtRS").val($value.rs);}
	 				});
	 				
	 				$("#fIniY").val(datos_proyecto.fIniY);
	 				$("#fIniM").val(datos_proyecto.fIniM);
	 				$("#fIniD").val(datos_proyecto.fIniD);
	 				
	 				$("#fCIdealY").val(datos_proyecto.fCIdealY);
	 				$("#fCIdealM").val(datos_proyecto.fCIdealM);
	 				$("#fCIdealD").val(datos_proyecto.fCIdealD);

	 				$("#txtPosicion").val(datos_proyecto.posicion);
	 				$("#txtKAM").val(datos_proyecto.kam);
	 				$("#txtPrioridad").val(datos_proyecto.prioridad);
	 				$("#txtSalario").val(datos_proyecto.salario);
	 				$("#txtConvenio").val(datos_contrato.convenio);
	 				$("#txtGarantia").val(datos_contrato.garantia);
	 				$("#txtHonorarios").val(datos_contrato.honorarios);
	 				$("#txtAcuerdo").val(datos_contrato.acuerdofacturacion);
	 				$("#fGarantiaY").val(datos_contrato.fGarantiaY);
	 				$("#fGarantiaM").val(datos_contrato.fGarantiaM);
	 				$("#fGarantiaD").val(datos_contrato.fGarantiaD);
	 				 
	 				$("#txtValorProyecto").val(datos_facturacion.valorproyecto);
	 				
	 			}
	 		});

			$.ajax({  // Carga registro Actividades / Seguimiento
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "listaActividades", "proyecto": $proyecto },
	 			success: function(data){
	 			 	var obj = JSON.parse(data);
	 			 	$.each( obj.actividad, function( filasActividades, actividad ) {
					  $("#tblActividades tbody").append('<tr><td><input type="hidden" class="registroActividades" id="numeroFila" value="'+$filasActividades+'"></td><td><input type="date" value="'+actividad.fecha+'" id="fecha_'+$filasActividades+'"></td><td colspan="2"> <textarea id="txtActividad_'+$filasActividades+'">'+actividad.act+'</textarea></td></tr>');
					});

					$.each( obj.seguimiento, function( filasSeguimientos, actividad ) {
					  $("#tblSeguimientos tbody").append('<tr id="filaSeg_'+$filasSeguimientos+'"><td><input type="hidden" class="registroSeguimientos" id="numeroFilaSeg" value="'+$filasSeguimientos+'"></td><td><input type="date" id="fechaSeg_'+$filasSeguimientos+'" value="'+actividad.fecha+'"> </td><td colspan="2"><textarea id="txtAreaSeg_'+$filasSeguimientos+'">'+actividad.act+'</textarea></td><td><span class="btnAcepSeg" id="btnAcepSeg_'+$filasSeguimientos+'">[/]</span></td><td><span class="btnCancelSeg" id="btnCancelSeg_'+$filasSeguimientos+'">[X]</span></td></tr>');
					});

	 		
	 			}
	 		});
		
			$("#guardaProyecto").click(function(){
		
				guardaProyecto();

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

			$(document).on('click','.btnAcepSeg',function(){
				$elemento = this.id;
				$elementoSeparado = $elemento.split("_");
				$noFila = $elementoSeparado[1];
				$("#actividadSeguimientoTerminado").val($("#txtAreaSeg_"+$noFila).val());
				$("#fechaSeguimientoTerminado").val($("#fechaSeg_"+$noFila).val());
				$("#filaSeguimientoTerminado").val($noFila);
			});

			$(document).on('click','.btnCancelSeg',function(){
				$elemento = this.id;
				$elementoSeparado = $elemento.split("_");
				$noFila = $elementoSeparado[1];
				$("#actividadSeguimientoCancelado").val($("#txtAreaSeg_"+$noFila).val());
				$("#fechaSeguimientoCancelado").val($("#fechaSeg_"+$noFila).val());
				$("#filaSeguimientoCancelado").val($noFila);
			});

			$(document).on('click','.btnCancelSeg',function(){
				$elemento = this.id;
				$elementoSeparado = $elemento.split("_");
				$noFila = $elementoSeparado[1];
				$fecha = $("#fechaSeg_" + $noFila).val();
				$act = $("#txtAreaSeg_" + $noFila).val();
			});
			

		}); // fin document ready

		function guardaProyecto(){
			general = {};
		    cliente = {};
		    contrato = {};
		    facturacion = {};

		    $(".formProyectCliente").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        cliente[name] = valor;
		    }); 
		    console.log(cliente);

		    $(".formProyect").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        general[name] = valor;
		    }); 
		    console.log(general);

		    $(".formProyectContrato").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        contrato[name] = valor;
		    }); 
		    console.log(contrato);

		    $(".formProyectFacturacion").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        facturacion[name] = valor;
		    }); 
		    console.log(facturacion);

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

		    jsonStringGeneral = JSON.stringify(general);
		    jsonStringCliente = JSON.stringify(cliente);
		    jsonStringContrato = JSON.stringify(contrato);
		    jsonStringFacturacion = JSON.stringify(facturacion);
		   

		    $.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "actualizaProyecto", "general" : jsonStringGeneral, "cliente" : jsonStringCliente, "contrato" : jsonStringContrato, "facturacion" : jsonStringFacturacion, "actividades":jsonStringAct , "seguimiento":jsonStringSeg, "proyecto":$proyecto},
	 			success: function(data){
	 				 console.log(data);
	 				 window.location="proyectos.php?p="+data;
	 			}
	 		});
	 		window.location="proyectos.php?p="+$proyecto;
		}

		function agregaSeguimientoTerminado(){

			$fecha = $("#fechaSeguimientoTerminado").val();
			$act = $("#actividadSeguimientoTerminado").val();
			$filaSeguimiento = $("#filaSeguimientoTerminado").val();

			$("#tblActividades tbody").append('<tr><td><input type="hidden" class="registroActividades" id="numeroFila" value="'+$filasActividades+'"></td><td><input type="date" value="'+$fecha+'" id="fecha_'+$filasActividades+'"></td><td colspan="2"> <textarea id="txtActividad_'+$filasActividades+'">'+$act+'</textarea></td></tr>');
			$filasActividades++;

			$("#tblSeguimientos tbody tr#filaSeg_"+$filaSeguimiento).remove();
					
	 		//guardaProyecto();
		}

		function eliminaSeguimientoCancelado(){

			$filaSeguimiento = $("#filaSeguimientoCancelado").val();
			$("#tblSeguimientos tbody tr#filaSeg_"+$filaSeguimiento).remove();
		}

		function cancelaSeguimientoTerminado(){
			$("#fechaSeguimientoTerminado").val("");
			$("#actividadSeguimientoTerminado").val("");
			$("#filaSeguimientoTerminado").val("");
		}

		function cancelaSeguimientoCancelado(){
			$("#actividadSeguimientoCancelado").val();
			$("#fechaSeguimientoCancelado").val();
			$("#filaSeguimientoCancelado").val();
		}
		

	</script>
	
	
</head>
<body>
<?php include_once("../header.htm"); ?>

<table>
	<tr>
		<td><b>WBS:</b> </td><td><input id="txtwbs" type="text" value="" name="wbs" class="formProyect"></td>
	</tr>
	<tr>
		<td><b>CTA:</b> </td><td><input id="txtcta" type="text" value="" name="cta" class="formProyect"></td>
	</tr>
	<tr>
		<td><b>SEM:</b> </td><td><input id="txtsem" type="text" value="" name="sem" class="formProyect"></td>
	</tr>
</table>

<table> <!-- Cliente -->
	<tr>
		<td><b>Cliente:</b> <input id="txtCliente" type="text" value="" name="cliente" class="formProyectCliente"> </td>
		<td><b>Razon Social:</b> <input id="txtRS" type="text" value="" name="razonS" class="formProyectCliente"></td>
	</tr>
</table>
<table> <!-- Fecha Inicio -->
	<tr>
		<td>Fecha de Inicio</td><td>

		<select class="formProyect" id="fIniY" name="fIniY">
			<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
			<?php 
				$anio = date('Y');
				for ($anio=date('Y')-1; $anio > 1986 ; $anio--) { 
			?>
					<option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
			<?php
				}
			 ?>
			<option value="1986">1986</option>
		</select>
		<?php 
			$mesActual = date('m');
		 ?>
		<select class="formProyect" id="fIniM" name="fIniM">
			<option value="01">Enero</option>
			<option value="02">Febrero</option>
			<option value="03">marzo</option>
			<option value="04">abril</option>
			<option value="05">Mayo</option>
			<option value="06">Junio</option>
			<option value="07">Julio</option>
			<option value="08">Agosto</option>
			<option value="09">Septiembre</option>
			<option value="10">Octubre</option>
			<option value="11">Noviembre</option>
			<option value="12">Diciembre</option>
		</select>

		<select class="formProyect" id="fIniD" name="fIniD">
		<?php 
			$diaActual = date("j");
			
			$numero = cal_days_in_month(CAL_GREGORIAN, 11, 2015); // 31
			for ($dia=1; $dia <= $numero ; $dia++) { ?>
				<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>" <?php if ($diaActual == $dia) {echo "selected";} ?>><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
		<?php	
			}
		 ?>
		</select>
		</td>
	</tr>
</table>
<table> <!-- Fecha Cierre Ideal -->
	<tr>
		<td>Fecha de Cierre Ideal</td><td>

		<select class="formProyect" id="fCIdealY" name="fCIdealY">
			<option value="<?php echo date('Y')+2; ?>"><?php echo date('Y')+2; ?></option>
			<?php 
				$anio = date('Y')+2;
				for ($anio=date('Y')+1; $anio > 1986 ; $anio--) { 
			?>
					<option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
			<?php
				}
			 ?>
			
			<option value="1986">1986</option>
		</select>
		<select class="formProyect" id="fCIdealM" name="fCIdealM">
			<option value="01">Enero</option>
			<option value="02">Febrero</option>
			<option value="03">marzo</option>
			<option value="04">abril</option>
			<option value="05">Mayo</option>
			<option value="06">Junio</option>
			<option value="07">Julio</option>
			<option value="08">Agosto</option>
			<option value="09">Septiembre</option>
			<option value="10">Octubre</option>
			<option value="11">Noviembre</option>
			<option value="12">Diciembre</option>
		</select>
		<select class="formProyect" id="fCIdealD" name="fCIdealD">
		<?php 
			$numero = cal_days_in_month(CAL_GREGORIAN, 11, 2015); // 31
			for ($dia=1; $dia <= $numero ; $dia++) { ?>
				<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
		<?php	
			}
		 ?>
		</select>
		</td>
	</tr>
</table>
<br><br>

<table>
	<tr>
		<td><b>Posición: </b></td><td><input type="text" id="txtPosicion" name="posicion" class="formProyect"></td>
	</tr>
	<tr>
		<td><b>KAM: </b></td><td><input type="text" id="txtKAM" name="kam" class="formProyect"></td>
	</tr>
	<tr>
		<td><b>Prioridad: </b></td><td><input type="text" id="txtPrioridad" name="prioridad" class="formProyect"></td>
	</tr>
	<tr>
		<td><b>Salario del Puesto: </b></td><td><input type="text" id="txtSalario" name="salario" class="formProyect"></td>
	</tr>
</table>


<table>
	<tr>
		<td>Estatus: </td>
		<td><select class="formProyect" name="estatus">
				<option value="1">Nuevo Proyecto</option>
				<option value="2">En proceso</option>
				<option value="3">Cerrado en Garantia</option>
				<option value="4">Cerrrado Completo</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><b>Proyecto Completado al: </b></td><td> <span>0%</span></td>
	</tr>
</table>

<br><br>


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
<br>


<h2>Datos del Contrato</h2>
<b>Convenio: </b> <inputtype="text" class="formProyectContrato" id="txtConvenio" name="convenio">
<br>
<b>Garantia: </b> <input type="text" class="formProyectContrato" id="txtGarantia" name="garantia">
<br>
<b>Honorarios: </b> <input type="text" class="formProyectContrato" id="txtHonorarios" name="honorarios">
<br>
<b>Acuerdo de Facturacion: </b> <input id="txtAcuerdo" type="text" class="formProyectContrato" name="acuerdofacturacion">
<br>

<table>
	<tr>
		<td><b>Fecha de Cierre de Garantia: </b></td><td>

		<select class="formProyectContrato" id="fGarantiaY" name="fGarantiaY">
			<option value="<?php echo date('Y')+2; ?>"><?php echo date('Y')+2; ?></option>
			<?php 
				$anio = date('Y')+2;
				for ($anio=date('Y')+1; $anio > 1986 ; $anio--) { 
			?>
					<option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
			<?php
				}
			 ?>
			
			<option value="1986">1986</option>
		</select>
		<select class="formProyectContrato" id="fGarantiaM" name="fGarantiaM">
			<option value="01">Enero</option>
			<option value="02">Febrero</option>
			<option value="03">marzo</option>
			<option value="04">abril</option>
			<option value="05">Mayo</option>
			<option value="06">Junio</option>
			<option value="07">Julio</option>
			<option value="08">Agosto</option>
			<option value="09">Septiembre</option>
			<option value="10">Octubre</option>
			<option value="11">Noviembre</option>
			<option value="12">Diciembre</option>
		</select>
		<select class="formProyectContrato" id="fGarantiaD" name="fGarantiaD">
		<?php 
			$numero = cal_days_in_month(CAL_GREGORIAN, 11, 2015); // 31
			for ($dia=1; $dia <= $numero ; $dia++) { ?>
				<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
		<?php	
			}
		 ?>
		</select>
		</td>
	</tr>
</table>
<br>

<h2>Facturacion</h2>
Valor del Proyecto: <input type="text" class="formProyectFacturacion" id="txtValorProyecto" name="valorproyecto">
<br>
Total Facturado:  <input type="text" class="formProyectFacturacion" id="txtTotalFacturado" name="totalfacturado">
<br>
% Facturado:  <input type="text" class="formProyectFacturacion" id="txtPorcFacturado" name="porcfacturado">
<br>
$ por Facturar:  <input type="text" class="formProyectFacturacion" id="txtXFacturar" name="xfacturar">
<br>
<table border="1">
	<tr>
		<td></td><td>No.</td><td>Monto</td><td>Fecha Envío</td><td>Fecha Pago</td>
	</tr>
	<tr>
		<td>Factura 1</td><td><input type="text" id="n1" name="facno1" class="formProyectFacturas"></td><td><input type="text" id="monto1" name="monto1" class="formProyectFacturas"></td><td><input type="text" id="fEnvio1" name="fenvio1" class="formProyectFacturas"></td><td><input type="text" id="fPago1" name="fpago1" class="formProyectFacturas"></td>
	</tr>
	<tr>
		<td>Factura 2</td><td><input type="text" id="n2" name="facno2" class="formProyectFacturas"></td><td><input type="text" id="monto2" name="monto2" class="formProyectFacturas"></td><td><input type="text" id="fEnvio2" name="fenvio2" class="formProyectFacturas"></td><td><input type="text" id="fPago2" name="fpago2" class="formProyectFacturas"></td>
	</tr>
	<tr>
		<td>Factura 3</td><td><input type="text" id="n3" name="facno3" class="formProyectFacturas"></td><td><input type="text" id="monto3" name="monto3" class="formProyectFacturas"></td><td><input type="text" id="fEnvio3" name="fenvio3" class="formProyectFacturas"></td><td><input type="text" id="fPago3" name="fpago3" class="formProyectFacturas"></td>
	</tr>
</table>
<br><br>
<input type="button" value="Guardar" id="guardaProyecto">

<div id="hideAceptaSegimiento" >
	<span>
		<table id="tblSegAceptado">
			<thead>
				<tr>
					<td>Fecha</td><td>Actividad</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="date" id="fechaSeguimientoTerminado"></td><td><textarea id="actividadSeguimientoTerminado"></textarea></td>
				</tr>
				<tr>
					<td><input type="hidden" id="filaSeguimientoTerminado"><input type="button" value="Cancelar" onclick="cancelaSeguimientoTerminado();"></td><td><input type="button" value="Aceptar" onclick="agregaSeguimientoTerminado();"></td>
				</tr>
			</tbody>
				
		</table>
	</span>
</div>

<div id="hideCancelaSegimiento" >
	<span>
		<table id="tblSegCancelado">
			<thead>
				<tr>
					<td>Fecha</td><td>Actividad</td><td>Observaciones</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="date" id="fechaSeguimientoCancelado"></td><td><textarea id="actividadSeguimientoCancelado"></textarea></td><td><textarea id="txtObservacionesSeguimientoCancelado"></textarea></td>
				</tr>
				<tr>
					<td><input type="hidden" id="filaSeguimientoCancelado"><input type="button" value="Cancelar" onclick="cancelaSeguimientoCancelado();"></td><td></td><td><input type="button" value="Aceptar" onclick="eliminaSeguimientoCancelado();"></td>
				</tr>
			</tbody>
				
		</table>
	</span>
</div>

</body>
</html>