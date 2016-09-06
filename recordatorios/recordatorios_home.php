<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php //include_once("/../librerias_base.htm"); ?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	$inOvertime = 0;
	$totalDeProyectos=0;
		$(document).ready(function(){
			
			$.ajax({
	 			type: "POST",
	 			url: "/proyecto_administracion/recordatorios/control.php",
	 			data: { "funcion" : "seguimientos", "area":"proyecto"},
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				
	 				$cont=0;
	 				$contSeguimientos = 0;
	 				$jsonObj = {};
	 				$arreglo = [100][100];
	 				
	 				while(obj.Seguimiento[$cont]){
	 					$seguimiento = JSON.parse(obj.Seguimiento[$cont].seguimiento);
	 					$proyecto = JSON.parse(obj.Seguimiento[$cont].proyecto);
	 					$cliente = JSON.parse(obj.Seguimiento[$cont].cliente);

	 						$cont2 = 0;
	 						while($seguimiento[$cont2]){
	 			
	 							ms = Date.parse($seguimiento[$cont2].fecha);
	 							fecha = new Date(ms);
	 							fecha2 = new Date();								
	 							var timeDiff = fecha.getTime() - fecha2.getTime();
								var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	 							if (diffDays <= 4) {
									
		 							$("#segActividades").append("<div class='segActividades'><b>Fecha: </b>"+$seguimiento[$cont2].fecha+"<br><a href='proyectos/proyectos.php?p="+obj.Seguimiento[$cont].id_proyecto+"'><b>Proyecto: </b>"+$proyecto.posicion+"</a><br><b>Cliente: </b>"+$cliente.publico+"</a><br><b>Actividad: </b>"+$seguimiento[$cont2].act+"</div>");
		 							$contSeguimientos ++;
	 							}
	 							$cont2++;
		 							
	 						}
	 						//$jsonObj.push($arreglo);
	 					//$contSeguimientos = $contSeguimientos + $cont2;
	 					
	 					$cont++;
	 				}
	 				$("#contSeg").html($contSeguimientos);
	 				
	 				//$jsonObj.sort();
	 			}
	 		});
	 		$.ajax({
	 			type: "POST",
	 			url: "/proyecto_administracion/recordatorios/control.php",
	 			data: { "funcion" : "datosProyectos", "area":"proyecto"},
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				console.log(obj);
	 				$inOvertime = 0;
	 				$contGarantia = 0;
	 				$cont=0;
	 				$totalMesActual = 0;
					$totalMesAnterior = 0;
					$estatus = Array(12);
					for($i=0;$i<=11;$i++){
						$estatus[$i] = 0;
					}
	 				while(obj.proyecto[$cont]){

	 					$datos_proyecto = JSON.parse(obj.proyecto[$cont].datos_proyecto);
	 					$datos_contrato = JSON.parse(obj.proyecto[$cont].contrato);
	 					$datos_facturacion = JSON.parse(obj.proyecto[$cont].facturacion);
	 				

	 					fIdeal = $datos_proyecto.fCIdealY+"-"+$datos_proyecto.fCIdealM+"-"+$datos_proyecto.fCIdealD;
	 					fI = Date.parse(fIdeal);
	 					fecha = new Date(fI);
	 					hoy = new Date();								
						var timeDiff = fecha.getTime() - hoy.getTime();
						var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
						if (diffDays < 31) {
							$("#proyectosEnOvertime").append("<div class='enOvertime'><b>Fecha: </b>"+fIdeal+"<br><a href='proyectos/proyectos.php?p="+obj.proyecto[$cont].id+"'><b>Proyecto: </b>"+$datos_proyecto.posicion+"</a></div>");
							$inOvertime ++;
						}

						

						switch($datos_proyecto.estatus){
							case '1': $estatus[1] = $estatus[1] + 1; break;
							case '2': $estatus[2] = $estatus[2] + 1; break;
							case '3': $estatus[3] = $estatus[3] + 1; break;
							case '4':$estatus[4] = $estatus[4] + 1; break;
							case '5':$estatus[5] = $estatus[5] + 1; break;
							case '6':$estatus[6] = $estatus[6] + 1; break;
							case '7':$estatus[7] = $estatus[7] + 1; break;
							case '8':$estatus[8] = $estatus[8] + 1; break;
							case '9':$estatus[9] = $estatus[9] + 1; break;
							case '10': $estatus[10] = $estatus[10] + 1; break;
							case '11': $estatus[11] = $estatus[11] + 1; break;
							case '-1':$estatus[0] = $estatus[0] + 1; break;
							case '0':$estatus[0] = $estatus[0] + 1; break;
						}

						if ($datos_proyecto.estatus == "8") {
							
							$FG = $datos_contrato.fGarantiaY+"-"+$datos_contrato.fGarantiaM+"-"+$datos_contrato.fGarantiaD;
							//$fGarantia = Date.parse($FG);
							//fecha2 = new Date($fGarantia);
							//hoy2 = new Date();
							//var timeDiff2 = fecha2.getTime() - hoy2.getTime();
							//var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
								
							//if (diffDays2 < 6) { 
								$("#proyectosEnGarantia").append("<div class='proyEnGarantia'><b>Fecha: </b>"+$FG+"<br><a href='proyectos/proyectos.php?p="+obj.proyecto[$cont].id+"'><b>Proyecto: </b>"+$datos_proyecto.posicion+"</a></div>");
								$contGarantia ++;
							//}else{
							//	if (diffDays2 < (parseInt($datos_contrato.garantia)/2)) {
							//		$("#proyectosEnGarantia50").append("<b>Fecha: </b>"+$FG+"<br><a href='proyectos/proyectos.php?p="+obj.proyecto[$cont].id+"'><b>Proyecto: </b>"+obj.proyecto[$cont].id+"</a><br><br>");
							//		$contGarantia ++;
							//	}
							//}
						}


						//   Facturado al mes y mes anterior  -------->>

						hoy = new Date();
						mesActual = hoy.getMonth();
						
						
						if ($datos_facturacion.lista.fpago1 != "") {
							fecha = new Date($datos_facturacion.lista.fpago1);
							mesFactura = fecha.getMonth();
							mesPasado = mesActual - 1;
							if (mesPasado == -1) {mesPasado = 12;}

							if (mesFactura == mesActual) {
								// suma pago mes actual
								$totalMesActual = $totalMesActual + parseFloat($datos_facturacion.lista.monto1); }
							else{ if (mesFactura == mesPasado) {
									// suma pago mes anterior
									$totalMesAnterior = $totalMesAnterior + parseFloat($datos_facturacion.lista.monto1); }
							}
							
						}

						if ($datos_facturacion.lista.fpago2 != "") {
							fecha = new Date($datos_facturacion.lista.fpago2);
							mesFactura = fecha.getMonth();
							if (mesFactura == mesActual) {
								// suma pago mes actual
								$totalMesActual = $totalMesActual + parseFloat($datos_facturacion.lista.monto2); }
							else{ if (mesFactura == mesPasado) {
									// suma pago mes anterior
									$totalMesAnterior = $totalMesAnterior + parseFloat($datos_facturacion.lista.monto2); }
							}
							
						}

						if ($datos_facturacion.lista.fpago3 != "") {
							fecha = new Date($datos_facturacion.lista.fpago3);
							mesFactura = fecha.getMonth();
							if (mesFactura == mesActual) {
								// suma pago mes actual
								$totalMesActual = $totalMesActual + parseFloat($datos_facturacion.lista.monto3); }
							else{ if (mesFactura == mesPasado) {
									// suma pago mes anterior
									$totalMesAnterior = $totalMesAnterior + parseFloat($datos_facturacion.lista.monto3); }
							}
							
						}

						
						
							

						//   <<-------- Fin de Facturado al mes y mes anterior 

						
	 					$cont ++;
	 				}
	 				console.log($estatus);
	 				$totalDeProyectos = $cont;
	 				if ($inOvertime > 0) {
	 					$("#contCierre").html($inOvertime);
	 				}
	 				else {$("#contCierre").html();}

	 				if ($contGarantia > 0) {$("#contGarantia").html($contGarantia);}else{$("#contGarantia").html();}

					$("#contFacturado").append(addCommas((parseFloat($totalMesActual)+parseFloat($totalMesAnterior)).toFixed(2)));

	 				$("#facturasPagadasActual label").append(addCommas($totalMesActual.toFixed(2)));
					
					$("#facturasPagadasAnterior label").append(addCommas($totalMesAnterior.toFixed(2)));
	 			}
	 		});

	 		// $.ajax({
	 		// 	type: "POST",
	 		// 	url: "/proyecto_administracion/recordatorios/control.php",
	 		// 	data: { "funcion" : "enFechaDeGarantia"},
	 		// 	success: function(data){}
	 		// });

			// $("#desplegarSeguimiento").click(function(){
			// 	$("#segActividades").slideToggle("slow");
			// });
			// $("#segActividades").css("display","none");


			$("#desplegarCierres").click(function(){
				if ($("#graf_overtime").is(":visible")) {
					$("#graf_overtime").animate({width: 'toggle'},function(){
						$("#proyectosEnOvertime").animate({width: 'toggle'});
					});
				}
				else{
					$("#proyectosEnOvertime").animate({width: 'toggle'},function(){
						$("#graf_overtime").animate({width: 'toggle'});
					});
				}
				
				

			});
			$("#proyectosEnOvertime").css("display","none");


			$("#desplegarGarantias").click(function(){
				$("#proyectosEnGarantia").slideToggle("slow");
			});
			// $("#proyectosEnGarantia").css("display","none");
			

			// $("#desplegarFacturado").click(function(){
			// 	$("#proyectosFacturados").slideToggle("slow");
			// 	//$("#facturasPagadasAnterior").slideToggle("slow");
			// });
			// $("#proyectosFacturados").css("display","none");
			// //$("#facturasPagadasAnterior").css("display","none");

		});
		// Load the Visualization API and the corechart package.
		google.charts.load('current', {'packages':['corechart']});
		// Set a callback to run when the Google Visualization API is loaded.
		google.charts.setOnLoadCallback(dibujaGraficaOvertime);
		google.charts.setOnLoadCallback(dibujaGraficaEstatus);
		// Callback that creates and populates a data table,
		// instantiates the pie chart, passes in the data and
		// draws it.
		function dibujaGraficaOvertime() {
		// Create the data table.
			$enTiempo = $totalDeProyectos-$inOvertime;
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
			  ['En Tiempo', $enTiempo],
			  ['En OverTime', $inOvertime],
			 
			]);
			// Set chart options
			var options = {'legend':'left',
							'title':'OVERTIME',
							'is3D':true,
			               'width':400,
			               'height':200};
			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.PieChart(document.getElementById('graf_overtime'));
			function selectHandler() {
			  var selectedItem = chart.getSelection()[0];
			  if (selectedItem) {
			    var topping = data.getValue(selectedItem.row, 0);
			    alert('Proyectos en ' + topping);
			  }
			}
			google.visualization.events.addListener(chart, 'select', selectHandler);  
			chart.draw(data, options);
		}

		function dibujaGraficaEstatus() {
		// Create the data table.
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
			  ['Busqueda de Candidatos', $estatus[1]],
			  ['Entrevista Interna', $estatus[2]],
			  ['Información con Cliente', $estatus[3]],
			  ['Entrevista con Cliente', $estatus[4]],
			  ['Selección por Cliente', $estatus[5]],
			  ['Negociación de Contratación', $estatus[6]],
			  ['En Proceso de Ingreso', $estatus[7]],
			  ['Cerrado / En Garantia', $estatus[8]],
			  ['Cerrado', $estatus[9]],
			  ['Detenido', $estatus[10]],
			  ['Cancelado', $estatus[11]],
			  ['No Definido', $estatus[0]],
			 
			]);
			// Set chart options
			var options = {'legend':'left',
							'title':'ESTATUS',
							'is3D':true,
			               'width':400,
			               'height':200};
			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.PieChart(document.getElementById('graf_estatus'));
			
			chart.draw(data, options);
		}

		function confirm(){
			$x = confirm("ejemplo");
			if ($x==true) {alert("si");}
			else { alert("no");}
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
	</script>
	<style type="text/css">
		.infoBox{
			float: left;
			height: 240px;
		}
		.bodySegActividades{
			height: 200px !important;
			margin: 5px !important;
		}
	</style>
</head>
<body>

	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarSeguimiento'><b>Seguimiento de Actividades</b><label class="contSeg" id="contSeg" ></label></a>
		<div class="bodySegActividades" id="segActividades"></div>
	</div>

	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarCierres'><b>Proyectos en Overtime</b><label class="contSeg" id="contCierre" ></label></a>
		<div id="graf_overtime" style="float:left;"></div>
		<div class="bodyEnOvertime" id="proyectosEnOvertime" style="float:left;"></div>
	</div>

	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarEstatus'><b>Estatus de Proyectos</b></a>
		<div id="graf_estatus" style="float:left;"></div>
	</div>

	<!-- <div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarGarantias'><b>Garantia</b><label class="contSeg" id="contGarantia" ></label></a>
		<div class="bodyEnGarantia" id="proyectosEnGarantia">
		</div>
	</div>
		
	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarFacturado'><b>Facturado Reciente</b><label class="contSeg" id="contFacturado" style="padding-right: 10px;">$ </label></a>
		
		<div id="proyectosFacturados" style="float: left; background-color: transparent;font-size: 12px; width: 350px;">
			
				<div id="facturasPagadasActual"><b>Facturado Mes Actual:</b><label style="float: right; padding-right: 10px;">$ </label></div>
				<div id="facturasPagadasAnterior"><b>Facturado Mes Anterior:</b><label style="float: right; padding-right: 10px;">$ </label></div>
			
		</div>
	</div> -->
		
</body>
</html>
