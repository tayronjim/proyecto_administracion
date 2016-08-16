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
									
		 							$("#seguimientoActividades").append("<b>Fecha: </b>"+$seguimiento[$cont2].fecha+"<br><a href='proyectos/proyectos.php?p="+obj.Seguimiento[$cont].id_proyecto+"'><b>Proyecto: </b>"+$proyecto.posicion+"</a><br><b>Cliente: </b>"+$cliente.publico+"</a><br><b>Actividad: </b>"+$seguimiento[$cont2].act+"<br><br>");
		 							$contSeguimientos ++;
	 							}
	 							$cont2++;
		 							
	 						}
	 						
	 					$cont++;
	 				}
	 				$("#contSeg").html($contSeguimientos);
	 				
	 			}
	 		});
	 		


			$("#desplegarSeguimiento").click(function(){
				$("#seguimientoActividades").slideToggle("slow");
			});
			$("#seguimientoActividades").css("display","none");

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
</head>
<body>
	<a id='desplegarSeguimiento'>--Seguimiento de Actividades--</a>
	<label id="contSeg" ></label>
	<div id="segActividades">
		<div id="seguimientoActividades"></div>
	</div>
	
</body>
</html>