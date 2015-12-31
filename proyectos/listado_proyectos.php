<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>

	<script type="text/javascript">
		$(document).ready(function(){
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
	 					if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
	 					$("#tblProyectos tbody").append("<tr "+$claseAlt+"><td>"+proy.posicion+"</td><td>"+cliente.codigo+"</td><td>"+cliente.publico+" / "+rs.rs+"</td><td>"+proy.fIniY+"/"+proy.fIniM+"/"+proy.fIniD+"</td><td>"+proy.fCIdealY+"/"+proy.fCIdealM+"/"+proy.fCIdealD+"</td><td>"+estatus.nombre+"</td><td>"+estatus.avance+"</td><td><input type='hidden' value='"+obj.Proyectos[$cont].id+"'><span class='flechaProyecto boton' valor='"+obj.Proyectos[$cont].id+"'><img src='../img/arrow-yellow.png' width='20px' height='auto'></span></td></tr>");
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
	<div class="datagrid">
		<table id="tblProyectos">
			<thead>
				<tr>
					<th>Proyecto</th><th>Cod. Cliente</th><th>Cliente/RS</th><th>Fecha Inicio</th><th>Fecha Limite</th><th>Estatus</th><th>% Avance</th><th></th>
				</tr>
			</thead>
			<tbody></tbody>
			<tfoot></tfoot>	
				
		</table>
	</div>
</div>
	

	


</body>
</html>