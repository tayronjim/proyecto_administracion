<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<?php $proyecto = $_GET['p']; ?>
	<script type="text/javascript">
		$enGarantia = 0;
		$filasActividades = 0;
		$filasSeguimientos = 0;
		$contacto = [];
		$clienteActivo = 0;
		$metodosDeContacto = JSON.parse('{"1":"Telefono Movil", "2":"Telefono Trabajo", "3":"e-Mail", "4":"linkedin", "5":"ubicacion"}');
		$proyecto = <?php echo $proyecto; ?>;
		$(document).ready(function(){
			$("li").removeClass( "current" )
			$("#menuProyectos").addClass('current');

			

			$.ajax({ // Busca datos del proyecto
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "recuperaProyecto", "proyecto": $proyecto },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				
	 				var cliente = JSON.parse(obj.Cliente[0].datos_cliente);
	 				$contacto = JSON.parse(obj.Cliente[0].datos_contacto);
	 				var rs = JSON.parse(obj.Cliente[0].facturacion);

	 				console.log(cliente);

	 				var datos_cliente = JSON.parse(obj.Proyecto[0].cliente);
	 				var datos_proyecto = JSON.parse(obj.Proyecto[0].datos_proyecto);
	 				var datos_contrato = JSON.parse(obj.Proyecto[0].contrato);
	 				var datos_facturacion = JSON.parse(obj.Proyecto[0].facturacion);
	 				
	 				
	 					$("#txtwbs").val(datos_proyecto.wbs);
		 				$("#txtEmpInt").val(datos_proyecto.empint);
		 				$("#txtcta").val(datos_proyecto.cta);
		 				$("#txtsem").val(datos_proyecto.sem);
		 				$("#lblCliente").html(cliente.publico);
		 				
		 				$("#hdnCliente").val(datos_cliente.cliente);
		 				$clienteActivo = datos_cliente.cliente;

		 				$.each(rs, function($key, $value){
		 					if ($value.idfac == datos_cliente.razonS) {$("#lblDatosFiscales").html($value.rs+"<br>"+$value.rfc); $("#hdnDatoFiscal").val(datos_cliente.razonS);}
		 				});
		 				$cont = 0;
		 				
		 				console.log(datos_cliente);
		 				$("#hdnContacto").val(datos_cliente.contacto);
		 				$.each($contacto, function($key, $value){
		 					$("#tblContactos tbody").append("<tr id='cont_"+$value.idcontacto+"'><td>"+$value.nombre+"</td><td>"+$value.area+"</td><td>(ver mas)</td><td><input type='button' value='Principal' onclick='seleccionaContacto("+$key+")'></td></option>");
		 					if ($value.idcontacto == datos_cliente.contacto) {seleccionaContacto($key);}
		 				 });
		 				
		 				$("#fIniY").val(datos_proyecto.fIniY);
		 				$("#fIniM").val(datos_proyecto.fIniM);
		 				$("#fIniD").val(datos_proyecto.fIniD);
		 				
		 				$("#fCIdealY").val(datos_proyecto.fCIdealY);
		 				$("#fCIdealM").val(datos_proyecto.fCIdealM);
		 				$("#fCIdealD").val(datos_proyecto.fCIdealD);

		 				$("#fCRealY").val(datos_proyecto.fCRealY);
		 				$("#fCRealM").val(datos_proyecto.fCRealM);
		 				$("#fCRealD").val(datos_proyecto.fCRealD);

		 				$("#txtPosicion").val(datos_proyecto.posicion);
		 				$("#slcDisciplina").val(datos_proyecto.disciplina);
		 				$.ajax({
				 			type: "POST",
				 			url: "control.php",
				 			data: { "funcion" :  "buscaKam" },
				 			success: function(data){
				 				
				 				var obj = JSON.parse(data);
				 				$cont = 0;
				 				
				 				while(obj[$cont]){
			 					
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

				 				$("#txtkam").val(datos_proyecto.kam);
				 				$("#txtkam2").val(datos_proyecto.kam2);
		 				
				 			}
				 		});
		 				
		 				$("#txtPrioridad").val(datos_proyecto.prioridad);
		 				$("#txtSalario").val(datos_proyecto.salario);
		 				$("#lblSalario").html(datos_proyecto.salario);
		 				$("#txtAguinaldo").val(datos_proyecto.aguinaldo);
		 				$("#txtVacaciones").val(datos_proyecto.vacaciones);
		 				$("#txtPrimaVacacional").val(datos_proyecto.primavacacional);
		 				$("#txtBono").val(datos_proyecto.bono);
		 				$("#slcFondoAhorro").val(datos_proyecto.fondo);
		 				$("#slcBales").val(datos_proyecto.bales);
		 				$("#slcSeguroGMM").val(datos_proyecto.sgmm);
		 				$("#slcASeguroVida").val(datos_proyecto.segvida);
		 				$("#txtOtraPrestacion").val(datos_proyecto.otraprestacion);
		 				$("#chkAhorro").prop('checked',datos_proyecto.chkahorro);
		 				$("#chkBono").prop('checked',datos_proyecto.chkbono);
		 				$("#chkVales").prop('checked',datos_proyecto.chkvales);

		 				$("#nombreCandidato").val(datos_proyecto.nombrecandidato);
		 				$("#cumpleCandidato").val(datos_proyecto.cumplecandidato);


		 				$("#txtConvenio").val(datos_contrato.convenio);
		 				$("#slcNivel").val(datos_proyecto.nivel);
		 				$("#txtGarantia").val(datos_contrato.garantia);
		 				$("#txtHonorarios").val(datos_contrato.honorarios);
		 				if (datos_contrato.hdnhonorarios == "fijo" || datos_contrato.hdnhonorarios == "otro" ) {
		 					$("#slcHonorarios").val(datos_contrato.hdnhonorarios); $("#txtHonorarios").attr("hidden",false);
		 				}
		 				else{$("#slcHonorarios").val(datos_contrato.honorarios);$("#txtHonorarios").attr("hidden",true);}

		 				$("#slcAcuerdo").val(datos_contrato.acuerdo);
		 				$("#txtAcuerdo").val(datos_contrato.txtacuerdo);
		 				if (datos_contrato.acuerdo == "facOtro") {
		 					$("#txtAcuerdo").attr("hidden",false);
		 				}
		 				else{$("#txtAcuerdo").attr("hidden",true);}

		 				$("#obsContrato").val(datos_contrato.obscontrato);

		 			
		 				$("#fGarantiaY").val(datos_contrato.fGarantiaY);
		 				$("#fGarantiaM").val(datos_contrato.fGarantiaM);
		 				$("#fGarantiaD").val(datos_contrato.fGarantiaD);
		 				 
		 				$("#txtValorProyecto").val(addCommas(parseFloat(datos_facturacion.valorproyecto.replace(/,/g, '')).toFixed(2)));
		 				$("#txtTotalFacturado").val(addCommas(parseFloat(datos_facturacion.totalfacturado.replace(/,/g, '')).toFixed(2)));
		 				$("#txtPorcFacturado").val(parseFloat(datos_facturacion.porcfacturado).toFixed(2) + "%");
		 				$("#txtXFacturar").val(addCommas(parseFloat(datos_facturacion.xfacturar.replace(/,/g, '')).toFixed(2)));
		 				
		 			try{	
	 					$("#n1").val(datos_facturacion.lista.facno1);
		 				$("#monto1").val(addCommas(datos_facturacion.lista.monto1));
		 				$("#fEnvio1").val(datos_facturacion.lista.fenvio1);
		 				$("#fPago1").val(datos_facturacion.lista.fpago1);
		 				
		 				$("#n2").val(datos_facturacion.lista.facno2);
		 				$("#monto2").val(addCommas(datos_facturacion.lista.monto2));
		 				$("#fEnvio2").val(datos_facturacion.lista.fenvio2);
		 				$("#fPago2").val(datos_facturacion.lista.fpago2);

		 				$("#n3").val(datos_facturacion.lista.facno3);
		 				$("#monto3").val(addCommas(datos_facturacion.lista.monto3));
		 				$("#fEnvio3").val(datos_facturacion.lista.fenvio3);
		 				$("#fPago3").val(datos_facturacion.lista.fpago3);
		 			}catch(err){console.log(err.message);}
			 				
			 			$cont=0;
			 			while(obj.Estatus[$cont]){
							var estatus = JSON.parse(obj.Estatus[$cont].descripcion)
			 				$("#slcEstatus").append("<option value='"+estatus.id+"'>"+estatus.nombre+"</option>");
			 				if (estatus.id == datos_proyecto.estatus) {
			 					$("#avance").html(estatus.avance);
			 				}
			 				
			 				$cont++;
			 			}
		 				$("#slcEstatus").val(datos_proyecto.estatus);
		 				if (datos_proyecto.estatus == "8") {$enGarantia = 1;}

		 				muestraFechasXEstatus(datos_proyecto.estatus);
		 				calculaFechaGarantia(datos_contrato.garantia);

		 				$("#fIniY").val(datos_proyecto.fIniY);
		 				$("#fIniM").val(datos_proyecto.fIniM);
		 				$("#fIniD").val(datos_proyecto.fIniD);

		 				ms = Date.parse(datos_proyecto.fIniY + '-' +datos_proyecto.fIniM + '-' +datos_proyecto.fIniD);
		 				cr = Date.parse(datos_proyecto.fCRealY + '-' + datos_proyecto.fCRealM + '-' + datos_proyecto.fCRealD);
						fecha = new Date(ms);
						fechaCR = new Date(cr);
						fecha2 = new Date();
						if (datos_proyecto.estatus == "8" || datos_proyecto.estatus == "9" || datos_proyecto.estatus == "10" || datos_proyecto.estatus == "11" ) {
							var timeDiff = fechaCR.getTime() - fecha.getTime();
						}	
						else{
							var timeDiff = fecha2.getTime() - fecha.getTime();
						}						
						
						var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
						$("#diasTranscurridos").append('<b>'+diffDays+'</b>');

						if (datos_proyecto.estatus == "8") {
							
							$FG = datos_contrato.fGarantiaY+"-"+datos_contrato.fGarantiaM+"-"+datos_contrato.fGarantiaD;
							$fGarantia = Date.parse($FG);
							fecha2 = new Date($fGarantia);
							hoy2 = new Date();
							var timeDiff2 = fecha2.getTime() - hoy2.getTime();
							var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
							
							if (diffDays2 <= 0) {
								$("#garantiaTerminada").attr('hidden',false);
							}
							else{
								if (diffDays2 < 6) { 
									$("#garantia5Dias").attr('hidden',false);
									
								}else{
									if (diffDays2 < (parseInt(datos_contrato.garantia)/2)) {
										$("#garantiaMitad").attr('hidden',false);
									}
								}
							}	
						}
						
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
				dotosObligatorios();

				

				
			});

			$("#btnMas").click(function(){
				$filasActividades ++;
				$("#tblActividades tbody").append('<tr id="fila_'+$filasActividades+'"><td><div class="btnMenos" id="btnMenos_'+$filasActividades+'"></div><input type="hidden" class="registroActividades" id="numeroFila" value="'+$filasActividades+'"></td><td><input type="date" id="fecha_'+$filasActividades+'"></td><td colspan="1"> <textarea id="txtActividad_'+$filasActividades+'"></textarea></td><td></td></tr>');
			});

			$("#btnMasSeg").click(function(){
				$filasSeguimientos ++;
				agregaFilaSeguimiento($filasSeguimientos,"","");
				
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
			
			$("#monto1").change(function(){ 
	 			calculaTotalFacturado();
	 		});
	 		$("#monto2").change(function(){
	 			calculaTotalFacturado();
	 		});
	 		$("#monto3").change(function(){
	 			calculaTotalFacturado();
	 		});
	 		$("#txtValorProyecto").change(function(){
	 			calculaTotalFacturado();
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
	 			$("#hdnHonorarios").val($("#slcHonorarios").val());
	 			if ($("#slcHonorarios").val() != "otro" && $("#slcHonorarios").val() != "fijo" ) {
	 				$("#txtHonorarios").attr("hidden",true);
					$("#txtHonorarios").val($("#slcHonorarios").val());
	 			}
	 			else{
	 				$("#txtHonorarios").val("");
	 				$("#txtHonorarios").attr("hidden",false);
	 			}
	 		});
	 		$("#slcEstatus").change(function(){
	 			muestraFechasXEstatus($("#slcEstatus").val());
	 			if ($("#slcEstatus").val() == "8") {
	 				calculaFechaGarantia($("#txtGarantia").val());
	 			}
	 		});
	 		$("#txtGarantia").change(function(){
	 			calculaFechaGarantia($("#txtGarantia").val());
	 		});

	 		$(".despliegaSalario").click(function(){
				$("#contenidoSalario").slideToggle("slow");
			});
			$("#contenidoSalario").css("display","none");

			$("#plecaMuestraContactos").click(function(){
				$("#contenidoContactos").toggle("slow");
			});
			$("#contenidoContactos").css("display","none");

			$(".chkConcepto").click(function(){
				
				if ($(this).is(':checked')) {
					$("#" + $(this).attr('PAR')).prop( "disabled", false );
					
				}
				else{$("#" + $(this).attr('PAR')).prop( "disabled", true );}
		 		$(this).val($(this).prop('checked'));
				calculaValorProyecto();
			});

			$(".chkConcepto").each(function(){
				
		 		$(this).val($(this).prop('checked'));
				
			});


	 			
		}); // fin document ready

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

		function ordenarSelect(id_componente){
	    	var selectToSort = jQuery('#' + id_componente);
	    	var optionActual = selectToSort.val();
	    	selectToSort.html(selectToSort.children('option').sort(function (a, b) {
	    		if (a.value != "-1" && b.value != "-1") {
	    			return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;	
	    		}
	    		
	      	})).val(optionActual);
	    }

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
		   

		    $(".formProyect").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        general[name] = valor;
		    }); 
		   

		    $(".formProyectContrato").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        contrato[name] = valor;
		    }); 
		   

		    $(".formProyectFacturacion").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        facturacion[name] = valor;
		    }); 
		   

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
	 				
	 				 window.location="proyectos.php?p="+$proyecto;
	 			}
	 		});
	 		
		}

		function calculaTotalFacturado(){
			if (isNaN($("#txtValorProyecto").val().replace(/,/g, ''))) {$("#txtValorProyecto").val(0);}
			$monto1 = $("#monto1").val().replace(/,/g, '');
			$monto2 = $("#monto2").val().replace(/,/g, '');
			$monto3 = $("#monto3").val().replace(/,/g, '');
			if (isNaN($monto1.replace(/,/g, ''))) {alert("Debes introducir solo numeros en el campo Monto Factura 1");}
			if (isNaN($monto2.replace(/,/g, ''))) {alert("Debes introducir solo numeros en el campo Monto Factura 2");}
			if (isNaN($monto3.replace(/,/g, ''))) {alert("Debes introducir solo numeros en el campo Monto Factura 3");}

			if ($monto1 == "") {$monto1 = 0;}
			if ($monto2 == "") {$monto2 = 0;}
			if ($monto3 == "") {$monto3 = 0;}

			$valor = $("#txtValorProyecto").val().replace(/,/g, '');
			$totalFacturado = (parseFloat($monto1)+parseFloat($monto2)+parseFloat($monto3)).toFixed(2);
			$("#txtTotalFacturado").val(addCommas($totalFacturado));
			$porcFacturado = (($totalFacturado * 100) / $valor).toFixed(2);
			$("#txtPorcFacturado").val($porcFacturado + " %");
			$("#txtXFacturar").val(addCommas((parseFloat($("#txtValorProyecto").val().replace(/,/g, '')) - $totalFacturado).toFixed(2)));


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

		function muestraFechasXEstatus(estatus){
			switch(estatus){
				case '1':
				case '2':
				case '3':
				case '4':
				case '5':
				case '6':
				case '7': $(".FCR").attr('hidden',true); $(".FCG").attr('hidden',true); $(".candSelec").attr('hidden',true); break;
				case '8': $(".FCR").attr('hidden',false); $(".FCG").attr('hidden',false); $(".candSelec").attr('hidden',false); calculaFechaGarantia($("#txtGarantia").val()); break;
				case '9': $(".FCR").attr('hidden',false); $(".FCG").attr('hidden',true); $(".candSelec").attr('hidden',false); break;
				case '10': $(".FCR").attr('hidden',false); $(".FCG").attr('hidden',true); $(".candSelec").attr('hidden',true); break;
				case '11': $(".FCR").attr('hidden',false); $(".FCG").attr('hidden',true); $(".candSelec").attr('hidden',true); break;
				default: $(".FCR").attr('hidden',true); $(".FCG").attr('hidden',true); $(".candSelec").attr('hidden',true); break;
			}
		}

		function calculaFechaGarantia(dias){
			
	 		$FCR = Date.parse($("#fCRealY").val()+"-"+$("#fCRealM").val()+"-"+$("#fCRealD").val());
	 		fecha = new Date($FCR);
	 			
	 		tiempo = fecha.getTime();
		    //Calculamos los milisegundos sobre la fecha que hay que sumar o restar...
		    milisegundos=parseInt(dias*24*60*60*1000);
		    //Modificamos la fecha actual
		    total=fecha.setTime(tiempo+milisegundos);
	
		    day=fecha.getDate();
		    month=fecha.getMonth()+1;
		    year=fecha.getFullYear();
			//console.log(fecha);
		    $("#fGarantiaY").val(year);
		    $("#fGarantiaM").val(month);
		    $("#fGarantiaD").val(day);
		}

		function commaSeparateNumber(val){
			while (/(\d+)(\d{3})/.test(val.toString())){
			  val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			}
			return val;
		}

		function dotosObligatorios(){
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
	    	
	    	if ( $("#slcEstatus").val() == "8" || $("#slcEstatus").val() == "9" || $("#slcEstatus").val() == "10" || $("#slcEstatus").val() == "11" ) {
	    		if ($("#fCRealY").val() == null || $("#fCRealM").val() == null || $("#fCRealD").val() == null) {
	    			alert("La fecha de cierre real no puede estar vacía");
	    			return 0;
	    		}
	    	}

	    	if ($enGarantia == 0 && $("#slcEstatus").val() == "8") {
					var dias = $("#txtGarantia").val();
					$FCR = Date.parse($("#fCRealY").val()+"-"+$("#fCRealM").val()+"-"+$("#fCRealD").val());
			 		fecha = new Date($FCR);
			 			
			 		tiempo = fecha.getTime();

					milisegundos=parseInt((dias/2)*24*60*60*1000);
				    total=fecha.setTime(tiempo+milisegundos);
					$fechaMitad = fecha;

					milisegundos=parseInt((dias-5)*24*60*60*1000);
				    total=fecha.setTime(tiempo+milisegundos);
					$fechaA5Dias = fecha;

				    	
					$filasSeguimientos ++;
					agregaFilaSeguimiento($filasSeguimientos,$fechaMitad.getFullYear() + "-" + ("0" + ($fechaMitad.getMonth() + 1)).slice(-2) + "-" + ("0" + ($fechaMitad.getDate() + 1)).slice(-2),"Realizar actividades de mitad de tiempo de garantia");

					$filasSeguimientos ++;
					agregaFilaSeguimiento($filasSeguimientos,$fechaA5Dias.getFullYear() + "-" + ("0" + ($fechaMitad.getMonth() + 1)).slice(-2) + "-" + ("0" + ($fechaMitad.getDate() + 1)).slice(-2),"Realizar actividades de cinco dias para termino de garantia");

					guardaProyecto();
				}
				else{
					guardaProyecto();
				}
	    }
    	function agregaFilaSeguimiento($filasSeguimientos,$fecha,$actividad){
    		
    		$("#tblSeguimientos tbody").append('<tr id="filaSeg_'+$filasSeguimientos+'"><td><div class="btnMenosSeg" id="btnMenosSeg_'+$filasSeguimientos+'"></div><input type="hidden" class="registroSeguimientos" id="numeroFilaSeg" value="'+$filasSeguimientos+'"></td><td><input type="date" id="fechaSeg_'+$filasSeguimientos+'" value="'+$fecha+'"> </td><td colspan="1"><textarea id="txtAreaSeg_'+$filasSeguimientos+'">'+$actividad+'</textarea></td><td></td><td></td><td></td></tr>');
    	}

    	function calculaValorProyecto(){
	    	$salarioBase = parseFloat($("#txtSalario").val().replace(/,/g, ''));

	    	if ($("#chkVales").is(':checked')) { $vales = ($salarioBase*parseFloat($("#txtVales").val()))/100; }
	    	else{$vales = 0;}
	    	if ($("#chkAhorro").is(':checked')) { $ahorro = ($salarioBase*parseFloat($("#txtAhorro").val()))/100; }
	    	else{$ahorro = 0;}
	    	if ($("#chkBono").is(':checked')) { $bono = parseFloat($("#txtBono").val().replace(/,/g, '')); }
	    	else{$bono = 0;}
			
			$aguinaldo = ($salarioBase/30*parseFloat($("#txtAguinaldo").val()))/12;
			$vacaciones = parseFloat($("#txtVacaciones").val());
			$primaVacacional = parseFloat($("#txtPrimaVacacional").val())/100;
			$prima = ($salarioBase/30 * $vacaciones * $primaVacacional)/12; 
			$honorarios = parseFloat($("#slcHonorarios").val())/100;
			$mensual = $salarioBase + $vales + $ahorro + $aguinaldo + $prima + $bono;
			console.log($vales +" "+ $ahorro +" "+ $aguinaldo +" "+ $prima +" "+ $bono);
			$anual = $mensual*12;

			$subtotal = $anual * $honorarios;
			$total = $subtotal*1.16;

			
			
			$("#lblProyAprox").text(addCommas($total.toFixed(2)));
			
			$("#txtSalario").val(addCommas($salarioBase.toFixed(2)));
			$("#lblSalario").text(addCommas($salarioBase.toFixed(2)));

			calculaTotalFacturado();
			 		
	    }

	    function seleccionaContacto($key){
			console.log($contacto);
			if ($key > -1) {
				$datoContacto = $contacto[$key];
				
				$("#lblContacto").html("");
				$("#lblContacto").append("<table border='0' style=' border-spacing: 0px;'><tr><td style='border-right:1px solid white; text-align: right;'>Nombre</td><td style='text-align: left;'>"+$datoContacto.nombre +"</td></tr><tr><td style='border-right:1px solid white; text-align: right;'>Área/Puesto</td><td style='text-align: left;'>"+$datoContacto.area +"</td></tr>");

				$.each($datoContacto.medioDeContacto, function($key, $value){
					$("#lblContacto > table").append("<tr><td style='border-right:1px solid white; text-align: right;'>"+$metodosDeContacto[$value.tipoContacto]+"</td><td style='text-align: left;'>"+ $value.valorContacto +"</td></tr>");
				});
				$("#lblContacto").append("</table>");
				$("#hdnContacto").val($datoContacto.idcontacto);
			}
			else{
				$("#lblContacto").html("");
				$("#hdnContacto").val(-1);
			}
				
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
		.despliegaSalario{
			margin-left: 30px;
			padding: 1px 0px;
			border:1px solid #999;
			
			position: relative;
			
			background-color: #fff;
			color:black;
		}
		#contenidoSalario{
			position: relative;
			margin-left: 30px;
			padding-left: 20px;
			overflow: auto;
			z-index: 999;
			color:#fff;
			font-weight: bold;
			background-color: rgba(55,55,55,0.6);

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
			<td style="width: 800px; min-width: 50%;" >
				<fieldset><legend>Proyecto</legend>
					<table class="tblFormularios"> 
						<tr>
							<td><b>WBS:</b> </td><td><input id="txtwbs" type="text" value="" name="wbs" class="formProyect" disabled></td><td><b>Empresa Interna:</b> </td><td>
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
					<table>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td style="width: 125px;"><b>Fecha de Inicio</b></td>
							<td style="width: 220px;">
								<select class="formProyect" id="fIniY" name="fIniY" disabled><?php insertAniosActual(); ?></select>
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
								
									$numero = 31;
									for ($dia=1; $dia <= $numero ; $dia++) { ?>
										<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
								<?php	
									}
								 ?>
								</select>
							</td>
						
							<td style="width: 170px;"><b>Fecha de Cierre Ideal</b></td>
							<td>

							<select class="formProyect" id="fCIdealY" name="fCIdealY"><?php insertAnioMasDos(); ?></select>
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
								
								$numero = 31;
								for ($dia=1; $dia <= $numero ; $dia++) { ?>
									<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
							<?php	
								}
							 ?>
							</select>
							</td>
						</tr>
						<tr>
							<td colspan="2"></td><td class="FCR"><b>Fecha de Cierre Real</b></td>
							<td class="FCR">
							<select class="formProyect" id="fCRealY" name="fCRealY"><?php insertAnioMasDos(); ?></select>
							<select class="formProyect" id="fCRealM" name="fCRealM">
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
							<select class="formProyect" id="fCRealD" name="fCRealD">
							<?php 
								//$numero = cal_days_in_month(CAL_GREGORIAN, 11, 2015); // 31
								$numero = 31;
								for ($dia=1; $dia <= $numero ; $dia++) { ?>
									<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
							<?php	
								}
							 ?>
							</select></td>
						</tr>
					</table>
					<table>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td><b>Días transcurridos:</b></td><td><u><label id="diasTranscurridos"></label></u></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
					</table>
					<table>
						<tr>
							<td><b>Estatus: </b></td>
							<td><select class="formProyect" name="estatus" id="slcEstatus">
									<option value="-1">-----</option>
									
								</select>
							</td>
							<td class="candSelec"><b>Candidato Seleccionado: </b></td><td class="candSelec"><input type="text" placeholder="Nombre" id="nombreCandidato" name="nombrecandidato" style="width: 250px;"></td>
						</tr>
						<tr>
							<td colspan="2"></td><td class="candSelec"><b>Fecha de Cumpleaños: </b></td><td class="candSelec"><input type="date" id="cumpleCandidato" name="cumplecandidato"></td>
						</tr>	
					
					
					</table>
					<br><br>
					<b>Proyecto Completado al: </b><span id="avance">0%</span>
				</fieldset>
			</td>
			<td>
				<fieldset style="min-height: 200px;"><legend>Cliente</legend>
					
							
					<table class="tblFormularios" >
						<tr style="vertical-align: top;">
							<td><b>Cliente*:</b></td><td><div id="lblCliente" style="background-color: rgba(55,55,55,0.4); width: 200px;"></div><input name="cliente" id="hdnCliente" type="hidden" value="-1" class="formProyectCliente"></td>
						</tr>
						<tr style="vertical-align: top;">
							<td><b>Datos Fiscales:</b></td><td><div id="lblDatosFiscales" style="background-color: rgba(55,55,55,0.4); width: 200px;"></div><input name="razonS" id="hdnDatoFiscal" type="hidden" value="-1" class="formProyectCliente"></td>
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
							<td><b>Contacto:</b></td><td><div id="lblContacto" style="background-color: rgba(55,55,55,0.4); width: auto;"></div><input name="contacto" id="hdnContacto" type="hidden" value="-1" class="formProyectCliente"></td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
		<tr style="vertical-align: top;">
			<td>
				<fieldset><legend>Posición</legend>
					<table class="tblFormularios"> 
						<tr style="vertical-align: top;">
							<td><b>Posición: </b></td><td><input type="text" id="txtPosicion" name="posicion" class="formProyect"></td><td><b>Disciplina: </b></td>
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
						<tr style="vertical-align: top;">
							<td><b>Puestos Req.:</b> </td><td><input id="txtcta" type="text" value="" name="cta" class="formProyect"></td>
						</tr>
						<tr style="vertical-align: top;">
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
							<td colspan="2">
								<div class="despliegaSalario"> <b> Salario Base: </b> $<label id="lblSalario"></label></div>
									<div id="contenidoSalario">
									 	<table border="0" class="datosSalario">

											<tr>
												<td></td><td><b>Salario Base:<div style="float:right;">$</div></b></td><td><input type="text" class="formProyect" id="txtSalario" onchange="calculaValorProyecto()" name="salario" value="1" style="width: 80px;"></td>
												
											</tr>
											<tr>
												<td></td><td>Aguinaldo</td><td><input type="text" class="formProyect" onchange="calculaValorProyecto()" id="txtAguinaldo" name="aguinaldo" value="1" style="width: 30px;"> dias</td>
											</tr>
											<tr>
												<td></td><td>Vacaciones</td><td><input type="text" class="formProyect" onchange="calculaValorProyecto()" id="txtVacaciones" name="vacaciones" value="1" style="width: 30px;"> dias</td>
											</tr>
											<tr>
												<td></td><td>Prima Vacacional</td><td><input type="text" class="formProyect" onchange="calculaValorProyecto()" id="txtPrimaVacacional" name="primavacacional" value="1" style="width: 30px;"><b>%</b></td>
											</tr>
											<tr>
												<td><input type="checkbox" checked id="chkVales" PAR="txtVales" name="chkvales" class="chkConcepto formProyect"></td><td>Vales de Despensa</td><td><input type="text" class="formProyect" id="txtVales" onchange="calculaValorProyecto()" name="vales" value="1" style="width: 30px;">%</td>
											</tr>
											<tr>
												<td><input type="checkbox" checked id="chkAhorro" PAR="txtAhorro" name="chkahorro" class="chkConcepto formProyect"></td><td>Fondo de Ahorro</td><td><input type="text" class="formProyect" id="txtAhorro" onchange="calculaValorProyecto()" name="ahorro" value="1" style="width: 30px;">%</td>
											</tr>
											<tr>
												<td><input type="checkbox" checked id="chkBono" PAR="txtBono" name="chkbono" class="chkConcepto formProyect"></td><td>Bono<div style="float:right;">$</div></td><td><input type="text" class="formProyect" onchange="calculaValorProyecto()" id="txtBono" name="bono" value="1" style="width: 80px;"></td>
											</tr>
											<tr>
												<td></td><td>Seguro de G.M.M.:</td><td><select class="formProyect" id="slcSeguroGMM" name="sgmm"><option value="no">NO</option><option value="si">SI</option></select></td>
											</tr>
											<tr>
												<td></td><td>Seguro de Vida:</td><td><select class="formProyect" id="slcASeguroVida" name="segvida"><option value="no">NO</option><option value="si">SI</option></select></td>
											</tr>
											<tr>
												<td></td><td>Otros</td><td><textarea class="formProyect" id="txtOtraPrestacion" name="otraprestacion" rows="3"></textarea></td>
											</tr>
										
										</table>
									</div>
							 	</div>
							 	<div class="despliegaSalario"><b>Valor Aprox. de Proyecto: </b>$<label id="lblProyAprox"></label></div>
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
			<td>
				<fieldset><legend>Contrato</legend>
					<table>
						<tr>
							<td class="FCG" style="width: 240px;"><b>Fecha de Cierre en Garantia: </b></td>
							<td class="FCG" style="width: 240px;">
							<select class="formProyectContrato" id="fGarantiaY" name="fGarantiaY"> <?php insertAnioMasDos(); ?></select>
							<select class="formProyectContrato" id="fGarantiaM" name="fGarantiaM">
								<option value="1">Enero</option>
								<option value="2">Febrero</option>
								<option value="3">marzo</option>
								<option value="4">abril</option>
								<option value="5">Mayo</option>
								<option value="6">Junio</option>
								<option value="7">Julio</option>
								<option value="8">Agosto</option>
								<option value="9">Septiembre</option>
								<option value="10">Octubre</option>
								<option value="11">Noviembre</option>
								<option value="12">Diciembre</option>
							</select>
							<select class="formProyectContrato" id="fGarantiaD" name="fGarantiaD">
							<?php 
								//$numero = cal_days_in_month(CAL_GREGORIAN, 11, 2015); // 31
								$numero = 31;
								for ($dia=1; $dia <= $numero ; $dia++) { ?>
									<option value="<?php echo $dia; ?>"><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
							<?php	
								}
							 ?>
							</select>
							</td>
							
							<td style="text-align: right; width: 320px;"><label id="garantiaMitad" hidden><b>Garantia a mitad de tiempo</b></label><label id="garantia5Dias" hidden><b>Garantia a 5 dias o menos de termino</b></label><label id="garantiaTerminada" hidden><b>Garantia Terminada</b></label></td>
						</tr>
						
						
					</table>
					<h2>Datos del Contrato</h2>
					<table class="tblFormularios">
						<tr>
							<td><b>Convenio Firmado: </b> </td><td><select type="text" class="formProyectContrato" id="txtConvenio" name="convenio"><option value="si">Si</option><option value="no">No</option></select></td>
						</tr>
						<tr>
							<td><b>Garantia: </b></td><td><select class="formProyectContrato" id="txtGarantia" name="garantia">
								<option value="dias30">30 Días</option>
								<option value="dias60">60 Días</option>
								<option value="dias90">90 Días</option>
								<option value="dias180">180 Días</option>
								<option value="anios1">1 Año</option>
							</select></td>
						</tr>
						<tr>
							<td><b>Honorarios: </b></td>
							<td><select id="slcHonorarios" onchange="calculaValorProyecto()">
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
							<input type="hidden" class="formProyectContrato" id="hdnHonorarios" name="hdnhonorarios">
							<input type="text" class="formProyectContrato" id="txtHonorarios" name="honorarios" hidden></td>
						</tr>
						<tr>
							<td><b>Acuerdo de Facturacion: </b></td><td>
							<select id="slcAcuerdo" name="acuerdo">
								<option value="fac100">100%</option>
								<option value="fac3070">30% 70%</option>
								<option value="fac303040">30% 30% 40%</option>
								<option value="facOtro">Otro</option>
							</select>
							<input id="txtAcuerdo" type="text" class="formProyectContrato" name="txtacuerdo" hidden></td>
						</tr>
						<tr><td>
								<b>Observaciones del Contrato: </b>
							</td>
							<td>
								<textarea class="datosContrato" name="obscontrato" id="obsContrato" cols="30" rows="7"></textarea>
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
		<tr style="vertical-align: top;">
			<td colspan="2">
				<fieldset><legend>Actividades</legend>
					<table width="100%">
						<tr  style="vertical-align: top;">
							<td style="width: 50%;">
								<div class="datagrid">
									<table border="1" id="tblActividades" >
										<thead>
											<tr><th colspan="4" style="text-align: center; width:560px;">Registro de Actividades</th></tr>
											<tr>
												<th colspan="2" style="text-align: center; width:175px;">Fecha</th><th style="text-align: center; width:310px;">Actividad</th><th><div id="btnMas" class="btnMas"></div></th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
							</td>
							<td style="width: 50%;">
								<div class="datagrid">
									<table border="1" id="tblSeguimientos" >
										<thead>
											<tr><th colspan="6" style="text-align: center; width:560px;">Seguimiento</th></tr>
											<tr>
												<th colspan="2" style="text-align: center; width:175px;">Fecha</th><th style="text-align: center; width:310px;">Actividad</th><th colspan="2" style="width:65px;"></th><th><div id="btnMasSeg" class="btnMas"></div></th>
											</tr>
											
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					</table>
								
				</fieldset>
			</td>
		</tr>
		<tr>
			<td>
				<fieldset><legend>Facturación</legend>
					<h2>Facturacion</h2>
					<table class="tblFormularios" class="tblFormularios">
						<tr>
							<td><b>Valor del Proyecto:</b></td><td><input type="text" class="formProyectFacturacion" id="txtValorProyecto" name="valorproyecto"></td>
						</tr>
						<tr>
							<td><b>Total Facturado: </b></td><td><input type="text" class="formProyectFacturacion" id="txtTotalFacturado" name="totalfacturado" disabled></td>
						</tr>
						<tr>
							<td><b>% Facturado: </b></td><td><input type="text" class="formProyectFacturacion" id="txtPorcFacturado" name="porcfacturado" disabled></td>
						</tr>
						<tr>
							<td><b>$ por Facturar: </b></td><td> <input type="text" class="formProyectFacturacion" id="txtXFacturar" name="xfacturar" disabled></td>
						</tr>
					</table>
					 
					
					<br>
					<div class="datagrid">
						<table border="1" id="tblFacturas"> <!-- Listado Pago de facturas -->
							<thead>
								<tr>
									<th></th><th>No.</th><th>Monto</th><th>Fecha de Factura</th><th>Fecha Pago</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th style="background-color:#4D80E6; color:#fff;">Factura 1</th>
									<td><input type="text" id="n1" name="facno1" class="formProyectFacturas"></td>
									<td><input type="text" id="monto1" name="monto1" class="formProyectFacturas"></td>
									<td><input type="date" id="fEnvio1" name="fenvio1" class="formProyectFacturas"></td>
									<td><input type="date" id="fPago1" name="fpago1" class="formProyectFacturas"></td>
								</tr>
								<tr >
									<th style="background-color:#4D80E6; color:#fff;">Factura 2</th>
									<td><input type="text" id="n2" name="facno2" class="formProyectFacturas"></td>
									<td><input type="text" id="monto2" name="monto2" class="formProyectFacturas"></td>
									<td><input type="date" id="fEnvio2" name="fenvio2" class="formProyectFacturas"></td>
									<td><input type="date" id="fPago2" name="fpago2" class="formProyectFacturas"></td>
								</tr>
								<tr>
									<th style="background-color:#4D80E6; color:#fff;">Factura 3</th>
									<td><input type="text" id="n3" name="facno3" class="formProyectFacturas"></td>
									<td><input type="text" id="monto3" name="monto3" class="formProyectFacturas"></td>
									<td><input type="date" id="fEnvio3" name="fenvio3" class="formProyectFacturas"></td>
									<td><input type="date" id="fPago3" name="fpago3" class="formProyectFacturas"></td>
								</tr>
							</tbody>
								
						</table>
					</div>
				</fieldset>
			</td>
		</tr>
	</table>
	
		
	<br><br>
	<input type="button" value="Guardar" id="guardaProyecto">
	<br><br><br>

</div>

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