<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
		$facturacion = [];
		$contacto = [];
		$(document).ready(function(){
			$("li").removeClass( "current" )
			$("#menuProyectos").addClass('current');
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" :  "buscaClientes" },
	 			success: function(data){
	 				 // alert(data);
	 				var obj = JSON.parse(data);
	 				$cont = 0;
	 				
	 				while(obj[$cont]){
	 					//$arregloTabla[$cont] = obj.Cliente[$cont];
	 					$facturacion[obj[$cont].id] = obj[$cont].facturacion;
	 					$contacto[obj[$cont].id] = obj[$cont].datos_contacto;
	 					console.log($contacto);
	 					var cliente = JSON.parse(obj[$cont].datos_cliente);
	 					$("#listaClientes").append("<option value='"+obj[$cont].id+"'>"+cliente.publico+"</option>");
						$cont++;
	 				}
	 				
	 			}
	 		});

	 		$("#listaClientes").change(function(){
	 			//alert($("#listaClientes").val());
	 			$("#listaRS").html("");
	 			$("#listaContactos").html("");
	 			if ($("#listaClientes").val() > 0) {
	 				var fac = JSON.parse($facturacion[$("#listaClientes").val()]);
	 				var contacto = JSON.parse($contacto[$("#listaClientes").val()]);
	 				console.log(contacto);
	 				$cont = 0;
	 				while(fac[$cont]){
						if (fac[$cont].primario == 1) {$selected = "selected";} else {$selected = "";};
		 				$("#listaRS").append("<option value='"+fac[$cont].idfac+"' "+$selected+">"+fac[$cont].rs+"</option>");
		 				$cont++;
	 				}
	 				$cont = 0;
	 				while(contacto[$cont]){
		 				$("#listaContactos").append("<option value='"+contacto[$cont].idcontacto+"'>"+contacto[$cont].nombre+"</option>");
		 				
		 				$cont++;
	 				}

	 			};
					
			});

			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" :  "buscaKam" },
	 			success: function(data){
	 				 // alert(data);
	 				var obj = JSON.parse(data);
	 				console.log(obj);
	 				$cont = 0;
	 				
	 				while(obj[$cont]){
	 					//$arregloTabla[$cont] = obj.Cliente[$cont];
	 					//$facturacion[obj[$cont].id] = obj[$cont].facturacion;
	 					var kamDatos = JSON.parse(obj[$cont].datos);
	 					if (kamDatos.puesto.consultor == "1") {
	 						$("#txtkam").append("<option value='"+kamDatos.idColaborador+"'>"+kamDatos.nombrec+"</option>");
	 						$("#txtkam2").append("<option value='"+kamDatos.idColaborador+"'>"+kamDatos.nombrec+"</option>");
	 					}

	 					if (kamDatos.puesto.reclutador == "1") {
	 						$("#slcRec").append("<option value='"+kamDatos.idColaborador+"'>"+kamDatos.nombrec+"</option>");	
	 					}

	 					if (kamDatos.puesto.apoyo == "1") {
	 						$("#slcApoyo").append("<option value='"+kamDatos.idColaborador+"'>"+kamDatos.nombrec+"</option>");	
	 					}
	 					
						$cont++;
	 				}
	 				ordenarSelect('txtkam');
	 				ordenarSelect('txtkam2');
	 				ordenarSelect('slcRec');
	 				ordenarSelect('slcApoyo');
	 				
	 			}
	 		});

			$("#guardaProyecto").click(function(){
				dotosObligatorios();
				
			    
			});
			$("#slcAcuerdo").change(function(){
	 			if ($("#slcAcuerdo").val() != "otro") {
	 				$("#txtAcuerdo").attr("hidden",true);
					$("#txtAcuerdo").val($("#slcAcuerdo").val());
	 			}
	 			else{
	 				$("#txtAcuerdo").val("");
	 				$("#txtAcuerdo").attr("hidden",false);
	 			}
	 		});

	 		$("#slcHonorarios").change(function(){
	 			if ($("#slcHonorarios").val() != "otro" && $("#slcHonorarios").val() != "fijo" ) {
	 				$("#txtHonorarios").attr("hidden",true);
					$("#txtHonorarios").val($("#slcHonorarios").val());
	 			}
	 			else{
	 				$("#txtHonorarios").val("");
	 				$("#txtHonorarios").attr("hidden",false);
	 			}
	 		});
			
		}); // fin document ready
	function ordenarSelect(id_componente){
    	var selectToSort = jQuery('#' + id_componente);
    	var optionActual = selectToSort.val();
    	selectToSort.html(selectToSort.children('option').sort(function (a, b) {
    		return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;
      	})).val(optionActual);
    }
    function dotosObligatorios(){
    	if ($("#txtwbs").val() == "") {
    		alert("WBS no puede estar vacío");
    		return 0;
    	}
    	if ($("#txtkam").val() == "-1") {
    		alert("Selecciona un KAM");
    		return 0;
    	}
    	if ($("#listaClientes").val() == "-1") {
    		alert("Selecciona un Cliente");
    		return 0;
    	}
    	if ($("#listaRS").val() == null) {
    		alert("El cliente no tiene una razon social asociada");
    	}
    	if ($("#txtTituloProyecto").val() == "") {
    		alert("La posicion no puede estar vacía");
    		return 0;
    	}
    	if ($("#txtcta").val() == "") {
    		alert("No. de puestos no puede estar vacío");
    		return 0;
    	}
    	$nuevoValor = $("#txtValorProyecto").val().replace(/,/g, '');
    	
    	if (isNaN($nuevoValor)){
    		alert("Coloque un numero valido en Valor de Proyecto");
    		return 0;
    	} 
    	if($("#txtValorProyecto").val() == "") {
    		$("#txtValorProyecto").val("0");
    	}

    	
    	guardaDatos();
    	
    	
    	
    }
    function guardaDatos(){
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
			    $("#txtHonorarios").val($("#slcHonorarios").val());
			    $("#txtAcuerdo").val($("#slcAcuerdo").val());
			    $(".formProyectContrato").each(function() {
			        var name = $(this).attr("name");
			        var valor = $(this).val();
			        contrato[name] = valor;
			    }); 
			    
			    $("#txtXFacturar").val($("#txtValorProyecto").val());
			    $(".formProyectFacturacion").each(function() {
			        var name = $(this).attr("name");
			        var valor = $(this).val();
			        facturacion[name] = valor;
			    }); 


			    jsonStringGeneral = JSON.stringify(general);
			    jsonStringCliente = JSON.stringify(cliente);
			    jsonStringContrato = JSON.stringify(contrato);
			    jsonStringFacturacion = JSON.stringify(facturacion);
			   

			    $.ajax({
		 			type: "POST",
		 			url: "control.php",
		 			data: { "funcion" : "guardaProyecto", "general" : jsonStringGeneral, "cliente" : jsonStringCliente, "contrato" : jsonStringContrato, "facturacion" : jsonStringFacturacion },
		 			success: function(data){
		 				 console.log(data);
		 				 window.location="proyectos.php?p="+data;
		 			}
		 		});
    }

	</script>
	<style type="text/css"></style>
</head>
<body>
<?php include_once("../header.htm"); ?>
<div class="cuerpo">
	<table class="tblFormularios">
		<tr>
			<td><b>WBS*:</b></td><td><input type="text" class="formProyect" id="txtwbs" name="wbs"></td>
			<td><b>Empresa Interna:</b></td><td>
			<select id="txtEmpInt" type="text" value="" name="empint" class="formProyect">
				<option value="AIMS">AIMS</option>
				<option value="DMA">Diaz Morones y Asociados</option>
				<option value="SICSA">Servicios Industriales Contrata SA</option>
				<option value="SCO">Servicios Contrata</option>
				<option value="OCO">Outsourcing Contrata</option>
				<option value="LIASE">Liase</option>
				<option value="STONEHC">Stone Human Capital</option>
			</select></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td><b>KAM*:</b></td><td><select class="formProyect" id="txtkam" name="kam"><option value="-1"> - </option></select></td>
			<td><b>Reclutador:</b></td><td><select class="formProyect" id="slcRec" name="reclutador"><option value="-1"> N/A </option></select></td>
		</tr>
			
		<tr>
			<td><b>KAM 2:</b></td><td><select class="formProyect" id="txtkam2" name="kam2"><option value="-1"> - </option></select></td>
			<td><b>Apoyo:</b></td><td><select class="formProyect" id="slcApoyo" name="apoyo"><option value="-1"> N/A </option></select></td>
			
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td><b>Prioridad:</b></td><td><select class="formProyect" id="txtPrioridad" name="prioridad"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td><b>Cliente*:</b></td><td><select id="listaClientes" class="formProyectCliente" name="cliente"><option value="-1">-Selecciona un cliente-</option></select></td><td><b>Razon Social</b></td><td><select id="listaRS" class="formProyectCliente" name="razonS"><option>-Seleccione un Cliente-</option></select></td>
		</tr>
		<tr>
			<td><b>Contacto:</b></td><td><select id="listaContactos" class="formProyectCliente" name="contacto"><option value="-1">-Selecciona un contacto-</option></select></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td><b>Fecha de Inicio</b></td>
			<td><select class="formProyect" name="fIniY"><?php insertAniosActual(); ?></select>
			<select class="formProyect" name="fIniM"> <?php insertMesActual(); ?> </select>
			<select class="formProyect" name="fIniD"> <?php insertDiaActual(); ?> </select>
			</td>
			<td><b>Fecha de Cierre Ideal</b></td>
			<td><select class="formProyect" name="fCIdealY"> <?php insertAnioMasDos(); ?></select>
			<select class="formProyect" name="fCIdealM">
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
			<select class="formProyect" name="fCIdealD">
			<?php 
				//$numero = cal_days_in_month(CAL_GREGORIAN, 11, 2015); // 31
				$numero = 31;
				for ($dia=1; $dia <= $numero ; $dia++) { ?>
					<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
			<?php	
				}
			 ?>
			</select>
			</td>
			
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td><b>Posicion*:</b></td><td><input type="text" class="formProyect" id="txtTituloProyecto" name="posicion"></td><td><b>Disciplina:</b></td>
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
				</select>
			</td>
		</tr>
		<tr>
			<td><b># Puestos Req.*:</b></td><td> <input type="text" class="formProyect" id="txtcta" name="cta"></td>
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
			<td><b>Salario del Puesto:</b></td><td><input type="text" class="formProyect" id="txtsalario" name="salario"></td>
			<td><input type="hidden" class="formProyect" name="estatus" value="1"></td>
		</tr>
	</table>
	<table class="tblFormularios">
		<tr><td><h2>Datos del Contrato</h2></td></tr>
		<tr>
			<td><b>Convenio Firmado:</b></td>
			<td><select type="text" class="formProyectContrato" id="txtConvenio" name="convenio">
				<option value="no">No</option>
				<option value="si">Si</option>
				</select>
			</td>
		</tr>
		<tr><td><b>Garantia:</b></td>
			<td><select class="formProyectContrato" id="txtGarantia" name="garantia">
				<option value="60">60</option>
				<option value="90">90</option>
				<option value="120">120</option>
				<option value="150">150</option>
				<option value="180">180</option>
			</select>
			</td>
		</tr>
		<tr><td><b>Honorarios: </b></td>
			<td><select id="slcHonorarios">
				<option value="unMesNominal">1 Mes Nominal</option>
				<option value="unMesIntegradoNominal">1 mes integrado nominal</option>
				<option value="10">10%</option>
				<option value="12">12%</option>
				<option value="15">15%</option>
				<option value="20">20%</option>
				<option value="25">25%</option>
				<option value="fijo">Fijo</option>
				<option value="otro">Otro</option>
			</select>
			<input type="text" class="formProyectContrato" id="txtHonorarios" name="honorarios" hidden>
			</td>
		</tr>
		<tr><td><b>Acuerdo de Facturacion:</b></td>
		<td><select id="slcAcuerdo">
				<option value="opc3_7">30% 70%</option>
				<option value="opc3_3_4">30% 30% 40%</option>
				<option value="otro">Otro</option>
			</select>
			<input id="txtAcuerdo" type="text" class="formProyectContrato" name="acuerdofacturacion" hidden></td></tr>
		<tr><td>
			<input type="hidden" class="formProyectContrato" name="fGarantiaY" value="0000">
			<input type="hidden" class="formProyectContrato" name="fGarantiaM" value="00">
			<input type="hidden" class="formProyectContrato" name="fGarantiaD" value="00">
			<input type="hidden" class="formProyectContrato" name="garantiaMedioTiempo" value="0">
			<input type="hidden" class="formProyectContrato" name="garantia5Dias" value="0">
			</td>
		</tr>
		<tr><td><h2>Facturacion</h2></td></tr>
		<tr><td><b>Valor del Proyecto:</b></td><td><input type="text" class="formProyectFacturacion" id="txtValorProyecto" name="valorproyecto"></td></tr>
		<tr><td><input type="button" value="Guardar" id="guardaProyecto"></td></tr>
	</table>
	
		
	<input type="hidden" class="formProyectFacturacion" id="txtTotalFacturado" name="totalfacturado" value="0">
		
	<input type="hidden" class="formProyectFacturacion" id="txtPorcFacturado" name="porcfacturado" value="0">
		
	<input type="hidden" class="formProyectFacturacion" id="txtXFacturar" name="xfacturar" value="0">

	<input type="hidden" id="n1" name="facno1" class="formProyectFacturacion">
	<input type="hidden" id="monto1" name="monto1" class="formProyectFacturacion">
	<input type="hidden" id="fEnvio1" name="fenvio1" class="formProyectFacturacion">
	<input type="hidden" id="fPago1" name="fpago1" class="formProyectFacturacion">

	<input type="hidden" id="n2" name="facno2" class="formProyectFacturacion">
	<input type="hidden" id="monto2" name="monto2" class="formProyectFacturacion">
	<input type="hidden" id="fEnvio2" name="fenvio2" class="formProyectFacturacion">
	<input type="hidden" id="fPago2" name="fpago2" class="formProyectFacturacion">

	<input type="hidden" id="n3" name="facno3" class="formProyectFacturacion">
	<input type="hidden" id="monto3" name="monto3" class="formProyectFacturacion">
	<input type="hidden" id="fEnvio3" name="fenvio3" class="formProyectFacturacion">
	<input type="hidden" id="fPago3" name="fpago3" class="formProyectFacturacion">
		

</div>
</body>
</html>
<?php
	function insertAniosActual(){
		?><option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
		<?php 
			$anio = date('Y');
			for ($anio=date('Y')-1; $anio > 1986 ; $anio--) { 
		?>
				<option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
		<?php
			}
		 ?>
		<option value="1986">1986</option><?php
	}
	function insertMesActual(){
		$mesActual = date('m'); ?>
		<option <?php if($mesActual=="01"){echo "selected";} ?> value="01">Enero</option>
		<option <?php if($mesActual=="02"){echo "selected";} ?> value="02">Febrero</option>
		<option <?php if($mesActual=="03"){echo "selected";} ?> value="03">marzo</option>
		<option <?php if($mesActual=="04"){echo "selected";} ?> value="04">abril</option>
		<option <?php if($mesActual=="05"){echo "selected";} ?> value="05">Mayo</option>
		<option <?php if($mesActual=="06"){echo "selected";} ?> value="06">Junio</option>
		<option <?php if($mesActual=="07"){echo "selected";} ?> value="07">Julio</option>
		<option <?php if($mesActual=="08"){echo "selected";} ?> value="08">Agosto</option>
		<option <?php if($mesActual=="09"){echo "selected";} ?> value="09">Septiembre</option>
		<option <?php if($mesActual=="10"){echo "selected";} ?> value="10">Octubre</option>
		<option <?php if($mesActual=="11"){echo "selected";} ?> value="11">Noviembre</option>
		<option <?php if($mesActual=="12"){echo "selected";} ?> value="12">Diciembre</option>
		<?php
	}

	function insertDiaActual(){
		$diaActual = date("j");
		
		$numero = cal_days_in_month(CAL_GREGORIAN, 11, 2015); // 31
		for ($dia=1; $dia <= $numero ; $dia++) { ?>
			<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>" <?php if ($diaActual == $dia) {echo "selected";} ?>><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
		<?php	
			}
	}

	function insertAnioMasDos(){
		?>
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
		<?php
	}
		
	function insertDia_X_Mes(){
		$numero = cal_days_in_month(CAL_GREGORIAN, 11, 2015); // 31
		for ($dia=1; $dia <= $numero ; $dia++) { ?>
			<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
	<?php	
		}
	
	}
?>