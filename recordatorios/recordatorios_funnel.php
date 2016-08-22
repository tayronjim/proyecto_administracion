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

	 						$cont2 = 0;
	 						while($seguimiento[$cont2]){	 			
	 							ms = Date.parse($seguimiento[$cont2].fecha);
	 							fecha = new Date(ms);
	 							fecha2 = new Date();								
	 							var timeDiff = fecha.getTime() - fecha2.getTime();
								var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
								console.log($proyecto);
								switch($proyecto.proyectoRequerido){
			 						case "1": $nombre_proyecto = "Contrata"; break;
			 						case "2": $nombre_proyecto = "Busqueda de Talento"; break;
			 						case "3": $nombre_proyecto = "Mapeo de Talento"; break;
			 						case "4": $nombre_proyecto = "Talent Management"; break;
			 						default: $nombre_proyecto = ""; break;
			 					}
	 							if (parseInt(diffDays) == 0) {
									
		 							$("#segActividadesHoy").append("<div class='segActividades'><b><a href='proyectos/proyectos.php?p="+obj.Seguimiento[$cont].id_proyecto+"'>"+$nombre_proyecto+"</a></b><br><b>Cliente: </b>"+$cliente.publico+"</a><br><b>Actividad: </b>"+$seguimiento[$cont2].act+"<br><br></div>");
		 							$contSeguimientosHoy ++;
	 							}
	 							if (parseInt(diffDays) < 0) {
									
		 							$("#segActividadesPas").append("<div class='segActividades'>"+$seguimiento[$cont2].fecha+" ("+parseInt(diffDays)*-1+" dias atras)<br><a href='proyectos/proyectos.php?p="+obj.Seguimiento[$cont].id_proyecto+"'><b>"+$nombre_proyecto+"</a></b><br><b>Cliente: </b>"+$cliente.publico+"</a><br><b>Actividad: </b>"+$seguimiento[$cont2].act+"<br><br></div>");
		 							$contSeguimientosPas ++;
	 							}
	 							if (parseInt(diffDays) > 0 && parseInt(diffDays) <= 4) {
									
		 							$("#segActividadesFut").append("<div class='segActividades'><b>Fecha: </b>"+$seguimiento[$cont2].fecha+"<br><a href='proyectos/proyectos.php?p="+obj.Seguimiento[$cont].id_proyecto+"'><b>Proyecto: </b>"+$nombre_proyecto+"</a><br><b>Cliente: </b>"+$cliente.publico+"</a><br><b>Actividad: </b>"+$seguimiento[$cont2].act+"<br><br></div>");
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
		.infoBox{
			width: 380px;
			border: 2px solid GRAY;
			margin: 5px;
			max-height: 380px;
			min-height: 45px;
			overflow: auto;


		}
		.infoBoxTitulo{
			float: left;
			width: 350px;
			height: 30px;
			background-color: GRAY;
			margin: 5px;

		}
		.contSeg{
			float: right;
			color: RED;
		}
		.segActividades{
			float: left;
			border: 1px solid black;
			border-radius: 2px;
			margin: 2px;
			background-color: #defdef;
			width: 350px;
		}
	</style>
</head>
<body>
	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarSeguimientoHoy'>--Seguimientos Para Hoy--<label class="contSeg" id="contSegHoy" ></label></a>
		<div id="segActividadesHoy">
			
		</div>
	</div>
	
	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarSeguimientoPas'>--Seguimientos Atrasados--<label class="contSeg" id="contSegPas" ></label></a>
		<div  id="segActividadesPas">
			
		</div>
	</div>
	
	<div class="infoBox">
		<a class="infoBoxTitulo" id='desplegarSeguimientoFut'>--Seguimientos Por Venir--<label class="contSeg" id="contSegFut" ></label></a>
		<div id="segActividadesFut">
			
		</div>
	</div>
		
	
</body>
</html>