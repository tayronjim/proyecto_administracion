<!DOCTYPE html>

<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$filasRS=0;
		$filasContacto=0;
		<?php 
			$cliente = "";
			if(isset($_GET['c'])){
				$cliente = $_GET['c'];
			}
				
		 ?>
		
		$cliente = "<?php echo $cliente; ?>";
		
		if ($cliente != "") {
			$facturacion = "";
			
			$.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" :  "buscaClientes", "cliente":$cliente },
	 			success: function(data){
	 				var obj = JSON.parse(data);
	 				console.log(obj);
	 				var datosCliente = JSON.parse(obj.Cliente[0].datos_cliente);
	 				var objFac = JSON.parse(obj.Cliente[0].facturacion);
	 				var datosContacto = JSON.parse(obj.Cliente[0].datos_contacto);
	 				
	 				console.log(datosCliente);
	 					//$arregloTabla[$cont] = obj.Cliente[$cont];
	 					//$("#listaClientes").append("<option value='"+obj.Cliente[$cont].id+"'>"+obj.Cliente[$cont].nombre_comercial+"</option>");
	 					$("#txtCodigoCliente").val(datosCliente.codigo);
	 					$("#txtNombrePublico").val(datosCliente.publico);
	 					$("#txtFechaAlta").val(datosCliente.fecha);
	 					$("#slcIndustria").val(datosCliente.industria);
	 					$("#idCliente").val(obj.Cliente[0].id);
	 					//$facturacion = obj.Cliente[0].facturacion;
	 					$("#txtFechaAlta").attr('disabled','true');
	 				console.log($facturacion);
					//var objFac = JSON.parse($facturacion);
					$cont = 0;
					while(objFac[$cont]){
						console.log(objFac[$cont]);
						$filasRS = objFac[$cont].idfac;
						console.log($filasRS);
						$("#tblRS tbody").append('<tr id="filaRS_'+$filasRS+'"><td><span id="btnMenosRS_'+$filasRS+'">[-]</span><input type="hidden" value="'+$filasRS+'" class="registroFacturacion"><input type="hidden" class="datoFac_'+$filasRS+'" id="idFac_'+$filasRS+'" name="idfac" value="'+$filasRS+'"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRS_'+$filasRS+'" name="rs" value="'+objFac[$cont].rs+'"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRFC_'+$filasRS+'" name="rfc" value="'+objFac[$cont].rfc+'"></td><td><input type="radio" class="datoFac_'+$filasRS+'" id="txtprimario_'+$filasRS+'" name="primario" value="'+objFac[$cont].primario+'" onclick="valorRadioTrue('+$filasRS+')"></td><td>[Edit]</td><td></td></tr>');
						if ($("#txtprimario_"+$filasRS).val() == 1) {
							$("#txtprimario_"+$filasRS).attr('checked',true);
						};
						$cont++;
					}
					$filasRS++;
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

		$("#btnMasContacto").click(function(){
				$("#tblContacto tbody").append('<tr id="filaContacto_'+$filasContacto+'"><td><span id="btnMenosContacto_'+$filasContacto+'">[-]</span><input type="hidden" value="'+$filasContacto+'" class="registroContactos"><input type="hidden" class="datoContacto_'+$filasContacto+'" id="idContacto_'+$filasContacto+'" name="idcontacto" value="'+$filasContacto+'"></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtNombre_'+$filasContacto+'" name="nombre"></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtArea_'+$filasContacto+'" name="area" ></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtTelefono_'+$filasContacto+'" name="telefono" ></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtObservaciones_'+$filasContacto+'" name="observaciones" ></td><td>[Edit]</td><td></td></tr>');
				$filasContacto++;
		});

		$("#btnMasRS").click(function(){
				$("#tblRS tbody").append('<tr id="filaRS_'+$filasRS+'"><td><span id="btnMenosRS_'+$filasRS+'">[-]</span><input type="hidden" value="'+$filasRS+'" class="registroFacturacion"><input type="hidden" class="datoFac_'+$filasRS+'" id="idFac_'+$filasRS+'" name="idfac" value="'+$filasRS+'"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRS_'+$filasRS+'" name="rs"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRFC_'+$filasRS+'" name="rfc" ></td><td><input type="radio" class="datoFac_'+$filasRS+'" id="txtprimario_'+$filasRS+'" name="primario" value="0" onclick="valorRadioTrue('+$filasRS+')"></td><td>[Edit]</td><td></td></tr>');
				$filasRS++;
		});

	}); //document ready
		function guardaCliente(){
			jsonFacturacion = [];
			jsonContacto = [];
			jsonObj = [];

			

			$(".registroContactos").each(function() {

		    	$arreglo = {};
		    	$fila = $(this).val();
		    	$(".datoContacto_"+$fila).each(function() {
		    		$campo = $(this).attr('name').split("_");
		    		$arreglo[$campo[0]] = $(this).val();
		    	});

		        jsonContacto.push($arreglo);
		       
		    });
		
		    $(".registroFacturacion").each(function() {

		    	$arreglo = {};
		    	$fila = $(this).val();
		    	$(".datoFac_"+$fila).each(function() {
		    		$campo = $(this).attr('name').split("_");
		    		$arreglo[$campo[0]] = $(this).val();
		    	});

		        jsonFacturacion.push($arreglo);
		       
		    });
		    
		    item = {};
		    $(".formClientes").each(function() {

		        var name = $(this).attr("name");
		        var valor = $(this).val();

		        
		        item [name] = valor;

		       
		    }); 

		    jsonObj.push(item);

		    jsonStringFac = JSON.stringify(jsonFacturacion);
		    jsonStringCliente = JSON.stringify(item);
		    jsonStringContacto = JSON.stringify(jsonContacto);
		    

		    $.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "guardaCliente", "datos_cliente" : jsonStringCliente, "datos_contacto" : jsonStringContacto, "datos_facturacion" : jsonStringFac },
	 			success: function(data){
	 				 window.location="listado_clientes.php";
	 			}
	 		});

		}

		function valorRadioTrue(radio){
			$("input[name='primario']").val('0');
			$("#txtprimario_"+radio).val('1');
		}

	</script>
</head>
<body>
<?php include_once("../header.htm"); ?>
<div class="cuerpo">
	<h1>Registro de Cliente</h1>
	<!-- <form action="registra_cliente.php" method="post" id="formCliente"> -->
		<input	type="hidden" value="0" name="idCliente" id="idCliente">
		<table>
			<tr>
				<td>Codigo</td>	<td><input type="text" id="txtCodigoCliente" class="formClientes" name="codigo"></td>
			</tr>
			<tr>
				<td>Nombre Comercial</td><td><input type="text" id="txtNombrePublico" class="formClientes" name="publico"></td>
			</tr>
			<tr>
				<td>Industria</td>
				<td><select type="text" id="slcIndustria" class="formClientes" name="industria">
					<option value="-1">-----</option>
					<option value="1">1- AGROINDUSTRIAL</option>
					<option value="2">2- AUTOMOTRIZ</option>
					<option value="3">3- CONSTRUCCIÓN</option>
					<option value="4">4- EDUCACIÓN</option>
					<option value="5">5- FARMACEUTICO</option>
					<option value="6">6- FMCG-RETAIL</option>
					<option value="7">7- INDUSTRIAL</option>
					<option value="8">8- IT</option>
					<option value="9">9- FINANCIERO</option>
					<option value="10">10- OTRO</option>
				</select></td>
			</tr>
			<tr>
				<td>Fecha Alta</td><td><input type="date" class="formClientes" id="txtFechaAlta" name="fecha"></td>
			</tr>
		</table>
		<!-- <input type="hidden" id="facVal" name="facval"> -->
	<!-- </form> -->
	<br><br>
	<table id="tblRS" border="1">
		<thead>
			<tr>
				<td></td><td>Razon Social</td><td>RFC</td><td>Primario</td><td></td><td><span id="btnMasRS">[+]</span></td>
			</tr>

		</thead>
		<tbody>
			
		</tbody>
			
	</table>
	<br><br>
	<table id="tblContacto" border="1">
		<thead>
			<tr>
				<td></td><td>Nombre</td><td>Area/Puesto</td><td>Telefono</td><td>Observaciones</td><td><span id="btnMasContacto">[+]</span></td>
			</tr>

		</thead>
		<tbody>
			
		</tbody>
			
	</table>


	<br><br>
	<input type="button" value="Guardar" id="guardaCliente">
</div>
	

</body>
</html>