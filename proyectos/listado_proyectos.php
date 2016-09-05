<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>

	<script type="text/javascript">
		$(document).ready(function(){
			$("li").removeClass( "current" )
			$("#menuProyectos").addClass('current');
			
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "buscaEstatus" },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				$cont = 0;
	 				while(obj[$cont]){
	 					var estatus = JSON.parse(obj[$cont].descripcion);

	 					if (estatus.id == "8" || estatus.id == "9" || estatus.id == "11") {
			 				$checked = "";
			 			}
			 			else{$checked = "checked";}
			 			//$("#filtroEstatus").append("<option value='"+estatus.nombre+"'>"+estatus.nombre+"</option>");
			 			if (parseInt(estatus.id) > 0) {
								$("#filtroEstatus").append("<input type='checkbox' onchange='filtraTabla()' class='filtroEstatus' "+$checked+" value='"+estatus.nombre+"'><label>"+estatus.nombre+"</label><br>");
							}
			 				
			 			
	 					$cont ++ ;
	 				}
	 			}
	 		});

			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "listadoInicialProyectos" },
	 			success: function(data){
	 				
	 				var obj = JSON.parse(data);
	 				
	 				$cont = 0;
	 				$alt = -1;
	 				while(obj.Proyectos[$cont]){
	 					var proy = JSON.parse(obj.Proyectos[$cont].datos_proyecto);
	 					var cliente = JSON.parse(obj.Proyectos[$cont].cliente.otros.datos_cliente);
	 					var rs = JSON.parse(obj.Proyectos[$cont].cliente.otros.facturacion);
	 					var estatus = JSON.parse(obj.Estatus[proy.estatus].descripcion);
	 					var facturacion = JSON.parse(obj.Proyectos[$cont].facturacion);

	 					ot = Date.parse(proy.fCIdealY+"-"+proy.fCIdealM+"-"+proy.fCIdealD);
						fechaOvertime = new Date(ot);
						fechaActual = new Date();								
						var timeDiff = fechaOvertime.getTime() - fechaActual.getTime();
						var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	 					if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
	 					$overtime='IN TIME';
	 					$colorOvertime="green";
	 					switch(proy.proyectoRequerido){
	 						case "1": $nombre_proyecto = "Contrata"; break;
	 						case "2": $nombre_proyecto = "Busqueda de Talento"; break;
	 						case "3": $nombre_proyecto = "Mapeo de Talento"; break;
	 						case "4": $nombre_proyecto = "Talent Management"; break;
	 						default: $nombre_proyecto = ""; break;
	 					}
	 					if(diffDays < 60){$overtime='OVERTIME';$colorOvertime="red";}
	 					$("#tblProyectos tbody").append("<tr "+$claseAlt+"><td class='colProy'>"+$nombre_proyecto+"<br>"+proy.proyectoReq+"</td><td class='colCliente'>"+cliente.publico+"</td><td class='colEstatus'>"+estatus.nombre+"</td><td>"+estatus.avance+"</td><td style='font-weight: bolder;color:"+$colorOvertime+";' class='colOvertime'>"+$overtime+"</td><td><input type='hidden' value='"+obj.Proyectos[$cont].id+"'><span class='flechaProyecto boton' valor='"+obj.Proyectos[$cont].id+"'><img src='../img/arrow-yellow.png' width='20px' height='auto'></span></td></tr>");
						$cont++;
						$alt = $alt * -1;
	 				}
	 				filtraTabla();
	 			}
	 		});

	 		$(document).on('click','.flechaProyecto',function(){
	 			window.location="proyectos.php?p="+$(this).attr('valor');
	 		});

	 		// Filtros Listado
	 		$("#filtroProyecto, #filtroCliente, #filtroEstatus").on('keyup',function(){
	 			
 			
			
			  });

		});//Fin Document Ready
		function filtraTabla(){
			$("#tblProyectos tbody > tr").show();
			if( $("#filtroProyecto").val() != ""){
				$("#tblProyectos tbody > tr:visible > td.colProy:not(:contains-ci('" + $("#filtroProyecto").val() + "'))").parent("tr").hide();
			}
 			if( $("#filtroCliente").val() != ""){
				$("#tblProyectos tbody > tr:visible > td.colCliente:not(:contains-ci('" + $("#filtroCliente").val() + "'))").parent("tr").hide();
			}
			
			$(".filtroEstatus:not(:checked)").each(function(){
				$("#tblProyectos tbody > tr:visible > td.colEstatus:contains-ci('" + $(this).val() + "')").parent("tr").hide();
			});
				
			
			
			$(".filtroOvertime:not(:checked)").each(function(){
				$("#tblProyectos tbody > tr:visible > td.colOvertime:contains-ci('" + $(this).val() + "')").parent("tr").hide();
			});
			
		}
		
	

	// jQuery expression for case-insensitive filter
	$.extend($.expr[":"], 
	{
	    "contains-ci": function(elem, i, match, array) 
		{
			return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
		}
	});

	</script>
	<style type="text/css">
	.datagrid{
		

	}
	.tblFiltros label{
		font-size: 12px;
	}
	label.txtmini{
		font-size: 14px;
	}
	#areaFiltros{
		float: left;
		height: 100%;
		width: auto;
		position: relative;
	}

	
	</style>

</head>
<body>
<?php include_once("../header.htm"); ?>
<div class="cuerpo">
	<div id="areaFiltros">
		
		<table class="tblFiltros">
			<tr>
				<td>
					<label class="txtmini"><b>Proyecto:</b></label><br>
					<input type="text" id="filtroProyecto" onkeyup="filtraTabla()"><br><br>
				</td>
			</tr>
			<tr>
				<td>
					<label class="txtmini"><b>Clientes:</b></label><br>
					<input type="text" id="filtroCliente" onkeyup="filtraTabla()"><br><br>
				</td>
			</tr>
			<tr>
				<td>
					<label class="txtmini"><b>Estatus:</b></label><br>
					<div id="filtroEstatus"></div><br>
				</td>
			</tr>
			<tr>
				<td>
					<label class="txtmini"><b>Overtime:</b></label><br>
					<input type='checkbox' onchange='filtraTabla()' class="filtroOvertime" checked value='OVERTIME'><label>EN OVERTIME</label><br>
					<input type='checkbox' onchange='filtraTabla()' class="filtroOvertime" checked value='IN TIME'><label>EN TIEMPO</label><br>
					
				</td>
			</tr>
		</table>
	
		
		
	</div>
	<div class="contenido" style="position: relative; float: left; max-width: 75%;">
		
		<br><br>
		<div class="datagrid">
			<table id="tblProyectos">
				<thead>
					<tr>
						<th>Proyecto</th><th>Cliente</th><th>Estatus</th><th>Avance</th><th>OVERTIME</th><th></th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot></tfoot>	
					
			</table>
		</div>
	</div>
		
	<div class="recordatorios" style="position: relative;float: right;">
		<?php include_once("../recordatorios/recordatorios.php"); ?>
	</div>
</div>
	

	


</body>
</html>