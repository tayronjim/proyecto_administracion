<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>

	<script type="text/javascript">
				$estatus = Array(11);
					for($i=0;$i<=10;$i++){
						$estatus[$i] = 0;
				}
		$(document).ready(function(){
			$("li").removeClass( "current" )
			$("#menuFunnel").addClass('current');
			
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "buscaEstatus" },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				$cont = 0;
	 				while(obj[$cont]){
	 					console.log(obj[$cont]);
	 					var estatus = JSON.parse(obj[$cont].descripcion)
			 			//$("#filtroEstatus").append("<option value='"+estatus.nombre+"'>"+estatus.nombre+"</option>");
			 			if (estatus.clave == "7" || estatus.clave == "9" || estatus.clave == "10") {
			 				$checked = "";
			 			}
			 			else{$checked = "checked";}
			 			$("#filtroEstatus").append("<input type='checkbox' onchange='filtraTabla()' class='filtroEstatus' "+$checked+" value='"+estatus.nombre+"'><label>"+estatus.nombre+"</label><br>");
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
	 					var contrato = JSON.parse(obj.Proyectos[$cont].contrato);

	 					

	 					ot = Date.parse(proy.fCIdealY+"-"+proy.fCIdealM+"-"+proy.fCIdealD);
						fechaOvertime = new Date(ot);
						fechaActual = new Date();
						var timeDiff = fechaOvertime.getTime() - fechaActual.getTime();
						var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	 					if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
	 					//$overtime='IN TIME';
	 					//$colorOvertime="green";
	 					//if(diffDays < 60){$overtime='OVERTIME'; $colorOvertime="red";}
	 					switch(proy.proyectoRequerido){
	 						case "1": $nombre_proyecto = "Contrata"; break;
	 						case "2": $nombre_proyecto = "Busqueda de Talento"; break;
	 						case "3": $nombre_proyecto = "Mapeo de Talento"; break;
	 						case "4": $nombre_proyecto = "Talent Management"; break;
	 						default: $nombre_proyecto = ""; break;
	 					}

	 					switch(estatus.clave){
							case '1': $estatus[1] = $estatus[1] + 1; break;
							case '2': $estatus[2] = $estatus[2] + 1; break;
							case '3': $estatus[3] = $estatus[3] + 1; break;
							case '4': $estatus[4] = $estatus[4] + 1; break;
							case '5': $estatus[5] = $estatus[5] + 1; break;
							case '6': $estatus[6] = $estatus[6] + 1; break;
							case '7': $estatus[7] = $estatus[7] + 1; break;
							case '8': $estatus[8] = $estatus[8] + 1; break;
							case '9': $estatus[9] = $estatus[9] + 1; break;
							case '10': $estatus[10] = $estatus[10] + 1; break;
							case '10': $estatus[0] = $estatus[0] + 1; break;
							
						}
	 					
	 					$("#tblProyectos tbody").append("<tr "+$claseAlt+"><td class='colProy'>"+$nombre_proyecto+"</td><td class='colCliente'>"+cliente.publico+" / "+rs.rs+"</td><td>"+proy.fechainicio+"</td><td class='colEstatus'>"+estatus.nombre+"</td><td><input type='hidden' value='"+obj.Proyectos[$cont].id+"'><span class='flechaProyecto boton' valor='"+obj.Proyectos[$cont].id+"'><img src='../img/arrow-yellow.png' width='20px' height='auto'></span></td></tr>");
						$cont++;
						$alt = $alt * -1;
	 				}
	 				filtraTabla();
	 			}

	 		});

	 		$(document).on('click','.flechaProyecto',function(){
	 			window.location="nuevo_proyecto.php?p="+$(this).attr('valor');
	 		});

	 		

		});//Fin Document Ready
		function filtraTabla(){
			//alert($(".filtroProyecto:not(:checked)").attr('valor'));
			$("#tblProyectos tbody > tr").show();
			//if( $(".filtroProyecto").val() != "0"){
			$(".filtroProyecto:not(:checked)").each(function(){
				$("#tblProyectos tbody > tr:visible > td.colProy:contains-ci('" + $(this).val() + "')").parent("tr").hide();
			});
				
			//}
 			if( $("#filtroCliente").val() != ""){
				$("#tblProyectos tbody > tr:visible > td.colCliente:not(:contains-ci('" + $("#filtroCliente").val() + "'))").parent("tr").hide();
			}
			//if( $("#filtroEstatus").val() != "-1"){
			$(".filtroEstatus:not(:checked)").each(function(){
				$("#tblProyectos tbody > tr:visible > td.colEstatus:contains-ci('" + $(this).val() + "')").parent("tr").hide();
			});
				
			//}
			
			
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
	


.seguimientos{
	
	width: auto;
	
	position: relative;
	float: right;
	background-color: rgba(255,255,255,0.4);
	color:#000;
	
}
.tblFiltros td{
	vertical-align: top;
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
					<input type="checkbox" class="filtroProyecto" value="Contrata" onchange="filtraTabla()" checked> <label>Contrata</label><br>
					<input type="checkbox" class="filtroProyecto" value="Busqueda de Talento" onchange="filtraTabla()" checked> <label>Busqueda de Talento</label><br>
					<input type="checkbox" class="filtroProyecto" value="Mapeo de Talento" onchange="filtraTabla()" checked> <label>Mapeo de Talento</label><br>
					<input type="checkbox" class="filtroProyecto" value="Talent Management" onchange="filtraTabla()" checked> <label>Talent Management</label>
					<!-- <select type="text" id="filtroProyecto" onchange="filtraTabla()">
						<option value="0">Todos</option>
						<option value="1">Contrata</option>
						<option value="2">Busqueda de Talento</option>
						<option value="3">Mapeo de Talento</option>
						<option value="4">Talent Management</option>
					</select> -->
				</td>
			</tr>
			<tr>
				<td>
					<label class="txtmini"><b>Cliente:</b></label><br>
					<input type="text" id="filtroCliente" onkeyup="filtraTabla()">
				</td>
			</tr>
			<tr>
				<td>
					<label class="txtmini"><b>Estatus:</b></label><br>
					<div id="filtroEstatus"></div>
					<!--- <select id="filtroEstatus" onchange="filtraTabla()"><option value="-1"> - Todos - </option></select> -->
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
						<th>Proyecto</th><th>Cliente/RS</th><th>Fecha Inicio</th><th>Estatus</th><th></th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot></tfoot>	
					
			</table>
		</div>
	</div>
		
	<div class="seguimientos" style="position: relative;">
		
		<?php  include_once("../recordatorios/recordatorios_funnel.php"); ?>
	</div>
</div>

</body>
</html>
