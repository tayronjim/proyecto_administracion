<!DOCTYPE html>
<html>
<head>
	<?php include_once("librerias_base.htm"); ?>

	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
	 			type: "POST",
	 			url: "proyectos/control.php",
	 			data: { "funcion" : "listadoInicialProyectos" },
	 			success: function(data){
	 				console.log(data);
	 				var obj = JSON.parse(data);
	 				$cont = 0;
	 				
	 				while(obj.Proyectos[$cont]){
	 					$("#tblProyectos tbody").append("<tr><td>"+obj.Proyectos[$cont].proy_titulo+"</td><td>"+obj.Proyectos[$cont].clave+"</td><td>"+obj.Proyectos[$cont].nombre_comercial+" / "+obj.Proyectos[$cont].razon_social+"</td><td>"+obj.Proyectos[$cont].proy_alta+"</td><td>"+obj.Proyectos[$cont].proy_cierre_ideal+"</td><td>"+obj.Proyectos[$cont].proy_estatus+"</td><td>%</td><td><input type='hidden' value='"+obj.Proyectos[$cont].proy_id+"'><span class='flechaProyecto' valor='"+obj.Proyectos[$cont].proy_id+"'>-></span<</td></tr>");
						$cont++;
	 				}
	 			}
	 		});

	 		$(document).on('click','.flechaProyecto',function(){
	 			//alert($(this).attr('valor'));
	 			window.location="proyectos/proyectos.php?p="+$(this).attr('valor');
	 		});

		});//Fin Document Ready
	</script>

</head>
<body>
<?php include_once("header.htm"); ?>

<table id="tblProyectos" border="1">
	<thead>
		<tr>
			<td>Proyecto</td><td>Cod. Cliente</td><td>Cliente/RS</td><td>Fecha Inicio</td><td>Fecha Limite</td><td>Estatus</td><td>% Avance</td>
		</tr>
	</thead>
	<tbody></tbody>
	<tfoot></tfoot>	
		
</table>


</body>
</html>