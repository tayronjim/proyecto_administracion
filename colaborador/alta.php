<!DOCTYPE html>

<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$arreglo = {};
		$filasRS=0;
		<?php 
			$colaborador = "";
			if(isset($_GET['c'])){
				$colaborador = $_GET['c'];
			}
				
		 ?>
		
		$colaborador = "<?php echo $colaborador; ?>";
		
		if ($colaborador != "") {
			
			
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" :  "buscaColaborador", "id":$colaborador },
	 			success: function(data){
	 				console.log(data);
	 				var Col2 = JSON.parse(data);
	 				var Col = JSON.parse(Col2.datos);
	 				console.log(Col);
	 					$("#txtCodigo").val(Col.codigo);
	 					$("#txtNombreCorto").val(Col.nombrec);
	 					$("#txtNombreLargo").val(Col.nombrel);
	 					$("#idColaborador").val($colaborador);
	 			}
	 		});
	 		
		};
		$("#guardaCliente").click(function(){
			
			$(".dataColaborador").each(function(){
				$arreglo[$(this).attr('name')] = $(this).val();
			});console.log($arreglo);	
			$funcion = "guardaColaborador";
			if ($colaborador != "") {
				$funcion = "actualizaColaborador";
			}
			
			guardaColabodaor($funcion);
		});

	}); // fin document ready
		function guardaColabodaor($funcion){

		     $datos = JSON.stringify($arreglo);
		     $id = $("#idColaborador").val();
		     console.log($funcion);

		     $.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : $funcion, "datos" : $datos, "id" : $id },
	 			success: function(data){
	 				console.log(data);
	 				// var obj = JSON.parse(data);
	 				
	 			}
	 		});
		
		}

	</script>
</head>
<body>
	<?php include_once("../header.htm"); ?>
	<h1>Registro de Colaboradores</h1>
	<input	type="hidden" value="0" class="dataColaborador"  name="idColaborador" id="idColaborador">
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
		
	</table>
	<br><br>

	<input type="button" value="Guardar" id="guardaCliente">

</body>
</html>