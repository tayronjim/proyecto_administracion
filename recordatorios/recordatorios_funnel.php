<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php //include_once("/../librerias_base.htm"); ?>
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
		
	
</body>
</html>