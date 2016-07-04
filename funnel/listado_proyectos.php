<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>

	<script type="text/javascript">
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
	 					var estatus = JSON.parse(obj[$cont].descripcion)
			 			$("#filtroEstatus").append("<option value='"+estatus.nombre+"'>"+estatus.nombre+"</option>");
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

	 				console.log(obj);

	 				$cont = 0;
	 				$alt = -1;
	 				while(obj.Proyectos[$cont]){
	 					var proy = JSON.parse(obj.Proyectos[$cont].datos_proyecto);
	 					var cliente = JSON.parse(obj.Proyectos[$cont].cliente.otros.datos_cliente);
	 					var rs = JSON.parse(obj.Proyectos[$cont].cliente.otros.facturacion);
	 					var estatus = JSON.parse(obj.Estatus[proy.estatus].descripcion);
	 					var contrato = JSON.parse(obj.Proyectos[$cont].contrato);

	 					console.log(proy);

	 					ot = Date.parse(proy.fCIdealY+"-"+proy.fCIdealM+"-"+proy.fCIdealD);
						fechaOvertime = new Date(ot);
						fechaActual = new Date();
						var timeDiff = fechaOvertime.getTime() - fechaActual.getTime();
						var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	 					if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
	 					$overtime='IN TIME';
	 					$colorOvertime="green";
	 					if(diffDays < 60){$overtime='OVERTIME'; $colorOvertime="red";}
	 					$("#tblProyectos tbody").append("<tr "+$claseAlt+"><td class='colProy'>"+obj.Proyectos[$cont].id+"</td><td class='colCliente'>"+cliente.publico+" / "+rs.rs+"</td><td>"+proy.fechainicio+"</td><td class='colEstatus'>"+estatus.nombre+"</td><td style='font-weight: bolder;color:"+$colorOvertime+";' class='colOvertime'>"+$overtime+"</td><td><input type='hidden' value='"+obj.Proyectos[$cont].id+"'><span class='flechaProyecto boton' valor='"+obj.Proyectos[$cont].id+"'><img src='../img/arrow-yellow.png' width='20px' height='auto'></span></td></tr>");
						$cont++;
						$alt = $alt * -1;
	 				}
	 			}
	 		});

	 		$(document).on('click','.flechaProyecto',function(){
	 			window.location="nuevo_proyecto.php?p="+$(this).attr('valor');
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
			if( $("#filtroEstatus").val() != "-1"){
				$("#tblProyectos tbody > tr:visible > td.colEstatus:not(:contains-ci('" + $("#filtroEstatus").val() + "'))").parent("tr").hide();
			}
			if( $("#filtroOvertime").val() != "-1"){
				$("#tblProyectos tbody > tr:visible > td.colOvertime:not(:contains-ci('" + $("#filtroOvertime").val() + "'))").parent("tr").hide();
			}
			
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

	
	</style>

</head>
<body>
<?php include_once("../header.htm"); ?>
<div class="cuerpo">
	<div class="contenido" style="position: relative; float: left; max-width: 75%;">
		Filtros
		<input type="text" id="filtroProyecto" placeholder="Proyecto" onkeyup="filtraTabla()"><input type="text" id="filtroCliente" placeholder="Cliente" onkeyup="filtraTabla()"><select id="filtroEstatus" onchange="filtraTabla()"><option value="-1"> - Estatus - </option></select><select type="text" id="filtroOvertime" onchange="filtraTabla()"><option value="-1"> - Overtime - </option><option value="OVERTIME">EN OVERTIME</option><option value="IN TIME">EN TIEMPO</option></select>
		<br><br>
		<div class="datagrid">
			<table id="tblProyectos">
				<thead>
					<tr>
						<th>Proyecto</th><th>Cliente/RS</th><th>Fecha Inicio</th><th>Estatus</th><th>OVERTIME</th><th></th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot></tfoot>	
					
			</table>
		</div>
	</div>
		
	<div class="recordatorios" style="position: relative;float: right;">
		<?php // include_once("../recordatorios/recordatorios.php"); ?>
	</div>
</div>
	

	


</body>
</html>