<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
	 			type: "POST",
	 			url: "/proyecto_administracion/recordatorios/control.php",
	 			data: { "funcion" : "seguimientos"},
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				$cont=0;
	 				$jsonObj = {};
	 				$arreglo = [100][100];
	 				
	 				while(obj.Seguimiento[$cont]){
	 					
	 					var $seguimiento = JSON.parse(obj.Seguimiento[$cont].seguimiento);
	 						$cont2 = 0;
	 						while($seguimiento[$cont2]){
	 							$fechaCadena = $seguimiento[$cont2].fecha.replace(/-/g,"");
								//$array.push($seguimiento[$cont2].act);
	 							$arreglo[$fechaCadena].push($seguimiento[$cont2].act);
	 							$("#seguimientoActividades").append("<b>Fecha: </b>"+$seguimiento[$cont2].fecha+"<br><b>Proyecto: </b>"+obj.Seguimiento[$cont].id_proyecto+"<br><b>Actividad: </b>"+$seguimiento[$cont2].act+"<br><br>")
	 							$cont2++;
	 						}
	 						//$jsonObj.push($arreglo);

	 					
	 					$cont++;
	 				}
	 				//$jsonObj.sort();
	 					console.log($arreglo);
	 			}
	 		});

		});
	</script>
</head>
<body>
	<div id="seguimientoActividades"></div>
</body>
</html>