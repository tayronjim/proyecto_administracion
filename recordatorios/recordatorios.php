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
	 			
	 							ms = Date.parse($seguimiento[$cont2].fecha);
	 							fecha = new Date(ms);
	 							fecha2 = new Date();								
	 							var timeDiff = fecha.getTime() - fecha2.getTime();
								var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	 							
	 							$("#seguimientoActividades").append("<b>Fecha: </b>"+$seguimiento[$cont2].fecha+"<br><a href='proyectos/proyectos.php?p="+obj.Seguimiento[$cont].id_proyecto+"'><b>Proyecto: </b>"+obj.Seguimiento[$cont].id_proyecto+"</a><br><b>Actividad: </b>"+$seguimiento[$cont2].act+"<br><br>")
	 							$cont2++;
	 						}
	 						//$jsonObj.push($arreglo);
	 					$contSeguimientos = $contSeguimientos + $cont2;
	 					
	 					$cont++;
	 				}
	 				$("#contSeg").html($contSeguimientos);
	 				
	 				//$jsonObj.sort();
	 			}
	 		});
	 		$.ajax({
	 			type: "POST",
	 			url: "/proyecto_administracion/recordatorios/control.php",
	 			data: { "funcion" : "datosProyectos"},
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				$inOvertime = 0;
	 				$contGarantia = 0;
	 				$cont=0;
	 				$totalMesActual = 0;
					$totalMesAnterior = 0;
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
							$("#proyectosEnCierre").append("<b>Fecha: </b>"+fIdeal+"<br><a href='proyectos/proyectos.php?p="+obj.proyecto[$cont].id+"'><b>Proyecto: </b>"+obj.proyecto[$cont].id+"</a>");
							$inOvertime ++;
							if (diffDays < 31) {
								$("#proyectosEnCierre").append("<br><br>");
							}
						}

						if ($datos_proyecto.estatus == "8") {
							
							$FG = $datos_contrato.fGarantiaY+"-"+$datos_contrato.fGarantiaM+"-"+$datos_contrato.fGarantiaD;
							$fGarantia = Date.parse($FG);
							fecha2 = new Date($fGarantia);
							hoy2 = new Date();
							var timeDiff2 = fecha2.getTime() - hoy2.getTime();
							var diffDays2 = Math.ceil(timeDiff2 / (1000 * 3600 * 24));
								
							if (diffDays2 < 6) { 
								$("#proyectosEnGarantia5").append("<b>Fecha: </b>"+$FG+"<br><a href='proyectos/proyectos.php?p="+obj.proyecto[$cont].id+"'><b>Proyecto: </b>"+obj.proyecto[$cont].id+"</a><br><br>");
								$contGarantia ++;
							}else{
								if (diffDays2 < (parseInt($datos_contrato.garantia)/2)) {
									$("#proyectosEnGarantia50").append("<b>Fecha: </b>"+$FG+"<br><a href='proyectos/proyectos.php?p="+obj.proyecto[$cont].id+"'><b>Proyecto: </b>"+obj.proyecto[$cont].id+"</a><br><br>");
									$contGarantia ++;
								}
							}
						}


						//   Facturado al mes y mes anterior  -------->>

						hoy = new Date();
						mesActual = hoy.getMonth();
						
						console.log($datos_facturacion);
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

			$("#desplegarSeguimiento").click(function(){
				$("#seguimientoActividades").slideToggle("slow");
			});
			$("#seguimientoActividades").css("display","none");

			$("#desplegarCierres").click(function(){
				$("#proyectosEnCierre").slideToggle("slow");
			});
			$("#proyectosEnCierre").css("display","none");

			$("#desplegarGarantias").click(function(){
				$("#proyectosEnGarantia50").slideToggle("slow");
				$("#proyectosEnGarantia5").slideToggle("slow");
			});
			$("#proyectosEnGarantia50").css("display","none");
			$("#proyectosEnGarantia5").css("display","none");

			$("#desplegarFacturado").click(function(){
				$("#facturasPagadasActual").slideToggle("slow");
				$("#facturasPagadasAnterior").slideToggle("slow");
			});
			$("#facturasPagadasActual").css("display","none");
			$("#facturasPagadasAnterior").css("display","none");

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
	<br>

	<a id='desplegarCierres'>--Proyectos en Overtime--</a>
	<label id="contCierre" ></label>
	<div id="EnCierre"><div id="proyectosEnCierre"></div></div>

	<a id='desplegarGarantias'>--Garantia--</a>
	<label id="contGarantia" ></label>
	<div id="proyectosEnGarantia">
		<div id="proyectosEnGarantia5"><b>Menos de 5 dias:</b><br></div>
		<div id="proyectosEnGarantia50"><b>Mitad de tiempo:</b><br></div>
		
	</div>

	<a id='desplegarFacturado'>--Facturado Reciente--</a>
	<label id="contFacturado" style="float: right; padding-right: 10px;">$ </label>
	<div id="proyectosFacturados">
		<div id="facturasPagadasActual"><b>-Facturado Mes Actual:</b><label style="float: right; padding-right: 10px;">$ </label></div>
		<div id="facturasPagadasAnterior"><b>-Facturado Mes Anterior:</b><label style="float: right; padding-right: 10px;">$ </label></div>
		
	</div>
		
	<br>
</body>
</html>