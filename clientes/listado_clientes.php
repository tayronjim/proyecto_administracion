<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("li").removeClass( "current" )
			$("#menuClientes").addClass('current');
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "listado" },
	 			success: function(data){
	 				console.log(data);
	 				var obj = JSON.parse(data);
	 				$cont = 0;
	 				$alt = -1;
	 				while(obj.Cliente[$cont]){
	 					console.log(obj.Cliente[$cont]);
	 					var datos = JSON.parse(obj.Cliente[$cont].datos_cliente);
	 					console.log(datos);
	 					if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
	 					$("#tblClientes tbody").append("<tr "+$claseAlt+"><td>"+datos.codigo+"</td><td>"+datos.publico+"</td><td><span class='flechaClientes boton' valor='"+obj.Cliente[$cont].id+"'><img src='../img/arrow-yellow.png' width='20px' height='auto'></span></td></tr>");
						$cont++;
						$alt = $alt * -1;
	 				}
	 			}
	 		});

	 		$(document).on('click','.flechaClientes',function(){
	 			window.location="clientes.php?c="+$(this).attr('valor');
	 		});

		});
	</script>
	<style type="text/css">
	.datagrid{
		max-width: 80%;
		margin: auto;
	}
	
	</style>
</head>
<body>
<?php include_once("../header.htm"); ?>
<div class="cuerpo" >
	<div class="contenido" style="position: relative; float: left;">
		<h1>Listado de Cliente</h1>

		<div class="datagrid">
			<table id="tblClientes" border="1">
				<thead>
					<tr>
						<th>Codigo</th><th>Nombre Comercial</th><th></th>
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