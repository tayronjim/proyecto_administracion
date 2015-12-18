<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "listado" },
	 			success: function(data){
	 				console.log(data);
	 				var obj = JSON.parse(data);
	 				$cont = 0;
	 				
	 				while(obj.Cliente[$cont]){
	 					$("#tblClientes tbody").append("<tr><td>"+obj.Cliente[$cont].clave+"</td><td>"+obj.Cliente[$cont].nombre_comercial+"</td><td><span class='flechaClientes' valor='"+obj.Cliente[$cont].id+"'>-></span></td></tr>");
						$cont++;
	 				}
	 			}
	 		});

	 		$(document).on('click','.flechaClientes',function(){
	 			//alert($(this).attr('valor'));
	 			window.location="clientes.php?c="+$(this).attr('valor');
	 		});

		});
	</script>
</head>
<body>
<?php include_once("../header.htm"); ?>

<h1>Listado de Cliente</h1>

<table id="tblClientes" border="1">
	<thead>
		<tr>
			<td>Codigo</td><td>Nombre Comercial</td><td></td>
		</tr>
	</thead>
	<tbody></tbody>
	<tfoot></tfoot>	
		
</table>



</body>
</html>