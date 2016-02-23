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
	 			data: { "funcion" : "seguimientos"},
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				//console.log(obj);
	 				$cont=0;
	 				$contSeguimientos = 0;
	 				$jsonObj = {};
	 				$arreglo = [100][100];
	 				
	 				while(obj.Seguimiento[$cont]){
	 					
	 					var $seguimiento = JSON.parse(obj.Seguimiento[$cont].seguimiento);
	 						$cont2 = 0;
	 						while($seguimiento[$cont2]){
	 							$fechaCadena = $seguimiento[$cont2].fecha.replace(/-/g,"");
								//$array.push($seguimiento[$cont2].act);
	 							//$arreglo[$fechaCadena].push($seguimiento[$cont2].act);
	 							ms = Date.parse($seguimiento[$cont2].fecha);
	 							fecha = new Date(ms);
	 							fecha2 = new Date();								
	 							var timeDiff = fecha.getTime() - fecha2.getTime();
								var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	 							console.log(diffDays);
	 							$("#seguimientoActividades").append("<b>Fecha: </b>"+$seguimiento[$cont2].fecha+"<br><a href='proyectos/proyectos.php?p="+obj.Seguimiento[$cont].id_proyecto+"'><b>Proyecto: </b>"+obj.Seguimiento[$cont].id_proyecto+"</a><br><b>Actividad: </b>"+$seguimiento[$cont2].act+"<br><br>")
	 							$cont2++;
	 						}
	 						//$jsonObj.push($arreglo);
	 					$contSeguimientos = $contSeguimientos + $cont2;
	 					
	 					$cont++;
	 				}
	 				$("#contSeg").html($contSeguimientos);
	 				
	 				//$jsonObj.sort();
	 					console.log($arreglo);
	 			}
	 		});
	 		$.ajax({
	 			type: "POST",
	 			url: "/proyecto_administracion/recordatorios/control.php",
	 			data: { "funcion" : "enFechaDeCierre"},
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				$inOvertime = 0;
	 				$cont=0;
	 				while(obj.Cierre[$cont]){
	 					var $datos_proyecto = JSON.parse(obj.Cierre[$cont].datos_proyecto);
	 					fIdeal = $datos_proyecto.fCIdealY+"-"+$datos_proyecto.fCIdealM+"-"+$datos_proyecto.fCIdealD;
	 					fI = Date.parse(fIdeal);
	 					fecha = new Date(fI);
	 					hoy = new Date();								
						var timeDiff = fecha.getTime() - hoy.getTime();
						var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
						if (diffDays < 31) {
							$("#proyectosEnCierre").append("<b>Fecha: </b>"+fIdeal+"<br><a href='proyectos/proyectos.php?p="+obj.Cierre[$cont].id+"'><b>Proyecto: </b>"+obj.Cierre[$cont].id+"</a><br><br>");
							$inOvertime ++;

						}
						
	 					$cont ++;
	 				}
	 				if ($inOvertime > 0) {
	 					$("#contCierre").html($inOvertime);
	 				}
	 				else {$("#contCierre").html();}
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
	</script>
</head>
<body>
	<a id='desplegarSeguimiento'>--Seguimiento de Actividades--</a><label id="contSeg" style="color:red; position: relative; margin-left: 13px; top: 10px; font-size:14px; font-weight: bold;"></label><div id="seguimientoActividades"></div><br>
	<a id='desplegarCierres' style="margin-top: 10px;">--Proyectos en Overtime--</a><label id="contCierre" style="color:red; position: relative; margin-left: 13px; top: 25px; font-size:14px; font-weight: bold;"></label><div id="proyectosEnCierre"></div>
</body>
</html>