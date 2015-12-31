<!DOCTYPE html>

<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$arreglo = {};
		
		
		
		$.ajax({
 			type: "POST",
 			url: "control.php",
 			data: { "funcion" :  "listaColaborador" },
 			success: function(data){
 				console.log(data);
 				// var Col2 = JSON.parse(data);
 				var col = JSON.parse(data);
 				$cont = 0;
 				$alt = -1;
 				while(col[$cont]){
 					console.log(col[$cont]);
 					var dato = JSON.parse(col[$cont].datos);
 					if ($alt == 1) {$claseAlt = "class='alt'";}else $claseAlt = '';
 					$("#tblColaboradores tbody").append('<tr '+$claseAlt+'><td>'+dato.codigo+'</td><td>'+dato.nombrec+'</td><td><span class="flechaColaborador boton" valor="'+col[$cont].id+'"><img src="../img/arrow-yellow.png" width="20px" height="auto"></span></td><td></td></tr>');
 					$cont++;
 					$alt = $alt * -1;
 				}
 				// console.log(Col);
 				// 	$("#txtCodigo").val(Col.codigo);
 				// 	$("#txtNombreCorto").val(Col.nombrec);
 				// 	$("#txtNombreLargo").val(Col.nombrel);
 				// 	$("#idColaborador").val($colaborador);
 			}
 		});

 		$(document).on('click','.flechaColaborador',function(){
 			window.location="alta.php?c="+$(this).attr('valor');
 		});

	}); // fin document ready
		

	</script>
	<style type="text/css">
	.datagrid{
		
		
		margin: auto;
	}
	
	</style>
</head>
<body>
	<?php include_once("../header.htm"); ?>
	<div class="cuerpo">
		<h1>Registro de Colaboradores</h1>
		<div class="datagrid">
			<table border="1" id="tblColaboradores">
				<thead>
					<tr>
						<th width="100px">Codigo</th><th width="300px">Nombre</th><th width="20px"></th><th width="20px">[+]</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
		


		<!-- <input	type="hidden" value="0" class="dataColaborador"  name="idColaborador" id="idColaborador">
		<table>
			<tr>
				<td>Codigo</td>	<td><input type="text" class="dataColaborador" id="txtCodigo" name="codigo"></td>
			</tr>
			<tr>
				<td>Nombre Corto</td><td><input type="text" class="dataColaborador" id="txtNombreCorto" name="nombrec"></td>
			</tr>
			<tr>
				<td>Nombre Completo</td><td><input type="text" class="dataColaborador" id="txtNombreLargo" name="nombrel"></td>
			</tr>
			
		</table> -->
		<br><br>

		<input type="button" value="Guardar" id="guardaCliente">
	</div>
		

</body>
</html>