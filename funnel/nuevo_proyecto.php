<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<?php $proyecto = $_GET['p'];
	if(empty($proyecto)){$proyecto = 0;} ?>
	<script type="text/javascript">
		$filasActividades = 0;
		$filasSeguimientos = 0;
		$preWBS = "";
		$facturacion = [];
		$contacto = [];
		$cliente = [];
		$clientes = [];
		$filasContacto = 0;
		$listadoKam="";
		$terminaFunnel = 0;
		$proyecto = <?php echo $proyecto; ?>;

		function cargaKam(){
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" :  "buscaKam" },
	 			success: function(data){
	 				$listadoKam = JSON.parse(data);
	 				$cont = 0;
	 				console.log($listadoKam);
	 				while($listadoKam[$cont]){
	 					var kamDatos = JSON.parse($listadoKam[$cont].datos);
	 					if (kamDatos.puesto.consultor == "1") {
	 						$("#kam").append("<option value='"+kamDatos.idColaborador+"'>"+kamDatos.nombrec+"</option>");
	 						$("#kam2").append("<option value='"+kamDatos.idColaborador+"'>"+kamDatos.nombrec+"</option>");
	 						$("#kam3").append("<option value='"+kamDatos.idColaborador+"'>"+kamDatos.nombrec+"</option>");
	 					}
	 					if (kamDatos.puesto.reclutador == "1") {
	 						$("#recl3").append("<option value='"+kamDatos.idColaborador+"'>"+kamDatos.nombrec+"</option>");
	 					}
						$cont++;
	 				}
	 				ordenarSelect('kam');
	 				ordenarSelect('kam2');

	 				cargaEstatus();
	 			}
	 		});
	 		
	 		
		}

		function cargaClientes(){
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" :  "buscaClientes" },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				$cont = 0;
	 				$alt = -1;
	 				while(obj[$cont]){
	 					$clientes[obj[$cont].id] = obj[$cont];
	 					
	 					$facturacion[obj[$cont].id] = JSON.parse(obj[$cont].facturacion);
	 					$contacto[obj[$cont].id] = JSON.parse(obj[$cont].datos_contacto);
	 					
	 					$cliente[obj[$cont].id] = JSON.parse(obj[$cont].datos_cliente);
	 					$datosCliente = JSON.parse(obj[$cont].datos_cliente);
	 					$("#listaClientes tbody").append("<tr onclick='insertaContactos("+obj[$cont].id+")' class='filaClientes'><td class='colCliente'>"+$datosCliente.publico+"</td></tr>");
	 					
	 					$fac = $facturacion[obj[$cont].id];
	 					if($fac.length === 0){
	 						if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
		 					$("#tblClientes tbody").append("<tr "+$claseAlt+" onclick='selectCliente("+obj[$cont].id+",-1);insertaContactos("+obj[$cont].id+");'><td class='colCliente'>"+$datosCliente.publico+"</td><td class='colRS'></td></tr>");
							$alt = $alt * -1;
	 					}else
	 					$.each($fac,function(key,value){
							if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
		 					$("#tblClientes tbody").append("<tr "+$claseAlt+" onclick='selectCliente("+obj[$cont].id+","+value.idfac+");insertaContactos("+obj[$cont].id+");'><td class='colCliente'>"+$datosCliente.publico+"</td><td class='colRS'>"+value.rs+"</td></tr>");
							$alt = $alt * -1;
	 					});
	 					
						$cont++;
	 				}
	 				$("#tblClientes tbody > tr").hide();

	 				if ($proyecto > 0) {
						buscaDatosProyecto();
						buscaActividades();
					}

	 				}
	 				
	 		});
	 		
		}

		function cargaEstatus(){
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" :  "buscaEstatus" },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				$cont = 0;

	 				while(obj[$cont]){
	 					
	 					$estatus = JSON.parse(obj[$cont].descripcion);
	 					$("#slcEstatus").append("<option value='"+$estatus.clave+"'>"+$estatus.nombre+"</option>");
	 				
						$cont++;
	 				}
	 				cargaClientes();
	 			}
	 		});
	 		
		}

		function buscaDatosProyecto(){
			$.ajax({ // Busca datos del proyecto
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "recuperaProyecto", "proyecto": $proyecto },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				

	 				var datos_proyecto = JSON.parse(obj.Proyecto[0].datos_proyecto);
	 				var rs = JSON.parse(obj.Cliente[0].facturacion);
	 				var datos_cliente = JSON.parse(obj.Proyecto[0].cliente);

	 				var cliente = JSON.parse(obj.Cliente[0].datos_cliente);
	 				var contacto = JSON.parse(obj.Cliente[0].datos_contacto);
	 				
	 				var datos_contrato = JSON.parse(obj.Proyecto[0].contrato);

		 				$("#empresa").val(datos_proyecto.empint);
		 				$("#kam").val(datos_proyecto.kam); console.log(datos_proyecto.kam);
		 				$("#kam2").val(datos_proyecto.kam2);
		 				$("#proyectoRequerido").val(datos_proyecto.proyectoRequerido);
		 				$("#fechaInicio").val(datos_proyecto.fechainicio);

		 				$("#proyectoReq").val(datos_proyecto.proyectoReq);
		 				
		 				$("#lblCliente").html(cliente.publico);
		 				$("#idCliente").val(datos_cliente.cliente);
		 				$.each(rs, function($key, $value){
		 					if ($value.idfac == datos_cliente.razonS) {$("#rsClienteResumen").html($value.rs); $("#rfcClienteResumen").html($value.rfc); $("#hdnDatoFiscal").val(datos_cliente.razonS);}
		 				});

		 				$cont = 0;
						while(contacto[$cont]){
							
							$filasContacto = contacto[$cont].idcontacto;

							$("#tblContacto > tbody").append('<tr id="filaContacto_'+$filasContacto+'" class="noprimario" style="border-bottom:1px solid #E1EEF4"><td><!-- <div id="btnMenosContacto_'+$filasContacto+'" class="btnMenosCont"></div> --><input type="hidden" value="'+$filasContacto+'" class="registroContactos"><input type="hidden" class="datoContacto_'+$filasContacto+'" id="idContacto_'+$filasContacto+'" name="idcontacto" value="'+$filasContacto+'"></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtNombre_'+$filasContacto+'" value="'+contacto[$cont].nombre+'" name="nombre" style="width:250px;" placeholder="Nombre Completo"><br><input type="text" class="datoContacto_'+$filasContacto+'" id="txtArea_'+$filasContacto+'" value="'+contacto[$cont].area+'" name="area" style="width:170px;" placeholder="Area / Puesto"></td><td><table id="tblMedioContacto_'+$filasContacto+'" contacto="'+$filasContacto+'" ><tbody></tbody></table></td><td><input type="date" class="datoContacto_'+$filasContacto+'" id="txtCumpleaños_'+$filasContacto+'" value="'+contacto[$cont].cumpleaños+'" name="cumpleaños" style="width:130px;"></td><td><textarea class="datoContacto_'+$filasContacto+'" id="txtObservaciones_'+$filasContacto+'" name="observaciones" style="width:200px; height:40px;">'+contacto[$cont].observaciones+'</textarea></td><td><input type="radio" name="contacPrimario" onclick="seleccionaContacto('+$filasContacto+');"></td></tr>');

							$cont2=0;
							
							while(contacto[$cont].medioDeContacto[$cont2]){
								$idTipoContacto = contacto[$cont].medioDeContacto[$cont2].tipoContacto;
								$idValorContacto = contacto[$cont].medioDeContacto[$cont2].valorContacto;
								
								$('#tblMedioContacto_'+$filasContacto+' > tbody').append('<tr class="tblFilaContacto'+$filasContacto+'" fila="'+$cont2+'"><td></td><td><select id="tipoContactoFila'+$filasContacto+'_'+$cont2+'"><option value="1">Telefono Movil</option><option value="2">Telefono Trabajo</option><option value="3">e-Mail</option><option value="4">linkedin</option><option value="5">ubicacion</option></select></td><td><input id="valorTipoContactoFila'+$filasContacto+'_'+$cont2+'" type="text" class="datoContacto" name="valor" style="width:150px;"></td></tr>');
								$('#tipoContactoFila'+$filasContacto+'_'+$cont2).val($idTipoContacto);
								$('#valorTipoContactoFila'+$filasContacto+'_'+$cont2).val($idValorContacto);
								$cont2++;
							}

							$('#tblMedioContacto_'+$filasContacto+' > tbody').append('<tr class="tblFilaContacto'+$filasContacto+'" fila="-1"><td><!-- <div id="btnMasMedioContacto" class="btnMas" onclick="agregaMedioContacto('+$filasContacto+','+$cont2+')"></div> --></td><td></td><td></td></tr>');

							$cont++;
						}
						$('#filaContacto_'+datos_cliente.contacto+' input:radio').attr('checked',true);
						seleccionaContacto(datos_cliente.contacto);

						$filasContacto++;
		 				
		 				$("#slcConvenio").val(datos_contrato.convenio);
		 				
		 				$("#slcGarantia").val(datos_contrato.garantia);
		 				$("#slcHonorarios").val(datos_contrato.honorarios);
		 				if (datos_contrato.honorarios == "fijo" || datos_contrato.honorarios == "otro" ) {
		 					$("#txtHonorarios").attr("hidden",false);
		 				}
		 				else{ $("#txtHonorarios").attr("hidden",true); }
		 				$("#txtHonorarios").val(datos_contrato.txthonorarios);

		 				$("#slcAcuerdo").val(datos_contrato.acuerdo);
		 				$("#txtAcuerdo").val(datos_contrato.txtacuerdo);
		 				if (datos_contrato.acuerdo == "facOtro") {
		 					$("#txtAcuerdo").attr("hidden",false);
		 				}
		 				else{$("#txtAcuerdo").attr("hidden",true);}


		 				$("#obsContrato").val(datos_contrato.obscontrato);

		 				 
		 				$("#txtValorProyecto").val(addCommas(parseFloat(datos_contrato.valorProyecto.replace(/,/g, '')).toFixed(2)));
		 				
			 				
			 			
		 				$("#slcEstatus").val(datos_proyecto.estatus); console.log(datos_proyecto.estatus);
		 				cambiaBotonGuardado(datos_proyecto.estatus);
		 				
		 				switch(datos_proyecto.estatus){
		 					case "7":
		 					case "9":
		 					case "10": bloqueaFormulario(); break;
		 				}
			 					
	 			}
	 		});
		}

		function buscaActividades(){
			$.ajax({  // Carga registro Actividades / Seguimiento
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "listaActividades", "proyecto": $proyecto },
	 			success: function(data){
	 			 	var obj = JSON.parse(data);
	 			 	$.each( obj.actividad, function( filasActividades, actividad ) {
					  $("#tblActividades tbody").append('<tr><td><input type="hidden" class="registroActividades" id="numeroFila" value="'+filasActividades+'"></td><td><input type="date" value="'+actividad.fecha+'" id="fecha_'+filasActividades+'" disabled></td><td colspan="1"> <textarea  cols="38" rows="5" id="txtActividad_'+filasActividades+'" disabled>'+actividad.act+'</textarea></td><td></td></tr>');
					  $filasActividades = filasActividades;
					});
 					

					$.each( obj.seguimiento, function( filasSeguimientos, actividad ) {
					  $("#tblSeguimientos tbody").append('<tr id="filaSeg_'+filasSeguimientos+'"><td><input type="hidden" class="registroSeguimientos" id="numeroFilaSeg" value="'+filasSeguimientos+'"></td><td><input type="date" id="fechaSeg_'+filasSeguimientos+'" value="'+actividad.fecha+'" disabled> </td><td colspan="1"><textarea  cols="38" rows="5" id="txtAreaSeg_'+filasSeguimientos+'" disabled>'+actividad.act+'</textarea></td><td><div class="btnAcepSeg" id="btnAcepSeg_'+filasSeguimientos+'"></div></td><td><div class="btnCancelSeg" id="btnCancelSeg_'+filasSeguimientos+'"></div></td><td></td></tr>');
					  $filasSeguimientos = filasSeguimientos;
					});
					

	 		
	 			}
	 		});
		}


		$(document).ready(function(){
			$("li").removeClass( "current" );
			$("#menuFunnel").addClass('current');

			cargaKam();
			
	 		$(document).on('click','.btnMenosSeg',function(){
				$elemento = this.id;
				$elementoSeparado = $elemento.split("_");
				$noFila = $elementoSeparado[1];
				$("#tblSeguimientos tbody tr#filaSeg_"+$noFila).remove();
			});

			$(document).on('click','.btnMenos',function(){
				$elemento = this.id;
				$elementoSeparado = $elemento.split("_");
				$noFila = $elementoSeparado[1];
				$("#tblActividades > tbody tr#fila_"+$noFila).remove();
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
			
	 		$("#slcEstatus").change(function(){
	 			cambiaBotonGuardado($(this).val());
	 			
	 		});

			$("#guardaProyecto").click(function(){
				dotosObligatorios();
			});
			
	 		$("#nombreCliente").on('keyup',function(){
	 			if ($("#nombreCliente").val() != "") {
	 				$("#listaClientes").show();
	 			}
	 			else{$("#listaClientes").hide();}
	 			filtraTabla();
	 		});
	 		$("#listaClientes").hide();

	 		$("#btnMasContacto").click(function(){
				$("#tblContacto > tbody").append('<tr id="filaContacto_'+$filasContacto+'" class="noprimario" style="border-bottom:1px solid #E1EEF4"><td><div id="btnMenosContacto_'+$filasContacto+'" class="btnMenosCont"></div><input type="hidden" value="'+$filasContacto+'" class="registroContactos"><input type="hidden" class="datoContacto_'+$filasContacto+'" id="idContacto_'+$filasContacto+'" name="idcontacto" value="'+$filasContacto+'"></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtNombre_'+$filasContacto+'" name="nombre" style="width:250px;" placeholder="Nombre Completo"><br><input type="text" class="datoContacto_'+$filasContacto+'" id="txtArea_'+$filasContacto+'" name="area" style="width:170px;" placeholder="Area / Puesto"></td><td><table id="tblMedioContacto_'+$filasContacto+'" contacto="'+$filasContacto+'" ><tr class="tblFilaContacto'+$filasContacto+'" fila="0"><td></td><td><select id="tipoContactoFila'+$filasContacto+'_0"><option value="1">Telefono Movil</option><option value="2">Telefono Trabajo</option><option value="3">e-Mail</option><option value="4">linkedin</option><option value="5">ubicacion</option></select></td><td><input id="valorTipoContactoFila'+$filasContacto+'_0" type="text" class="datoContacto" name="valor" style="width:150px;"></td></tr><tr class="tblFilaContacto'+$filasContacto+'" fila="-1"><td><div id="btnMasMedioContacto" class="btnMas" onclick="agregaMedioContacto('+$filasContacto+',1)"></div></td><td></td><td></td></tr></table></td><td><input type="date" class="datoContacto_'+$filasContacto+'" id="txtCumpleaños_'+$filasContacto+'" name="cumpleaños" style="width:130px;"></td><td><textarea class="datoContacto_'+$filasContacto+'" id="txtObservaciones_'+$filasContacto+'" name="observaciones" style="width:200px; height:40px;"></textarea></td><td><input type="radio" name="contacPrimario" onclick="seleccionaContacto('+$filasContacto+');"></td></tr>');

				$filasContacto++;
			});

			$(".fa-angle-double-down").click(function(){
				$("#muestraContactos").hide();
				$("#ocultaContactos").show();
				$("#tblContacto tbody tr").show();
			});
				
			$(".fa-angle-double-up").click(function(){
				$("#ocultaContactos").hide();
				$("#muestraContactos").show();
				$("#tblContacto tbody tr.noprimario").hide('fast');
			});

			$("#btnMas").click(function(){
				$filasActividades ++;
				$("#tblActividades tbody").append('<tr id="fila_'+$filasActividades+'"><td><div class="btnMenos" id="btnMenos_'+$filasActividades+'"></div><input type="hidden" class="registroActividades" id="numeroFila" value="'+$filasActividades+'"></td><td><input type="date" id="fecha_'+$filasActividades+'"></td><td colspan="1"> <textarea cols="38" rows="5" id="txtActividad_'+$filasActividades+'"></textarea></td><td></td></tr>');
			});

			$("#btnMasSeg").click(function(){
				$filasSeguimientos ++;
				agregaFilaSeguimiento($filasSeguimientos,"","");
			});

			$("#despliegaSalario").click(function(){
				$("#contenidoSalario").slideToggle("slow");
			});
			$("#contenidoSalario").css("display","none");

			$("#muestraContactos").hide();

			$("#plecaBusquedaCliente").click(function(){
				$("#contenidoBusquedaCliente").slideToggle('slow');
			});

			$("#plecaMuestraContactos").click(function(){
				$("#contenidoContactos").toggle("slow");
			});
			$("#contenidoContactos").css("display","none");

			// $("#tipoFunner").change(function(){
			// 	if ($("#tipoFunner").val() == 1) {
			// 		showBuscaCliente();
					
			// 	}
			// 	if ($("#tipoFunner").val() == 2) {
					
			// 	}
			// 	if ($("#tipoFunner").val() == -1) {
				
			// 	}
			// });

			$("#iniciaProyecto").click(function(){
				if ( $("#kam3").val() != -1 ) {
					guardaDatos();
				}
				else{ alert("Debes seleccionar al menos a un Consultor"); }
			});

		}); // fin document ready
	
		function cambiaBotonGuardado($val){

 			switch($val){
 				case '1':
 				case '2':
 				case '3':
 				case '4':
 				case '5':
 				case '6': 
 				case '8': $("#guardaProyecto").html("Guardar"); 
 				          $("#guardaProyecto").css('height','50px'); 
 				          $("#guardaProyecto").removeClass('mandaproyecto'); 
 				          $terminaFunnel = 0; 
			 			  break;

 				case '7': $("#guardaProyecto").html("Guardar y<br>Enviar a Proyectos"); 
 						  $("#guardaProyecto").css('height','62px'); 
 						  $("#guardaProyecto").addClass('mandaproyecto'); 
 						  $terminaFunnel = 1;
			 			  break;

 				case '9':
 				case '10': 	$("#guardaProyecto").html("Guardar y<br>Terminar"); 
 				           	$("#guardaProyecto").css('height','50px'); 
 				           
 				           	$terminaFunnel = 0; 
			 				break;

 				default: $("#guardaProyecto").html("Guardar"); 
 				         $("#guardaProyecto").css('height','50px'); 
 				         $terminaFunnel = 0; 
 				         break;

 			}
	 		
		}

		function desbloqueaFormulario(){
			$("input").prop('disabled', false);
			$(".btnAcepSeg").show();
			$(".btnCancelSeg").show();
			$(".btnMas").show();
			$("select").prop('disabled', false);
		}

		function bloqueaFormulario(){
			$("input").prop('disabled', true);
			$(".btnAcepSeg").hide();
			$(".btnCancelSeg").hide();
			$(".btnMas").hide();
			$("select").prop('disabled', true);
			$("textarea").prop('disabled', true);
		}

		function ordenarSelect(id_componente){
	    	var selectToSort = jQuery('#' + id_componente);
	    	var optionActual = selectToSort.val();
	    	selectToSort.html(selectToSort.children('option').sort(function (a, b) {
	    		return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;
	      	})).val(optionActual);
	    }
	    function filtraTabla(){
				$("#listaClientes tbody > tr").show();
				
	 			if( $("#nombreCliente").val() != ""){
					$("#listaClientes tbody > tr:visible > td.colCliente:not(:contains-ci('" + $("#nombreCliente").val() + "'))").parent("tr").hide();
				}

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

	    function dotosObligatorios(){
	    	if ($terminaFunnel == 1) {
	    		$(".fondoEmergente").css("visibility","visible");
	    		$(".boxKam").css("visibility","visible");
	   
	    	}
	    	else{
	    		guardaDatos();	
	    	}
	    }

	    function guardaDatos(){
	    	general = {};
		    cliente = {};
		    contrato = {};
		   

		    $(".formProyectCliente").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        cliente[name] = valor;
		    }); 
		 
		    $(".datosProyecto").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        general[name] = valor;
		    }); 
		 
		  	jsActividades = [];
			jsSeguimiento = [];
		
		    $(".registroActividades").each(function() {

		    	$fila = $(this).val();
		    	$fecha = $("#fecha_"+$fila).val();
		    	$actividad = $("#txtActividad_"+$fila).val();
		    	$actividad = $actividad.replace(/\n/g, "\\n");

		        item = {};
		     
		        item ["fecha"] = $fecha;
		        item ["act"] = $actividad;

		        jsActividades.push(item);
		    });
		   
		    $(".registroSeguimientos").each(function() {

		    	$filaS = $(this).val();
		    	$fechaS = $("#fechaSeg_"+$filaS).val();
		    	$actividadS = $("#txtAreaSeg_"+$filaS).val();
		    	$actividadS = $actividadS.replace(/\n/g, "\\n");

		        itemS = {};
		        itemS ["fecha"] = $fechaS;
		        itemS ["act"] = $actividadS;
			
		        jsSeguimiento.push(itemS);
		    });
		    

		    $(".datosContrato").each(function(){
		    	var name = $(this).attr("name");
		        var valor = $(this).val();
		        contrato[name] = valor;
		    });
		  
		    jsonStringGeneral = JSON.stringify(general);
		    jsonStringCliente = JSON.stringify(cliente);
		    jsonStringContrato = JSON.stringify(contrato);
		    jsonActividades = JSON.stringify(jsActividades);
		    jsonSeguimiento = JSON.stringify(jsSeguimiento);
		  
		    $nextID = "";

		    $.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "guardaProyecto", "general" : jsonStringGeneral, "cliente" : jsonStringCliente, "contrato" : jsonStringContrato, "actividades" : jsonActividades, "seguimiento" : jsonSeguimiento, "proyecto" : $proyecto },
	 			success: function(data){
	 				if ($terminaFunnel == 1) {
	 					$.ajax({
				 			type: "POST",
				 			url: "control.php",
				 			data: { "funcion" :  "buscaUltimoID" },
				 			success: function(data){

				 				 $fecha = new Date();
				 				 $anio = $fecha.getFullYear();
				 				 $nextID = parseInt(data.replace(/"/g, ''))+1;
				 				 $preWBS = $anio+"-"+(parseInt(data.replace(/"/g, ''))+1);

				 				 $(".mandaproyecto").each(function($key, $value){
							    	alert("manda");
							    	$kamPrincipal = $("#kam3").val();
							    	$recl = $("#recl3").val();
							    	$fechaHoy = new Date();
							    	$anioHoy = $fechaHoy.getFullYear();
							    	$mesHoy = $fechaHoy.getMonth()+1;
							    	$diaHoy = $fechaHoy.getDate();
							    	if (parseInt($diaHoy) < 10) {$diaHoy = "0" + $diaHoy;}
							    	if (parseInt($mesHoy) < 10) {$mesHoy = "0" + $mesHoy;}

							    	$proyRequerido = $("#proyectoRequerido").val();
							    	$proyectoReq = $("#proyectoReq").val();

							    	
							    	$datosProyectoPlus = {"wbs":$preWBS+"-"+$kamPrincipal,"kam":$kamPrincipal,"reclutador":$recl,"kam2":"-1","apoyo":"-1","prioridad":"1","fIniY":$anioHoy,"fIniM":$mesHoy,"fIniD":$diaHoy,"proyRequerido":$proyRequerido,"proyectoReq":$proyectoReq,"estatus":"1","posicion":"","disciplina":"-1","cta":"1","nivel":"1","salario":"0"};
							    	
							    	$.each($datosProyectoPlus, function($key, $value){
							    		general[$key] = $value;
							    	});

							    	$datosFacturacionPlus = {"valorproyecto":contrato.valorProyecto,"totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":contrato.valorProyecto,"lista":{"facno1":"","monto1":"0","fenvio1":"","fpago1":"","facno2":"","monto2":"0","fenvio2":"","fpago2":"","facno3":"","monto3":"0","fenvio3":"","fpago3":""}};
							    	
							    	jsonStringFacturacion = JSON.stringify($datosFacturacionPlus);
							    	jsonStringGeneral2 = JSON.stringify(general);
							    	
							    	
							    	mandaAProyectos(jsonStringGeneral2,jsonStringCliente,jsonStringContrato,$proyecto,jsonStringFacturacion);
							
							    });
				 			}
				 		});
	 				}
	 				 else{
	 				 	window.location="listado_proyectos.php";
	 				 }
		 				
	 			}
	 		});
			 		
	    }
 
  		function mandaAProyectos(jsonStringGeneral2,jsonStringCliente,jsonStringContrato,proyecto,jsonStringFacturacion){
  			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "pasaAProyecto", "general" : jsonStringGeneral2, "cliente" : jsonStringCliente, "contrato" : jsonStringContrato, "proyecto" : $proyecto, "facturacion":jsonStringFacturacion },
	 			success: function(data){ 
	 				if (data == "1") { alert("nos vamos a proyectos");
	 					window.location="../proyectos/proyectos.php?p="+$nextID;
	 				}
	 				else{alert("Ocurrio un error al heredar los datos");}
	 				
	 			}
	 		});
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

		function insertaContactos(idcliente){
			$cont = 0;
			var datosContacto = JSON.parse($clientes[idcliente].datos_contacto);
			var datosCliente = JSON.parse($clientes[idcliente].datos_cliente);
			$("#nombreCliente").val(datosCliente.publico);
			$("#idCliente").val(idcliente);
			$("#listaClientes").hide();

			$("#tblContacto > tbody").html("");
			while(datosContacto[$cont]){
				$filasContacto = datosContacto[$cont].idcontacto;

				$("#tblContacto > tbody").append('<tr id="filaContacto_'+$filasContacto+'" class="noprimario" style="border-bottom:1px solid #E1EEF4"><td><div id="btnMenosContacto_'+$filasContacto+'" class="btnMenosCont"></div><input type="hidden" value="'+$filasContacto+'" class="registroContactos"><input type="hidden" class="datoContacto_'+$filasContacto+'" id="idContacto_'+$filasContacto+'" name="idcontacto" value="'+$filasContacto+'"></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtNombre_'+$filasContacto+'" value="'+datosContacto[$cont].nombre+'" name="nombre" style="width:250px;" placeholder="Nombre Completo"><br><input type="text" class="datoContacto_'+$filasContacto+'" id="txtArea_'+$filasContacto+'" value="'+datosContacto[$cont].area+'" name="area" style="width:170px;" placeholder="Area / Puesto"></td><td><table id="tblMedioContacto_'+$filasContacto+'" contacto="'+$filasContacto+'" ><tbody></tbody></table></td><td><input type="date" class="datoContacto_'+$filasContacto+'" id="txtCumpleaños_'+$filasContacto+'" value="'+datosContacto[$cont].cumpleaños+'" name="cumpleaños" style="width:130px;"></td><td><textarea class="datoContacto_'+$filasContacto+'" id="txtObservaciones_'+$filasContacto+'" name="observaciones" style="width:200px; height:40px;">'+datosContacto[$cont].observaciones+'</textarea></td><td><input type="radio" name="contacPrimario" onclick="seleccionaContacto('+$filasContacto+');"></td></tr>');

				$cont2=0;
				
				while(datosContacto[$cont].medioDeContacto[$cont2]){
					$idTipoContacto = datosContacto[$cont].medioDeContacto[$cont2].tipoContacto;
					$idValorContacto = datosContacto[$cont].medioDeContacto[$cont2].valorContacto;
					
					$('#tblMedioContacto_'+$filasContacto+' > tbody').append('<tr class="tblFilaContacto'+$filasContacto+'" fila="'+$cont2+'"><td></td><td><select id="tipoContactoFila'+$filasContacto+'_'+$cont2+'"><option value="1">Telefono Movil</option><option value="2">Telefono Trabajo</option><option value="3">e-Mail</option><option value="4">linkedin</option><option value="5">ubicacion</option></select></td><td><input id="valorTipoContactoFila'+$filasContacto+'_'+$cont2+'" type="text" class="datoContacto" name="valor" style="width:150px;"></td></tr>');
					$('#tipoContactoFila'+$filasContacto+'_'+$cont2).val($idTipoContacto);
					$('#valorTipoContactoFila'+$filasContacto+'_'+$cont2).val($idValorContacto);
					$cont2++;
				}

				$('#tblMedioContacto_'+$filasContacto+' > tbody').append('<tr class="tblFilaContacto'+$filasContacto+'" fila="-1"><td><div id="btnMasMedioContacto" class="btnMas" onclick="agregaMedioContacto('+$filasContacto+','+$cont2+')"></div></td><td></td><td></td></tr>');

				$cont++;
			}

			$filasContacto++;
			$("#muestraContactos").hide();
			$("#ocultaContactos").show();
			$("#hdnBuscaClientes").hide();
		}

		function seleccionaContacto(fila){
			$("#tblContacto tbody tr.siprimario").removeClass('siprimario').addClass('noprimario');
			$("#filaContacto_"+fila).removeClass('noprimario');
			$("#filaContacto_"+fila).addClass('siprimario');
			$("#tblContacto tbody tr.noprimario").hide('fast');
			$("#hdnContacto").val(fila);
			$("#muestraContactos").show();
			$("#ocultaContactos").hide();
			$("#hdnContactoSeleccionado").val(fila);
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

	    function selectCliente($idCliente,$idFac){
			
			$clienteActivo = $idCliente;

			$datoFac = $facturacion[$idCliente][$idFac];
			$datoContacto = $contacto[$idCliente];
			$datoCliente = $cliente[$idCliente];

			$("#lblCliente").html($datoCliente.publico);

			$("#hdnCliente").val($idCliente);
			
			$("#hdnDatoFiscal").val($idFac);

			if ($idFac == -1) {$("#rsClienteResumen").html("Sin Datos Fiscales");$("#rfcClienteResumen").html("Sin Datos Fiscales");}
			else{
				$("#rsClienteResumen").html($datoFac.rs);
				$("#rfcClienteResumen").html($datoFac.rfc);
			}

			$("#contenidoBusquedaCliente").hide();
			$("#tblContactos").html();
			$.each($datoContacto, function($key, $value){
				$("#tblContactos").append("<tr id='"+$value.idcontacto+"'><td>"+$value.nombre+"</td><td>"+$value.area+"</td><td>(ver mas)</td><td><input type='button' value='Principal' onclick='seleccionaContacto("+$key+")'></td></tr>");
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
					
		}

		function eliminaSeguimientoCancelado(){

			$filaSeguimiento = $("#filaSeguimientoCancelado").val();
			$("#tblSeguimientos tbody tr#filaSeg_"+$filaSeguimiento).remove();
			$(".fondoEmergente").css("visibility","hidden");
			$("#hideCancelaSegimiento").css("visibility","hidden");
		}

		function agregaFilaSeguimiento($filasSeguimientos,$fecha,$actividad){
    		
    		$("#tblSeguimientos tbody").append('<tr id="filaSeg_'+$filasSeguimientos+'"><td><div class="btnMenosSeg" id="btnMenosSeg_'+$filasSeguimientos+'"></div><input type="hidden" class="registroSeguimientos" id="numeroFilaSeg" value="'+$filasSeguimientos+'"></td><td><input type="date" id="fechaSeg_'+$filasSeguimientos+'" value="'+$fecha+'"> </td><td colspan="1"><textarea cols="38" rows="5" id="txtAreaSeg_'+$filasSeguimientos+'">'+$actividad+'</textarea></td><td></td><td></td><td></td></tr>');
    	}

		function showBuscaCliente(){
	    	$("#hdnBuscaClientes").show();
	    }

	</script>
	<style type="text/css">
		#despliegaSalario{
			margin-left: 0px;
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
		#hdnBuscaClientes{
			display: none;
			position: absolute;
			z-index: 999;
			border: 3px solid black;
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
		.tblFormularios tr{vertical-align: top;}
		.boxKam{
			width: auto;
			height: 170px;
			background: linear-gradient(#f9f9f9, #e3e3e3);
			position: fixed;
			z-index: 9999;
			left: 50%;
			top: 50%;
			border-radius: 10px;
			border:2px solid black;
			margin-top: -100px;
			margin-left: -200px;
			visibility: hidden;
		}
		
		.bodyBoxKam{}
	</style>
</head>
<body>
<?php include_once("../header.htm"); ?>
<div class="cuerpo">
	<!-- Tipo de Funnel: <select id="tipoFunner" name="tipofunner"><option value="-1">-</option><option value="1">Prospecto de Cliente</option><option value="2" selected>Prospecto de Proyecto</option></select> -->
	
	<br><br>

	<input type="hidden" id="txtFolio" name="folio">
	<table style="width: 100%;">
		<tr style="vertical-align: top;">
			<td style="width: 800px; min-width: 50%;">
				<fieldset><legend>Datos Proyecto</legend>
					<table class="tblFormularios proyecto">
						<tr>
							<td>Empresa Interna</td>
							<td><select id="empresa" name="empint" class="datosProyecto">
									<option value="-1"> - Selecciona - </option>
									<option value="AIMS">AIMS</option>
									<option value="DMA">Diaz Morones y Asociados</option>
									<option value="SICSA">Servicios Industriales Contrata SA</option>
									<option value="SCO">Servicios Contrata</option>
									<option value="OCO">Outsourcing Contrata</option>
									<option value="STONEHC">Stone Human Capital</option>
								</select>
							</td>
							<td>Seguimiento</td>
							<td><select id="kam" name="kam" class="datosProyecto"><option value="-1"> - Selecciona - </option></select>
							<select id="kam2" name="kam2" class="datosProyecto"><option value="-1"> - Selecciona - </option></select></td>
						</tr>

			<tr class="proyecto">
				<td>Tipo de Proyecto: </td><td><select id="proyectoRequerido" name="proyectoRequerido" class="datosProyecto">
					<option value="1">Contrata</option>
					<option value="2">Busqueda de Talento</option>
					<option value="3">Mapeo de Talento</option>
					<option value="4">Talent Management</option>
				</select></td><td></td>
				
			</tr>
			<tr class="proyecto">
				<td>Descripcion del Proyecto: </td><td><textarea id="proyectoReq" name="proyectoReq" class="datosProyecto"></textarea></td><td></td>
				
			</tr>
		
			<tr>
				<td>Fecha de Inicio</td><td><input type="date" name="fechainicio" id="fechaInicio" class="datosProyecto"></td><td>Dias Transcurridos: <label id="diasTranscurridos"></label></td>
			</tr>
		
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr>
				<td>Estatus</td><td><select id="slcEstatus" name="estatus" class="datosProyecto"></select></td><td></td>
			</tr>
		
					</table>
				</fieldset>
			</td>
		</tr>
		<tr>
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
							<td><b>Cliente*:</b></td><td><div id="txtNombreComercial" style="background-color: rgba(55,55,55,0.4); width: 200px;"><label id="lblCliente"></label></div><input name="cliente" id="idCliente" type="hidden" value="-1" class="formProyectCliente"></td>
						</tr>
						<tr>
							<td><b>Datos Fiscales:</b></td><td><div id="lblDatosFiscales" style="background-color: rgba(55,55,55,0.4); width: 200px;"><table><tr><td>Razon Social</td><td><label id="rsClienteResumen"></label></td></tr><tr><td>RFC</td><td><label id="rfcClienteResumen"></label></td></tr></table></div><input name="razonS" id="hdnDatoFiscal" type="hidden" value="-1" class="formProyectCliente"></td>
						</tr>
					</table>
					
				</fieldset>
			</td>
		</tr>
		<td>
			
			<fieldset><legend>Contactos</legend>
				<div class="datagrid">
					
					<input name="contacto" id="hdnContacto" type="hidden" value="-1" class="formProyectCliente">
					<table id="tblContacto" border="1">
						<thead>
							<tr>
								<th colspan="9" width="1030px">Datos de Contacto</th>
							</tr>
							<tr>
								<th></th><th width="255px">Nombre</th><th width="175px">Información de Contacto</th><th>Cumpleaños</th><th width="206px">Observaciones</th><th><div id="btnMasContacto" class="btnMas"></div></th><th><div id="ocultaContactos"> <i class="fa fa-angle-double-up fa-2x"></i> </div><div id="muestraContactos"> <b><i class="fa fa-angle-double-down fa-2x"></i></b> </div></th>
							</tr>

						</thead>
						<tbody>
							
						</tbody>
							
					</table>
				</div>
				<input name="contacto" id="hdnContactoSeleccionado" type="hidden" value="-1" class="formProyectCliente">
			</fieldset>
			</td>
		</td>
	</table>
	
	
	<br>
	<fieldset><legend>Actividades</legend>
		<table >
			<tr style="vertical-align:top;">
				<td>
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
				<td>
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
	<br>
	<fieldset class="proyecto"><legend>Contrato</legend>
		<h3>Datos del Contrato</h3>
		<table class="tblFormularios">
			
			<tr>
				<td><b>Valor del Proyecto</b></td>
				<td><input type="text" id="txtValorProyecto" class="datosContrato" name="valorProyecto"></td>
				<td><b>Convenio Firmado: </b> </td><td><select type="text" class="datosContrato" id="slcConvenio" name="convenio"><option value="si">Si</option><option value="no">No</option></select></td>
			</tr>
			
			<tr>
				<td><b>Honorarios: </b></td>
				<td><select id="slcHonorarios" class="datosContrato" class="datosContrato" name="honorarios">
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
				
				<input type="text" class="datosContrato" id="txtHonorarios" name="txthonorarios" hidden></td>
				<td colspan="2" rowspan="4">
					<textarea class="datosContrato" name="obscontrato" id="obsContrato" cols="30" rows="7"></textarea>
				</td>
			</tr>
			<tr>
				<td><b>Acuerdo de Facturación</b></td>
				<td><select id="slcAcuerdo" class="datosContrato" name="acuerdo">
					<option value="fac100">100%</option>
					<option value="fac3070">30% 70%</option>
					<option value="fac303040">30% 30% 40%</option>
					<option value="facOtro">Otro</option>
					</select>
					<input id="txtAcuerdo" type="text" class="datosContrato" name="txtacuerdo" hidden></td></td>
			</tr>
			<tr>
				<td><b>Garantia</b></td><td><select class="datosContrato" name="garantia" id="slcGarantia"><option value="dias30">30 Días</option><option value="dias60">60 Días</option><option value="dias90">90 Días</option><option value="dias180">180 Días</option><option value="anios1">1 Año</option></select></td>
			</tr>
			<tr>
				<td><b>Exclusividad</b></td><td><select class="datosContrato" name="exclusividad"><option value="permanente">1- PERMANENTE</option><option value="temporal">2- TEMPORAL</option><option value="contingencia">3- CONTINGENCIA</option><option value="otro">4- OTRO</option></select></td>
			</tr>
		</table>
	</fieldset>
	<br>
	
	
	<br>
	<button value="Guardar" id="guardaProyecto"> Guardar </button>
	
		
</div>
<div class="boxKam">
	

	<div class="bodyBoxKam">
		<div class="datagrid">
			<table style=" margin-bottom:30px;">
				<thead>
					<tr>
						<th colspan="4">¿Quien estara a cargoo del proyecto?</th>
					</tr>
				</thead>
				<tbody>
					<tr style="height:50px;">
						<td><b>Kam: </b></td><td><select id="kam3" name="kamProyecto"><option value="-1"> - Selecciona - </option></select></td>
						<td><b>Reclutador: </b></td><td><select id="recl3" name="reclProyecto"><option value="-1"> - Selecciona - </option></select></td>
					</tr>
				</tbody>
					
				
			</table>
		</div>
			
		 <div style="right:20px; bottom:40px; position:absolute;"><input type="button" name="" value="Terminar" id="iniciaProyecto"></div>
	</div>
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