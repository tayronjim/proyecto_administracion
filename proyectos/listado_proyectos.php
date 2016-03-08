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
	 					var facturacion = JSON.parse(obj.Proyectos[$cont].facturacion);

	 					ot = Date.parse(proy.fCIdealY+"-"+proy.fCIdealM+"-"+proy.fCIdealD);
						fechaOvertime = new Date(ot);
						fechaActual = new Date();								
						var timeDiff = fechaOvertime.getTime() - fechaActual.getTime();
						var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	 					if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
	 					$overtime='IN TIME';
	 					$colorOvertime="green";
	 					if(diffDays < 60){$overtime='OVERTIME';$colorOvertime="red";}
	 					$("#tblProyectos tbody").append("<tr "+$claseAlt+"><td>"+proy.posicion+"</td><td>"+cliente.publico+" / "+rs.rs+"</td><td>"+proy.fIniY+"/"+proy.fIniM+"/"+proy.fIniD+"</td><td>"+proy.fCIdealY+"/"+proy.fCIdealM+"/"+proy.fCIdealD+"</td><td>"+estatus.nombre+"</td><td>"+estatus.avance+"</td><td>"+parseFloat(facturacion.porcfacturado).toFixed(2)+"</td><td style='font-weight: bolder;color:"+$colorOvertime+";'>"+$overtime+"</td><td><input type='hidden' value='"+obj.Proyectos[$cont].id+"'><span class='flechaProyecto boton' valor='"+obj.Proyectos[$cont].id+"'><img src='../img/arrow-yellow.png' width='20px' height='auto'></span></td></tr>");
						$cont++;
						$alt = $alt * -1;
	 				}
	 			}
	 		});

	 		$(document).on('click','.flechaProyecto',function(){
	 			//alert($(this).attr('valor'));
	 			window.location="proyectos.php?p="+$(this).attr('valor');
	 		});

		});//Fin Document Ready
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
		<div class="datagrid">
			<table id="tblProyectos">
				<thead>
					<tr>
						<th>Proyecto</th><th>Cliente/RS</th><th>Fecha Inicio</th><th>Fecha Limite</th><th>Estatus</th><th>Avance</th><th>% Facturado</th><th>OVERTIME</th><th></th>
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