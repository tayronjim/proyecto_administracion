<!DOCTYPE html>

<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
	$(document).ready(function(){
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
	 			data: { "funcion" :  "buscaColaborador", "colaborador":$colaborador },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				
	 				
	 					//$arregloTabla[$cont] = obj.Cliente[$cont];
	 					//$("#listaClientes").append("<option value='"+obj.Cliente[$cont].id+"'>"+obj.Cliente[$cont].nombre_comercial+"</option>");
	 					$("#txtCodigo").val(obj.Col[0].clave);
	 					$("#txtNombreCorto").val(obj.Col[0].nombre_comercial);
	 					$("#txtNombreLargo").val(obj.Col[0].fecha_alta);
	 					$("#idColaborador").val(obj.Col[0].id);
	 					//$facturacion = obj.Cliente[0].facturacion;
	 					//$("#txtFechaAlta").attr('disabled','true');
	 			// 	console.log($facturacion);
					// var objFac = JSON.parse($facturacion);
					// $cont = 0;
					// while(objFac[$cont]){
					// 	console.log(objFac[$cont]);
					// 	$filasRS = objFac[$cont].idfac;
					// 	console.log($filasRS);
					// 	$("#tblRS tbody").append('<tr id="filaRS_'+$filasRS+'"><td><span id="btnMenosRS_'+$filasRS+'">[-]</span><input type="hidden" value="'+$filasRS+'" class="registroFacturacion"><input type="hidden" class="datoFac_'+$filasRS+'" id="idFac_'+$filasRS+'" name="idfac" value="'+$filasRS+'"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRS_'+$filasRS+'" name="rs" value="'+objFac[$cont].rs+'"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRFC_'+$filasRS+'" name="rfc" value="'+objFac[$cont].rfc+'"></td><td><input type="radio" class="datoFac_'+$filasRS+'" id="txtprimario_'+$filasRS+'" name="primario" value="'+objFac[$cont].primario+'" onclick="valorRadioTrue('+$filasRS+')"></td><td>[Edit]</td><td></td></tr>');
					// 	if ($("#txtprimario_"+$filasRS).val() == 1) {
					// 		$("#txtprimario_"+$filasRS).attr('checked',true);
					// 	};
					// 	$cont++;
					// }
					// $filasRS++;
	 			}
	 		});

	 		// $.ajax({
	 		// 	type: "POST",
	 		// 	url: "control.php",
	 		// 	data: { "funcion" :  "buscaRS", "cliente":$cliente },
	 		// 	success: function(data){

	 				
	 		// 	}
	 		// });
		};
		$("#guardaCliente").click(function(){
			guardaCliente();
		});

		// $("#btnMasRS").click(function(){
		// 		$("#tblRS tbody").append('<tr id="filaRS_'+$filasRS+'"><td><span id="btnMenosRS_'+$filasRS+'">[-]</span><input type="hidden" value="'+$filasRS+'" class="registroFacturacion"><input type="hidden" class="datoFac_'+$filasRS+'" id="idFac_'+$filasRS+'" name="idfac" value="'+$filasRS+'"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRS_'+$filasRS+'" name="rs"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRFC_'+$filasRS+'" name="rfc" ></td><td><input type="radio" class="datoFac_'+$filasRS+'" id="txtprimario_'+$filasRS+'" name="primario" value="0" onclick="valorRadioTrue('+$filasRS+')"></td><td>[Edit]</td><td></td></tr>');
		// 		$filasRS++;
		// });

	}); //document ready
		function guardaCliente(){
			// jsonFacturacion = [];
			// $arreglo = {};
			// //$campo = [];
		
		 //    $(".registroFacturacion").each(function() {

		 //    	$fila = $(this).val();
		 //    	$(".datoFac_"+$fila).each(function() {
		 //    		$campo = $(this).attr('name').split("_");
		 //    		 console.log($campo);
		 //    		$arreglo[$campo[0]] = $(this).val();
		 //    	});
		 //    	console.log($arreglo);

		 //        jsonFacturacion.push($arreglo);
		 //        $arreglo = {};
		 //    });
		 //    console.log(jsonFacturacion);
		    
		 //    jsonStringFac = JSON.stringify(jsonFacturacion);

		 //    console.log(jsonStringFac);
		 //   $("#facVal").val(jsonStringFac);
		   $("#formCliente").submit();

	 		
		}

		// function valorRadioTrue(radio){
		// 	$("input[name='primario']").val('0');
		// 	$("#txtprimario_"+radio).val('1');
		// }

	</script>
</head>
<body>
	<?php include_once("../header.htm"); ?>
	<h1>Registro de Colaboradores</h1>
	<input	type="hidden" value="0" name="idColaborador" id="idColaborador">
	<table>
		<tr>
			<td>Codigo</td>	<td><input type="text" id="txtCodigo" name="codigo"></td>
		</tr>
		<tr>
			<td>Nombre Corto</td><td><input type="text" id="txtNombreCorto" name="nombrec"></td>
		</tr>
		<tr>
			<td>Nombre Completo</td><td><input type="text" id="txtNombreLargo" name="nombrel"></td>
		</tr>
		
	</table>
	<br><br>
<!-- <table id="tblRS" border="1">
	<thead>
		<tr>
			<td></td><td>Razon Social</td><td>RFC</td><td>Primario</td><td></td><td><span id="btnMasRS">[+]</span></td>
		</tr>

	</thead>
	<tbody>
		
	</tbody>
		
</table> -->
	<br><br>
	<input type="button" value="Guardar" id="guardaCliente">

</body>
</html>