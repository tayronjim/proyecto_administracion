<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
		$preWBS = "";
		$facturacion = [];
		$contacto = [];
		$cliente = [];
		$metodosDeContacto = JSON.parse('{"1":"Telefono Movil", "2":"Telefono Trabajo", "3":"e-Mail", "4":"linkedin", "5":"ubicacion"}');
		
		$clienteActivo = 0;
		$(document).ready(function(){
			$("li").removeClass( "current" )
			$("#menuProyectos").addClass('current');
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "buscaClientes" },
	 			success: function(data){
	 				 // alert(data);
	 				var obj = JSON.parse(data);
	 				console.log(obj);
	 				$cont = 0;
	 				$alt = -1;
	 				while(obj[$cont]){
	 					//$arregloTabla[$cont] = obj.Cliente[$cont];
	 					$facturacion[obj[$cont].id] = JSON.parse(obj[$cont].facturacion);
	 					$contacto[obj[$cont].id] = JSON.parse(obj[$cont].datos_contacto);
	 					
	 					$cliente[obj[$cont].id] = JSON.parse(obj[$cont].datos_cliente);
	 					$datosCliente = JSON.parse(obj[$cont].datos_cliente);
	 					//$("#listaClientes").append("<option value='"+obj[$cont].id+"'>"+$datosCliente.publico+"</option>");
	 					$fac = $facturacion[obj[$cont].id];
	 					if($fac.length === 0){
	 						if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
		 					$("#tblClientes tbody").append("<tr "+$claseAlt+" onclick='selectCliente("+obj[$cont].id+",-1)'><td class='colCliente'>"+$datosCliente.publico+"</td><td class='colRS'></td></tr>");
							$alt = $alt * -1;
	 					}else
	 					$.each($fac,function(key,value){
							if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
		 					$("#tblClientes tbody").append("<tr "+$claseAlt+" onclick='selectCliente("+obj[$cont].id+","+value.idfac+")'><td class='colCliente'>"+$datosCliente.publico+"</td><td class='colRS'>"+value.rs+"</td></tr>");
							$alt = $alt * -1;
	 					});
	 					
						$cont++;
	 				}
	 				$("#tblClientes tbody > tr").hide();
	 				
	 			}
	 		});

	 		

	 	// 	$("#listaClientes").change(function(){
	 	// 		//alert($("#listaClientes").val());
	 	// 		$("#listaRS").html("");
	 	// 		$("#listaContactos").html("");
	 	// 		if ($("#listaClientes").val() > 0) {
	 	// 			var fac = JSON.parse($facturacion[$("#listaClientes").val()]);
	 	// 			var contacto = JSON.parse($contacto[$("#listaClientes").val()]);
	 				
	 	// 			$cont = 0;
	 	// 			while(fac[$cont]){
			// 			if (fac[$cont].primario == 1) {$selected = "selected";} else {$selected = "";};
		 // 				$("#listaRS").append("<option value='"+fac[$cont].idfac+"' "+$selected+">"+fac[$cont].rs+"</option>");
		 // 				$cont++;
	 	// 			}
	 	// 			$cont = 0;
	 	// 			while(contacto[$cont]){
		 // 				$("#listaContactos").append("<option value='"+contacto[$cont].idcontacto+"'>"+contacto[$cont].nombre+"</option>");
		 				
		 // 				$cont++;
	 	// 			}

	 	// 		};
					
			// });

			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" :  "buscaUltimoID" },
	 			success: function(data){
	 				 $fecha = new Date();
	 				 $anio = $fecha.getFullYear();
	 				 $preWBS = $anio+"-"+(parseInt(data.replace(/"/g, ''))+1);
	 				 
	 				
	 				
	 			}
	 		});

			

			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" :  "buscaKam" },
	 			success: function(data){
	 				 // alert(data);
	 				var obj = JSON.parse(data);
	 				
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
				$kam = $("#txtkam option:selected").html().substring(0, 2).toUpperCase();
				
			    $("#txtwbs").val( $preWBS + $kam );
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

	 		$("#despliegaSalario").click(function(){
				$("#contenidoSalario").slideToggle("slow");
			});
			$("#contenidoSalario").css("display","none");

			$("#plecaBusquedaCliente").click(function(){
				$("#contenidoBusquedaCliente").slideToggle('slow');
			});

			$("#plecaMuestraContactos").click(function(){
				$("#contenidoContactos").toggle("slow");
			});
			$("#contenidoContactos").css("display","none");
			


			
		}); // fin document ready

	function selectCliente($idCliente,$idFac){
		
		console.log($facturacion[$idCliente][$idFac]);
		console.log($contacto[$idCliente]);
		console.log($cliente[$idCliente]);

		$clienteActivo = $idCliente;

		$datoFac = $facturacion[$idCliente][$idFac];
		$datoContacto = $contacto[$idCliente];
		$datoCliente = $cliente[$idCliente];


		$("#lblCliente").html($datoCliente.publico);
		$("#hdnCliente").val($idCliente);
		
		$("#hdnDatoFiscal").val($datoFac.idfac);
		if ($idFac == -1) {$("#lblDatosFiscales").html("Sin Datos Fiscales");}
		else{
			$("#lblDatosFiscales").html($datoFac.rs+"<br>"+$datoFac.rfc);
			
		}

		$("#contenidoBusquedaCliente").hide();
		$("#tblContactos").html();
		$.each($datoContacto, function($key, $value){
			$("#tblContactos").append("<tr id='"+$value.idcontacto+"'><td>"+$value.nombre+"</td><td>"+$value.area+"</td><td>(ver mas)</td><td><input type='button' value='Principal' onclick='seleccionaContacto("+$key+")'></td></tr>");
		});
			
		
	}
	function seleccionaContacto($key){
		$datoContacto = $contacto[$clienteActivo][$key];
		console.log($datoContacto);
		$("#lblContacto").html("");
		$("#lblContacto").append("<table border='0' style=' border-spacing: 0px;'><tr><td style='border-right:1px solid white; text-align: right;'>Nombre</td><td style='text-align: left;'>"+$datoContacto.nombre +"</td></tr><tr><td style='border-right:1px solid white; text-align: right;'>Área/Puesto</td><td style='text-align: left;'>"+$datoContacto.area +"</td></tr>");

		$.each($datoContacto.medioDeContacto, function($key, $value){
			$("#lblContacto").append("<tr><td style='border-right:1px solid white; text-align: right;'>"+$metodosDeContacto[$value.tipoContacto]+"</td><td style='text-align: left;'>"+ $value.valorContacto +"</td></tr>");
		});
		$("#lblContacto").append("</table>");
		


			
		$("#hdnContacto").val($datoContacto.idcontacto);
	}

	function ordenarSelect(id_componente){
    	var selectToSort = jQuery('#' + id_componente);
    	var optionActual = selectToSort.val();
    	selectToSort.html(selectToSort.children('option').sort(function (a, b) {
    		return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;
      	})).val(optionActual);
    }

    function dotosObligatorios(){
    	
    	if ($("#txtkam").val() == "-1") {
    		alert("Selecciona un KAM");
    		return 0;
    	}
    	if ($("#hdnCliente").val() == "-1") {
    		alert("Selecciona un Cliente");
    		return 0;
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
			    contrato = {};2
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
    function calculaValorProyecto(){
    	$salarioBase = parseFloat($("#txtSalario").val().replace(/,/g, ''));
		$bono = $salarioBase*parseFloat($("#txtBono").val());
		$vacaciones = parseFloat($("#txtVacaciones").val());
		$primaVacacional = parseFloat($("#txtPrimaVacacional").val())/100;
		$aguinaldo = $salarioBase/30*parseFloat($("#txtAguinaldo").val());
		$prima = $salarioBase/30 * $vacaciones * $primaVacacional; 
		$("#txtValorProyecto").val(addCommas(parseFloat(($bono+$prima+$aguinaldo+($salarioBase*12))*(0.1)).toFixed(2)));
		$("#txtSalario").val(addCommas($salarioBase.toFixed(2)));
		$("#lblSalario").text(addCommas($salarioBase.toFixed(2)));
		 		
    }

    function addCommas(nStr){
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
	function filtraTabla(){
			$("#tblClientes tbody > tr").show();
			
 			if( $("#filtroCliente").val() != ""){
				$("#tblClientes tbody > tr:visible > td.colCliente:not(:contains-ci('" + $("#filtroCliente").val() + "'))").parent("tr").hide();
			}

			if( $("#filtroRS").val() != ""){
				$("#tblClientes tbody > tr:visible > td.colRS:not(:contains-ci('" + $("#filtroRS").val() + "'))").parent("tr").hide();
			}

			if( $("#filtroCliente").val() == "" && $("#filtroRS").val() == "" ){
				$("#tblClientes tbody > tr").hide();
			}
			
		}
		// jQuery expression for case-insensitive filter
		$.extend($.expr[":"], 
		{
		    "contains-ci": function(elem, i, match, array) 
			{
				return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
			}
		});

	</script>
	<style type="text/css">
		.tblFormularios td, .tblFormularios td  table td{
			vertical-align: top;
		}
		#despliegaSalario{
			margin-left: 30px;
			padding: 1px 0px;
			border:1px solid #999;
			width: 350px;
			position: relative;
			
			background-color: #fff;
			color:black;
		}
		#contenidoSalario{
			position: relative;
			padding-left: 50px;
			overflow: auto;
			z-index: 999;
			color:#fff;
			font-weight: bold;

		}
		fieldset{
			background-color: rgba(0,0,0,0.2);
			-webkit-box-shadow: 2px 2px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 2px 2px 5px 0px rgba(0,0,0,0.75);
			box-shadow: 2px 2px 5px 0px rgba(0,0,0,0.75);
		}
		fieldset legend{
			color: #fff;
			background-color: rgba(0,0,0,0.2);
			border: 2px groove threedface;
		}
		#lblContacto table tr td{
			 padding: 3px 9px 3px 9px; font-size: 12px;
		}
		
	</style>
</head>
<body>
<?php include_once("../header.htm"); ?>
<div class="cuerpo">
<table style="width: 100%;">
	<tr style="vertical-align: top;">
		<td style="width: 800px; min-width: 50%;">
			<fieldset><legend>Proyecto</legend>
				<table class="tblFormularios">
					<tr>
						<!--<td><b>WBS*:</b></td><td><input type="text" class="formProyect" id="txtwbs" name="wbs"></td>-->
						<td><b>Empresa Interna:</b></td>
						<td>
							<select id="txtEmpInt" type="text" value="" name="empint" class="formProyect">
								<option value="AIMS">AIMS</option>
								<option value="DMA">Diaz Morones y Asociados</option>
								<option value="SICSA">Servicios Industriales Contrata SA</option>
								<option value="SCO">Servicios Contrata</option>
								<option value="OCO">Outsourcing Contrata</option>
								<option value="LIASE">Liase</option>
								<option value="STONEHC">Stone Human Capital</option>
							</select>
						</td>
						<td><input type="hidden" class="formProyect" id="txtwbs" name="wbs"></td>
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
				</table>
				<table class="tblFormularios">
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
					</table>
			</fieldset>
		</td>
		<td>
			<fieldset style="min-height: 200px;"><legend>Cliente</legend>
				<div id="plecaBusquedaCliente" style="background-color: #FFDB58; width: 380px; height: 20px; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px;"><b>Busqueda Clientes</b> <i class="fa fa-angle-double-down fa-2x" style="float: right; top:-5px; position: relative;"></i></div>
					<div id="contenidoBusquedaCliente" hidden>
						<input type="text" id="filtroCliente" placeholder="Nombre Comercial" onkeyup="filtraTabla()"><input type="text" id="filtroRS" placeholder="Razon Social" onkeyup="filtraTabla()">
						<br><br>
						<div class="datagrid" style="max-height: 200px; max-width: 90%; overflow: auto;">
							<table id="tblClientes" border="1" style="">
								<thead>
									<tr>
										<th>Nombre Comercial</th><th>Razon Social</th>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot></tfoot>	
							</table>
						</div>
					</div>
						
				<table class="tblFormularios">
					<tr>
						<td><b>Cliente*:</b></td><td><div id="lblCliente" style="background-color: rgba(55,55,55,0.4); width: 200px;"></div><input name="cliente" id="hdnCliente" type="hidden" value="-1" class="formProyectCliente"><!-- <select id="listaClientes" class="formProyectCliente" name="cliente"><option value="-1">-Selecciona un cliente-</option></select> --></td>
					</tr>
					<tr>
						<td><b>Datos Fiscales:</b></td><td><div id="lblDatosFiscales" style="background-color: rgba(55,55,55,0.4); width: 200px;"></div><input name="razonS" id="hdnDatoFiscal" type="hidden" value="-1" class="formProyectCliente"><!-- <select id="listaRS" class="formProyectCliente" name="razonS"><option>-Seleccione un Cliente-</option></select> --></td>
					</tr>
				</table>
				<table style="width: 90%;">
					<tr>
						<td colspan="2">
							<div id="plecaMuestraContactos" style="background-color: #2d3091; width: 280px; height: 20px; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px;"><b>Mostrar Contactos</b> <i class="fa fa-angle-double-right fa-2x" style="float: right; top:-5px; position: relative;"></i></div>
							<div id="contenidoContactos" class="datagrid" hidden style="max-width: 90%;">
								<table id="tblContactos">
									<thead><th>Nombre</th><th>Area/Puesto</th><th></th><th></th></thead>
									<tbody></tbody>
								</table>
							</div>
						</td>
					</tr>
				</table>
				<table>
					<tr style="vertical-align: top;">
						<td><b>Contacto:</b></td><td><div id="lblContacto" style="background-color: rgba(55,55,55,0.4); width: auto;"></div><input name="contacto" id="hdnContacto" type="hidden" value="-1" class="formProyectCliente"><!-- <select id="listaContactos" class="formProyectCliente" name="contacto"><option value="-1">-Selecciona un contacto-</option></select> --></td>
					</tr>
				</table>
			</fieldset>
		</td>
	</tr>
	<tr style="vertical-align: top;">
		<td>
			<fieldset><legend>Posición</legend>
				<table class="tblFormularios">
			
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
							<input type="hidden" class="formProyect" name="estatus" value="1">
						</td>
						<td colspan="2">
							<div id="despliegaSalario"> <b> Salario Base: </b> $<label id="lblSalario"></label></div>
								<div id="contenidoSalario">
								 	<table border="0" class="datosSalario">

										<tr>
											<td><b>Salario Base:</b></td><td><input type="text" class="formProyect" id="txtSalario" onchange="calculaValorProyecto()" name="salario" value="1" style="width: 80px;"></td>
											
										</tr>
										<tr>
											<td>Aguinaldo (dias)</td><td><input type="text" class="formProyect" onchange="calculaValorProyecto()" id="txtAguinaldo" name="aguinaldo" value="1" style="width: 30px;"></td>
										</tr>
										<tr>
											<td>Vacaciones (dias)</td><td><input type="text" class="formProyect" onchange="calculaValorProyecto()" id="txtVacaciones" name="vacaciones" value="1" style="width: 30px;"></td>
										</tr>
										<tr>
											<td>Prima Vacacional</td><td><input type="text" class="formProyect" onchange="calculaValorProyecto()" id="txtPrimaVacacional" name="primavacacional" value="1" style="width: 30px;"><b>%</b></td>
										</tr>
										<tr>
											<td>Bono (Promedio Meses)</td><td><input type="text" class="formProyect" onchange="calculaValorProyecto()" id="txtBono" name="bono" value="1" style="width: 30px;"></td>
										</tr>
										<tr>
											<td>Fondo de Ahorro</td><td><select class="formProyect" id="slcFondoAhorro" name="fondo"><option value="no">NO</option><option value="si">SI</option></select></td>
										</tr>
										<tr>
											<td>Bales de Despensa</td><td><select class="formProyect" id="slcBales" name="bales"><option value="no">NO</option><option value="si">SI</option></select></td>
										</tr>
										<tr>
											<td>Seguro de G.M.M.:</td><td><select class="formProyect" id="slcSeguroGMM" name="sgmm"><option value="no">NO</option><option value="si">SI</option></select></td>
										</tr>
										<tr>
											<td>Seguro de Vida:</td><td><select class="formProyect" id="slcASeguroVida" name="segvida"><option value="no">NO</option><option value="si">SI</option></select></td>
										</tr>
										<tr>
											<td>Otros</td><td><textarea class="formProyect" id="txtOtraPrestacion" name="otraprestacion" rows="3"></textarea></td>
										</tr>
									
								</table>
						 		</div>
						 	
						
						</td>
						
						
					</tr>
					<tr>
						<td><h2>Facturacion</h2></td>
					</tr>
					<tr>
						<td>
							<b>Valor del Proyecto:</b></td><td><input type="text" class="formProyectFacturacion" id="txtValorProyecto" name="valorproyecto">
						</td>
					</tr>
				</table>
			</fieldset>
		</td>
		<td>
			<fieldset><legend>Contrato / Facturación</legend>
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
					
					
				</table>
			</fieldset>
				
		</td>
	</tr>
	
</table>
	
	<input type="button" value="Guardar" id="guardaProyecto">
			
				
	
		
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