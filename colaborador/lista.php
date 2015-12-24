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
 				while(col[$cont]){
 					console.log(col[$cont]);
 					var dato = JSON.parse(col[$cont].datos);
 					$("#tblColaboradores tbody").append('<tr><td>'+dato.codigo+'</td><td>'+dato.nombrec+'</td><td><span class="flechaColaborador" valor="'+col[$cont].id+'">[ > ]</span></td><td></td></tr>');
 					$cont++;
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
</head>
<body>
	<?php include_once("../header.htm"); ?>
	<h1>Registro de Colaboradores</h1>

	<table border="1" id="tblColaboradores">
		<thead>
			<tr>
				<td>Codigo</td><td>Nombre</td><td>[edit]</td><td>[+]</td>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>


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

</body>
</html>