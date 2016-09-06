<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php //include_once("/../librerias_base.htm"); ?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$.ajax({
	 			type: "POST",
	 			url: "/proyecto_administracion/recordatorios/control.php",
	 			data: { "funcion" : "seguimientos", "area":"funnel"},
	 			success: function(data){

	 				

	 				var obj = JSON.parse(data);
	 				
	 				$cont=0;
	 				$contSeguimientosHoy = 0;
	 				$contSeguimientosPas = 0;
	 				$contSeguimientosFut = 0;
	 				$jsonObj = {};
	 				$arreglo = [100][100];

	 			// 	$estatus = Array(11);
					// for($i=0;$i<=10;$i++){
					// 	$estatus[$i] = 0;
					// }
	 				
	 				while(obj.Seguimiento[$cont]){
	 					$seguimiento = JSON.parse(obj.Seguimiento[$cont].seguimiento);
	 					$proyecto = JSON.parse(obj.Seguimiento[$cont].proyecto);
	 					$cliente = JSON.parse(obj.Seguimiento[$cont].cliente);
	 					console.log(obj.Seguimiento[$cont]);
	 						$cont2 = 0;
	 						while($seguimiento[$cont2]){	 			
	 							ms = Date.parse($seguimiento[$cont2].fecha);
	 							fecha = new Date(ms);
	 							fecha2 = new Date();								
	 							var timeDiff = fecha.getTime() - fecha2.getTime();
								var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
								
								switch($proyecto.proyectoRequerido){
			 						case "1": $nombre_proyecto = "Contrata"; break;
			 						case "2": $nombre_proyecto = "Busqueda de Talento"; break;
			 						case "3": $nombre_proyecto = "Mapeo de Talento"; break;
			 						case "4": $nombre_proyecto = "Talent Management"; break;
			 						default: $nombre_proyecto = ""; break;
			 					}

			 				// 	switch($proyecto.estatus){
								// 	case '1': $estatus[1] = $estatus[1] + 1; break;
								// 	case '2': $estatus[2] = $estatus[2] + 1; break;
								// 	case '3': $estatus[3] = $estatus[3] + 1; break;
								// 	case '4': $estatus[4] = $estatus[4] + 1; break;
								// 	case '5': $estatus[5] = $estatus[5] + 1; break;
								// 	case '6': $estatus[6] = $estatus[6] + 1; break;
								// 	case '7': $estatus[7] = $estatus[7] + 1; break;
								// 	case '8': $estatus[8] = $estatus[8] + 1; break;
								// 	case '9': $estatus[9] = $estatus[9] + 1; break;
								// 	case '10': $estatus[10] = $estatus[10] + 1; break;
								// 	case '10': $estatus[0] = $estatus[0] + 1; break;
									
								// }

	 							if (parseInt(diffDays) == 0) {
									
		 							$("#segActividadesHoy").append("<div class='segActividades'><b><a href='nuevo_proyecto.php?p="+obj.Seguimiento[$cont].id_funnel+"'>"+$nombre_proyecto+"</a></b><br><br><b>Cliente: </b>"+$cliente.publico+"</a><br><b>Actividad: </b>"+$seguimiento[$cont2].act+"</div>");
		 							$contSeguimientosHoy ++;
	 							}
	 							if (parseInt(diffDays) < 0) {
									
		 							$("#segActividadesPas").append("<div class='segActividades'>"+$seguimiento[$cont2].fecha+" ("+parseInt(diffDays)*-1+" dias atras)<br><a href='nuevo_proyecto.php?p="+obj.Seguimiento[$cont].id_funnel+"'><b>"+$nombre_proyecto+"</a></b><br><br><b>Cliente: </b>"+$cliente.publico+"</a><br><b>Actividad: </b>"+$seguimiento[$cont2].act+"</div>");
		 							$contSeguimientosPas ++;
	 							}
	 							if (parseInt(diffDays) > 0 && parseInt(diffDays) <= 4) {
									
		 							$("#segActividadesFut").append("<div class='segActividades'><b>Fecha: </b>"+$seguimiento[$cont2].fecha+"<br><a href='nuevo_proyecto.php?p="+obj.Seguimiento[$cont].id_funnel+"'><b>"+$nombre_proyecto+"</b></a><br><br><b>Cliente: </b>"+$cliente.publico+"</a><br><b>Actividad: </b>"+$seguimiento[$cont2].act+"</div>");
		 							$contSeguimientosFut ++;
	 							}
	 							$cont2++;
		 							
	 						}
	 						
	 					$cont++;
	 				}
	 				$("#contSegHoy").html($contSeguimientosHoy);
	 				$("#contSegPas").html($contSeguimientosPas);
	 				$("#contSegFut").html($contSeguimientosFut);
	 				
	 			}
	 		});
	 		// Load the Visualization API and the corechart package.
			google.charts.load('current', {'packages':['corechart']});
			// Set a callback to run when the Google Visualization API is loaded.
			google.charts.setOnLoadCallback(dibujaGraficaEstatus);


			$("#desplegarSeguimientoHoy").click(function(){
				$("#segActividadesHoy").slideToggle("slow");
			});
			//$("#segActividadesHoy").css("display","none");


			$("#desplegarSeguimientoPas").click(function(){
				$("#segActividadesPas").slideToggle("slow");
			});
			$("#segActividadesPas").css("display","none");


			$("#desplegarSeguimientoFut").click(function(){
				$("#segActividadesFut").slideToggle("slow");
			});
			$("#segActividadesFut").css("display","none");


			$("#desplegarCierres").click(function(){
				$("#proyectosEnCierre").slideToggle("slow");
			});
			$("#proyectosEnCierre").css("display","none");

		});
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
		function dibujaGraficaEstatus() {
		// Create the data table.
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
			  ['Por Contactar', $estatus[1]],
			  ['Seguimiento Inicial', $estatus[2]],
			  ['En Prospectación', $estatus[3]],
			  ['En Cotización', $estatus[4]],
			  ['En negociación', $estatus[5]],
			  ['En Firma de Convenio', $estatus[6]],
			  ['Vendido / Cerrado', $estatus[7]],
			  ['Detenido', $estatus[8]],
			  ['Cancelado', $estatus[9]],
			  ['Se Recomendo a Servipres', $estatus[10]],
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
		
	</script>
	<style type="text/css">

	</style>
</head>
<body>
	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarSeguimientoHoy'><b>Seguimientos Para Hoy</b><label class="contSeg" id="contSegHoy" ></label></a>
		<div class="bodySegActividades" id="segActividadesHoy"></div>
	</div>
	
	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarSeguimientoPas'><b>Seguimientos Atrasados</b><label class="contSeg" id="contSegPas" ></label></a>
		<div class="bodySegActividades" id="segActividadesPas"></div>
	</div>
	
	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarSeguimientoFut'><b>Seguimientos Por Venir</b><label class="contSeg" id="contSegFut" ></label></a>
		<div class="bodySegActividades" id="segActividadesFut"></div>
	</div>
	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarEstatus'><b>Estatus de Proyectos</b></a>
		<div id="graf_estatus" style="float:left;"></div>
	</div>
		
	
</body>
</html>