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
	 				$("#txtEmpInt").val(datos_proyecto.empint);
	 				$("#txtcta").val(datos_proyecto.cta);
	 				$("#txtsem").val(datos_proyecto.sem);
	 				$("#txtCliente").val(cliente.publico);
	 				$("#hdnCliente").val(datos_cliente.cliente);
	 				$.each(rs, function($key, $value){
	 					if ($value.idfac == datos_cliente.razonS) {$("#txtRS").val($value.rs); $("#hdnRS").val(datos_cliente.razonS);}
	 				});
	 				
	 				$("#fIniY").val(datos_proyecto.fIniY);
	 				$("#fIniM").val(datos_proyecto.fIniM);
	 				$("#fIniD").val(datos_proyecto.fIniD);
	 				
	 				$("#fCIdealY").val(datos_proyecto.fCIdealY);
	 				$("#fCIdealM").val(datos_proyecto.fCIdealM);
	 				$("#fCIdealD").val(datos_proyecto.fCIdealD);

	 				$("#txtPosicion").val(datos_proyecto.posicion);
	 				$("#slcDisciplina").val(datos_proyecto.disciplina);
	 				
	 				$("#txtKAM").val(datos_proyecto.kam);
	 				$("#txtPrioridad").val(datos_proyecto.prioridad);
	 				$("#txtSalario").val(datos_proyecto.salario);
	 				$("#txtConvenio").val(datos_contrato.convenio);
	 				$("#slcNivel").val(datos_contrato.nivel);
	 				$("#txtGarantia").val(datos_contrato.garantia);
	 				$("#txtHonorarios").val(datos_contrato.honorarios);
	 				$("#txtAcuerdo").val(datos_contrato.acuerdofacturacion);
	 				$("#fGarantiaY").val(datos_contrato.fGarantiaY);
	 				$("#fGarantiaM").val(datos_contrato.fGarantiaM);
	 				$("#fGarantiaD").val(datos_contrato.fGarantiaD);
	 				 
	 				$("#txtValorProyecto").val(datos_facturacion.valorproyecto);
	 				$("#txtTotalFacturado").val(datos_facturacion.totalfacturado);
	 				$("#txtPorcFacturado").val(datos_facturacion.porcfacturado);
	 				$("#txtXFacturar").val(datos_facturacion.xfacturar);
	 				
	 				
 					$("#n1").val(datos_facturacion.lista.facno1);
	 				$("#monto1").val(datos_facturacion.lista.monto1);
	 				$("#fEnvio1").val(datos_facturacion.lista.fenvio1);
	 				$("#fPago1").val(datos_facturacion.lista.fpago1);
	 				
	 				$("#n2").val(datos_facturacion.lista.facno2);
	 				$("#monto2").val(datos_facturacion.lista.monto2);
	 				$("#fEnvio2").val(datos_facturacion.lista.fenvio2);
	 				$("#fPago2").val(datos_facturacion.lista.fpago2);

	 				$("#n3").val(datos_facturacion.lista.facno3);
	 				$("#monto3").val(datos_facturacion.lista.monto3);
	 				$("#fEnvio3").val(datos_facturacion.lista.fenvio3);
	 				$("#fPago3").val(datos_facturacion.lista.fpago3);
		 				
		 			$cont=0;
		 			while(obj.Estatus[$cont]){
						var estatus = JSON.parse(obj.Estatus[$cont].descripcion)
		 				$("#slcEstatus").append("<option value='"+estatus.id+"'>"+estatus.nombre+"</option>");
		 				$cont++;
		 			}
	 				$("#slcEstatus").val(datos_proyecto.estatus);
	 			}
	 		});

			$.ajax({  // Carga registro Actividades / Seguimiento
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "listaActividades", "proyecto": $proyecto },
	 			success: function(data){
	 			 	var obj = JSON.parse(data);
	 			 	$.each( obj.actividad, function( filasActividades, actividad ) {
					  $("#tblActividades tbody").append('<tr><td><input type="hidden" class="registroActividades" id="numeroFila" value="'+filasActividades+'"></td><td><input type="date" value="'+actividad.fecha+'" id="fecha_'+filasActividades+'" disabled></td><td colspan="1"> <textarea id="txtActividad_'+filasActividades+'" disabled>'+actividad.act+'</textarea></td><td></td></tr>');
					  $filasActividades = filasActividades;
					});
 					

					$.each( obj.seguimiento, function( filasSeguimientos, actividad ) {
					  $("#tblSeguimientos tbody").append('<tr id="filaSeg_'+filasSeguimientos+'"><td><input type="hidden" class="registroSeguimientos" id="numeroFilaSeg" value="'+filasSeguimientos+'"></td><td><input type="date" id="fechaSeg_'+filasSeguimientos+'" value="'+actividad.fecha+'" disabled> </td><td colspan="1"><textarea id="txtAreaSeg_'+filasSeguimientos+'" disabled>'+actividad.act+'</textarea></td><td><div class="btnAcepSeg" id="btnAcepSeg_'+filasSeguimientos+'"></div></td><td><div class="btnCancelSeg" id="btnCancelSeg_'+filasSeguimientos+'"></div></td><td></td></tr>');
					  $filasSeguimientos = filasSeguimientos;
					});
					

	 		
	 			}
	 		});
		
			$("#guardaProyecto").click(function(){

				guardaProyecto();
			});

			$("#btnMas").click(function(){
				$filasActividades ++;
				$("#tblActividades tbody").append('<tr id="fila_'+$filasActividades+'"><td><div class="btnMenos" id="btnMenos_'+$filasActividades+'"></div><input type="hidden" class="registroActividades" id="numeroFila" value="'+$filasActividades+'"></td><td><input type="date" id="fecha_'+$filasActividades+'"></td><td colspan="1"> <textarea id="txtActividad_'+$filasActividades+'"></textarea></td><td></td></tr>');
			});

			$("#btnMasSeg").click(function(){
				$filasSeguimientos ++;
				$("#tblSeguimientos tbody").append('<tr id="filaSeg_'+$filasSeguimientos+'"><td><div class="btnMenosSeg" id="btnMenosSeg_'+$filasSeguimientos+'"></div><input type="hidden" class="registroSeguimientos" id="numeroFilaSeg" value="'+$filasSeguimientos+'"></td><td><input type="date" id="fechaSeg_'+$filasSeguimientos+'"> </td><td colspan="1"><textarea id="txtAreaSeg_'+$filasSeguimientos+'"></textarea></td><td></td><td></td><td></td></tr>');
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
				$(".fondoEmergente").css("visibility","visible");
				$("#hideAceptaSegimiento").css("visibility","visible");
				 
			});

			$(document).on('click','.btnCancelSeg',function(){
				$elemento = this.id;
				$elementoSeparado = $elemento.split("_");
				$noFila = $elementoSeparado[1];
				$("#actividadSeguimientoCancelado").val($("#txtAreaSeg_"+$noFila).val());
				$("#fechaSeguimientoCancelado").val($("#fechaSeg_"+$noFila).val());
				$("#filaSeguimientoCancelado").val($noFila);
				$(".fondoEmergente").css("visibility","visible");
				$("#hideCancelaSegimiento").css("visibility","visible");
			});

			
			

		}); // fin document ready

		function guardaProyecto(){
			general = {};
		    cliente = {};
		    contrato = {};
		    facturacion = {};
		    listaFacturas = {};

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
		    	$actividad = $actividad.replace(/\n/g, "\\n");

		        item = {};
		     
		        item ["fecha"] = $fecha;
		        item ["act"] = $actividad;

		        jsonActividades.push(item);
		    });
		    
		    $(".registroSeguimientos").each(function() {

		    	$filaS = $(this).val();
		    	$fechaS = $("#fechaSeg_"+$filaS).val();
		    	$actividadS = $("#txtAreaSeg_"+$filaS).val();
		    	$actividadS = $actividadS.replace(/\n/g, "\\n");

		        itemS = {};
		        itemS ["fecha"] = $fechaS;
		        itemS ["act"] = $actividadS;
			
		        jsonSeguimiento.push(itemS);
		    });

		    $(".formProyectFacturas").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        listaFacturas[name] = valor;
		    }); 
		    facturacion['lista'] = listaFacturas;
		    console.log(facturacion);

		    
		    
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
	 				 window.location="proyectos.php?p="+$proyecto;
	 			}
	 		});
		}

		function agregaSeguimientoTerminado(){

			$fecha = $("#fechaSeguimientoTerminado").val();
			$act = $("#actividadSeguimientoTerminado").val();
			$filaSeguimiento = $("#filaSeguimientoTerminado").val();
			$filasActividades++;
			$("#tblActividades tbody").append('<tr><td><input type="hidden" class="registroActividades" id="numeroFila" value="'+$filasActividades+'"></td><td><input type="date" value="'+$fecha+'" id="fecha_'+$filasActividades+'"></td><td colspan="2"> <textarea id="txtActividad_'+$filasActividades+'">'+$act+'</textarea></td></tr>');
			

			$("#tblSeguimientos tbody tr#filaSeg_"+$filaSeguimiento).remove();
			$(".fondoEmergente").css("visibility","hidden");
			$("#hideAceptaSegimiento").css("visibility","hidden");
					
	 		//guardaProyecto();
		}

		function eliminaSeguimientoCancelado(){

			$filaSeguimiento = $("#filaSeguimientoCancelado").val();
			$("#tblSeguimientos tbody tr#filaSeg_"+$filaSeguimiento).remove();
			$(".fondoEmergente").css("visibility","hidden");
			$("#hideCancelaSegimiento").css("visibility","hidden");
		}

		function cancelaSeguimientoTerminado(){
			$("#fechaSeguimientoTerminado").val("");
			$("#actividadSeguimientoTerminado").val("");
			$("#filaSeguimientoTerminado").val("");
			$(".fondoEmergente").css("visibility","hidden");
			$("#hideAceptaSegimiento").css("visibility","hidden");

		}

		function cancelaSeguimientoCancelado(){
			$("#actividadSeguimientoCancelado").val();
			$("#fechaSeguimientoCancelado").val();
			$("#filaSeguimientoCancelado").val();
			$(".fondoEmergente").css("visibility","hidden");
			$("#hideCancelaSegimiento").css("visibility","hidden");
		}
		
	</script>
	<style type="text/css">
		#tblActividades textarea,#tblSeguimientos textarea{
			width: 300px;
			height: 60px;
		}
		#tblFacturas td{
			border-top: 1px solid #E1EEF4;
		}
		
		#hideAceptaSegimiento, #hideCancelaSegimiento{
			position: fixed;
			left: 50%;
			top: 50%;
			z-index: 999;
			background-color: white;
			color:#000;
			font-family: arial;
			padding: 10px;
			border:1px solid #fff;
			border-radius: 8px;
			visibility: hidden;
		}
		#hideAceptaSegimiento{
			margin-left: -233px;
			margin-top: -123px
		}
		#hideCancelaSegimiento{
			margin-left: -378px;
			margin-top: -123px
		}
		#hideAceptaSegimiento h2, #hideCancelaSegimiento h2{
			text-align: center;

		}
		#tblSegAceptado th, #tblSegCancelado th{
			
			font-weight: bolder;
			
			font-size: 13px;
			background-color: orange;
		}
		#tblSegAceptado textarea, #tblSegCancelado textarea{
			width: 280px;
			height: 90px;
		}
		#tblSegAceptado input[type="date"], #tblSegCancelado input[type="date"]{
			border:0px;
			margin-left: 30px;
		}
		.filaBotones{
			height: 50px;
			vertical-align: bottom;
		}
		.filaBotones input{
			border-radius: 3px;
			width: 90px;
			height: 30px;
			color: white;
			font-weight: bold;
		}
		#colCancSeg, #colCancCancSeg{
			text-align: left;
			
		}
		#colCancSeg input, #colCancCancSeg input{
			background-color: red;
			border:1px solid red;
			
		}
		#colAcepSeg, #colAcepCancSeg{
			text-align: right;
			
		}
		#colAcepSeg input, #colAcepCancSeg input{
			background-color: green;
			border:1px solid green;
		}
	</style>
	
</head>
<body>
<?php include_once("../header.htm"); ?>
<div class="cuerpo">
	<table class="tblFormularios">
		<tr>
			<td><b>WBS:</b> </td><td><input id="txtwbs" type="text" value="" name="wbs" class="formProyect" disabled></td><td><b>Empresa<br>Interna:</b> </td><td><input id="txtEmpInt" type="text" value="" name="empint" class="formProyect" disabled></td><td><b>Prioridad: </b></td><td><input type="text" id="txtPrioridad" name="prioridad" class="formProyect"></td>
		</tr>
		<TR>
			<td>.</td>
		</TR>
	
		<!-- <tr>
			<td><b>SEM:</b> </td><td><input id="txtsem" type="text" value="" name="sem" class="formProyect"></td>
		</tr> -->
	
		<tr>
			<td><b>Cliente:</b> <input id="hdnCliente" type="hidden" value="" name="cliente" class="formProyectCliente"> </td><td><input id="txtCliente" type="text" disabled></td><td><b>Razon Social:</b> <input id="hdnRS" type="hidden" value="" name="razonS" class="formProyectCliente"></td><td><input id="txtRS" type="text" disabled></td>
		</tr>
		

		<tr>
			<td>Fecha de Inicio</td><td>

			<select class="formProyect" id="fIniY" name="fIniY" disabled>
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
			<select class="formProyect" id="fIniM" name="fIniM" disabled>
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

			<select class="formProyect" id="fIniD" name="fIniD" disabled>
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

		<tr>
			<td><b>Posición: </b></td><td><input type="text" id="txtPosicion" name="posicion" class="formProyect"></td><td><b>Puestos Req.:</b> </td><td><input id="txtcta" type="text" value="" name="cta" class="formProyect"></td>
		</tr>
		<tr>
			<td><b>Disciplina: </b></td>
			<td><select type="text" id="slcDisciplina" name="disciplina" class="formProyect">
				<option value="-1">------</option>
				<option value="1">1- CALIDAD</option>
				<option value="2">2- DISTRIBUCIÓN-SUPPLY CHAIN</option>
				<option value="3">3- FINANZAS</option>
				<option value="4">4- INVESTIGACIÓN Y DESARROLLO</option>
				<option value="5">5- IT</option>
				<option value="6">6- MARKETING</option>
				<option value="7">7- OPERACIONES</option>
				<option value="8">8- RECURSOS HUMANOS</option>
				<option value="9">9- SERVICIO AL CLIENTE</option>
				<option value="10">10- VENTAS</option>
				<option value="11">11- OTRO</option>

			</select></td>
		</tr>
		<tr>
			<td><b>Nivel: </b></td>
			<td><select type="text" id="slcNivel" name="nivel" class="formProyect">
					<option value="1">1- C-LEVEL</option>
					<option value="2">2- ALTA DIRECCIÓN (SENIOR)</option>
					<option value="3">3- GERENCIAS (MIDDLE)</option>
					<option value="4">4- JEFATURAS (LOW)</option>
					<option value="5">5- TECNICAS</option>
					<option value="6">6- OTRO</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><b>KAM: </b></td><td><input type="text" id="txtKAM" name="kam" class="formProyect"></td>
		</tr>
		
		<tr>
			<td><b>Salario del Puesto: </b></td><td><input type="text" id="txtSalario" name="salario" class="formProyect"></td>
		</tr>
	
		<tr>
			<td><b>Estatus: </b></td>
			<td><select class="formProyect" name="estatus" id="slcEstatus">
					<option value="-1">-----</option>
					
				</select>
			</td>
		</tr>	
	</table>
	<br><br>
	<b>Proyecto Completado al: </b></td><td> <span>0%</span>



	<br><br>


	<br><br>
	<div class="datagrid">
		<table border="1" id="tblActividades" >
			<thead>
				<tr><th colspan="4" style="text-align: center; width:560px;">Registro de Actividades</th></tr>
				<tr>
					<th colspan="2" style="text-align: center; width:175px;">Fecha</th><th style="text-align: center; width:310px;">Actividad</th><th><div id="btnMas" class="btnMas"></div></th>
				</tr>
			</thead>
			<tbody>
				<!-- <tr id="fila_0">
					<td><span class="btnMenos" id="btnMenos_0">[-]</span></td><td> <input type="date" id="fecha_0"> </td><td colspan="2"> <textarea id="txtArea_0"></textarea> </td>
				</tr> -->
			</tbody>
		</table>
	</div>
	<br><br>
	<div class="datagrid">
		<table border="1" id="tblSeguimientos" >
			<thead>
				<tr><th colspan="6" style="text-align: center; width:560px;">Seguimiento</th></tr>
				<tr>
					<th colspan="2" style="text-align: center; width:175px;">Fecha</th><th style="text-align: center; width:310px;">Actividad</th><th colspan="2" style="width:65px;"></th><th><div id="btnMasSeg" class="btnMas"></div></th>
				</tr>
				
			</thead>
			<tbody>
				<!-- <tr id="filaSeg_0">
					<td><span class="btnMenosSeg" id="btnMenosSeg_0">[-]</span></td><td><input type="date" id="fechaSeg_0"> </td><td colspan="2"><textarea id="txtAreaSeg_0"></textarea></td><td><span class="btnAcepSeg" id="btnAcepSeg_0">[/]</span></td><td><span class="btnCancelSeg" id="btnCancelSeg_0">[X]</span></td>
				</tr> -->
			</tbody>
		</table>
	</div>
	<br>


	<h2>Datos del Contrato</h2>
	<table class="tblFormularios">
		<tr>
			<td><b>Convenio: </b> </td><td><input type="text" class="formProyectContrato" id="txtConvenio" name="convenio"></td>
		</tr>
		<tr>
			<td><b>Garantia: </b></td><td><input type="text" class="formProyectContrato" id="txtGarantia" name="garantia"></td>
		</tr>
		<tr>
			<td><b>Honorarios: </b></td><td> <input type="text" class="formProyectContrato" id="txtHonorarios" name="honorarios"></td>
		</tr>
		<tr>
			<td><b>Acuerdo de Facturacion: </b></td><td><input id="txtAcuerdo" type="text" class="formProyectContrato" name="acuerdofacturacion"></td>
		</tr>
	
		<tr>
			<td><b>Fecha de Cierre en Garantia: </b></td><td>

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
	<table class="tblFormularios" class="tblFormularios">
		<tr>
			<td><b>Valor del Proyecto:</b></td><td><input type="text" class="formProyectFacturacion" id="txtValorProyecto" name="valorproyecto"></td>
		</tr>
		<tr>
			<td><b>Total Facturado: </b></td><td><input type="text" class="formProyectFacturacion" id="txtTotalFacturado" name="totalfacturado"></td>
		</tr>
		<tr>
			<td><b>% Facturado: </b></td><td><input type="text" class="formProyectFacturacion" id="txtPorcFacturado" name="porcfacturado"></td>
		</tr>
		<tr>
			<td><b>$ por Facturar: </b></td><td> <input type="text" class="formProyectFacturacion" id="txtXFacturar" name="xfacturar"></td>
		</tr>
	</table>
	 
	
	<br>
	<div class="datagrid">
		<table border="1" id="tblFacturas"> <!-- Listado Pago de facturas -->
			<thead>
				<tr>
					<th></th><th>No.</th><th>Monto</th><th>Fecha Envío</th><th>Fecha Pago</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th style="background-color:#4D80E6; color:#fff;">Factura 1</th><td><input type="text" id="n1" name="facno1" class="formProyectFacturas"></td><td><input type="text" id="monto1" name="monto1" class="formProyectFacturas"></td><td><input type="text" id="fEnvio1" name="fenvio1" class="formProyectFacturas"></td><td><input type="text" id="fPago1" name="fpago1" class="formProyectFacturas"></td>
				</tr>
				<tr >
					<th style="background-color:#4D80E6; color:#fff;">Factura 2</th><td><input type="text" id="n2" name="facno2" class="formProyectFacturas"></td><td><input type="text" id="monto2" name="monto2" class="formProyectFacturas"></td><td><input type="text" id="fEnvio2" name="fenvio2" class="formProyectFacturas"></td><td><input type="text" id="fPago2" name="fpago2" class="formProyectFacturas"></td>
				</tr>
				<tr>
					<th style="background-color:#4D80E6; color:#fff;">Factura 3</th><td><input type="text" id="n3" name="facno3" class="formProyectFacturas"></td><td><input type="text" id="monto3" name="monto3" class="formProyectFacturas"></td><td><input type="text" id="fEnvio3" name="fenvio3" class="formProyectFacturas"></td><td><input type="text" id="fPago3" name="fpago3" class="formProyectFacturas"></td>
				</tr>
			</tbody>
				
		</table>
	</div>
		
	<br><br>
	<input type="button" value="Guardar" id="guardaProyecto">
	<br><br><br>
	<div class="fondoEmergente"></div>
	<div id="hideAceptaSegimiento" >
			<h2>Seguimiento Completado</h2>
			<table id="tblSegAceptado">
				<thead>
					
					<tr>
						<th width="170px">Fecha</th><th>Actividad</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="date" id="fechaSeguimientoTerminado" placeholder="aaaa-mm-dd"></td><td><textarea id="actividadSeguimientoTerminado"></textarea></td>
					</tr>
					<tr>
						<td class="filaBotones" id="colCancSeg"><input type="hidden" id="filaSeguimientoTerminado"><input type="button" value="Cancelar" onclick="cancelaSeguimientoTerminado();"></td><td class="filaBotones" id="colAcepSeg"><input type="button" value="Aceptar" class="agregaSeguimientoTerminado" onclick="agregaSeguimientoTerminado();"></td>
					</tr>
				</tbody>
					
			</table>
		
	</div>

	
</div>
<div id="hideCancelaSegimiento" >
		<span>
			<h2>Cancela Seguimiento</h2>
			<table id="tblSegCancelado">
				<thead>
					<tr>
						<th>Fecha</th><th>Actividad</th><th>Observaciones</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="date" id="fechaSeguimientoCancelado" disabled="true"></td><td><textarea id="actividadSeguimientoCancelado" disabled="true"></textarea></td><td><textarea id="txtObservacionesSeguimientoCancelado"></textarea></td>
					</tr>
					<tr>
						<td class="filaBotones" id="colCancCancSeg"><input type="hidden" id="filaSeguimientoCancelado"><input type="button" value="Cancelar" onclick="cancelaSeguimientoCancelado();"></td><td></td><td class="filaBotones" id="colAcepCancSeg"><input type="button" value="Aceptar" onclick="eliminaSeguimientoCancelado();"></td>
					</tr>
				</tbody>
					
			</table>
		</span>
	</div>
</body>
</html>