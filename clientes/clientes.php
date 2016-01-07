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
						$("#tblRS tbody").append('<tr id="filaRS_'+$filasRS+'"><td><div id="btnMenosRS_'+$filasRS+'" class="btnMenosRS"></div><input type="hidden" value="'+$filasRS+'" class="registroFacturacion"><input type="hidden" class="datoFac_'+$filasRS+'" id="idFac_'+$filasRS+'" name="idfac" value="'+$filasRS+'"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRS_'+$filasRS+'" name="rs" value="'+objFac[$cont].rs+'" style="width:270px;"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRFC_'+$filasRS+'" name="rfc" value="'+objFac[$cont].rfc+'" style="width:120px;"><input type="hidden" id="hdnCalle" class="datoFac_'+$filasRS+'" name="calle" value="'+objFac[$cont].calle+'"><input type="hidden" id="hdnNumExt" class="datoFac_'+$filasRS+'" name="ext" value="'+objFac[$cont].ext+'"><input type="hidden" id="hdnNumInt" class="datoFac_'+$filasRS+'" name="nint" value="'+objFac[$cont].nint+'"><input type="hidden" id="hdnCP" class="datoFac_'+$filasRS+'" name="cp" value="'+objFac[$cont].cp+'"><input type="hidden" id="hdnCiudad" class="datoFac_'+$filasRS+'" name="ciudad" value="'+objFac[$cont].ciudad+'"><input type="hidden" id="hdnEstado" class="datoFac_'+$filasRS+'" name="estado" value="'+objFac[$cont].estado+'"><input type="hidden" id="hdnTel" class="datoFac_'+$filasRS+'" name="telefono" value="'+objFac[$cont].telefono+'"><input type="hidden" id="hdnEmail" class="datoFac_'+$filasRS+'" name="email" value="'+objFac[$cont].email+'"></td><td><input type="radio" class="datoFac_'+$filasRS+'" id="txtprimario_'+$filasRS+'" name="primario" value="'+objFac[$cont].primario+'" onclick="valorRadioTrue('+$filasRS+')"></td><td><div class="btnEditar"></div></td><td></td></tr>');
						if ($("#txtprimario_"+$filasRS).val() == 1) {
							$("#txtprimario_"+$filasRS).attr('checked',true);
						};
						$cont++;
					}
					$filasRS++;
	 			}
	 		});

	 		
		};
		$("#guardaCliente").click(function(){
			guardaCliente();
		});

		$("#btnMasContacto").click(function(){
				$("#tblContacto tbody").append('<tr id="filaContacto_'+$filasContacto+'"><td><div id="btnMenosContacto_'+$filasContacto+'" class="btnMenosCont"></div><input type="hidden" value="'+$filasContacto+'" class="registroContactos"><input type="hidden" class="datoContacto_'+$filasContacto+'" id="idContacto_'+$filasContacto+'" name="idcontacto" value="'+$filasContacto+'"></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtNombre_'+$filasContacto+'" name="nombre" style="width:250px;"></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtArea_'+$filasContacto+'" name="area" style="width:170px;"></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtTelefono_'+$filasContacto+'" name="telefono" style="width:100px;"></td><td><textarea class="datoContacto_'+$filasContacto+'" id="txtObservaciones_'+$filasContacto+'" name="observaciones" style="width:200px; height:40px;"></textarea></td><td></td></tr>');
				$filasContacto++;
		});

		$("#btnMasRS").click(function(){
				$("#tblRS tbody").append('<tr id="filaRS_'+$filasRS+'"><td><div id="btnMenosRS_'+$filasRS+'" class="btnMenosRS"></div><input type="hidden" value="'+$filasRS+'" class="registroFacturacion"><input type="hidden" class="datoFac_'+$filasRS+'" id="idFac_'+$filasRS+'" name="idfac" value="'+$filasRS+'"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRS_'+$filasRS+'" name="rs" style="width:270px;"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRFC_'+$filasRS+'" name="rfc" style="width:120px;"></td><td><input type="radio" class="datoFac_'+$filasRS+'" id="txtprimario_'+$filasRS+'" name="primario" value="0" onclick="valorRadioTrue('+$filasRS+')"></td><td><div class="btnEditar"></div></td><td></td></tr>');
				$filasRS++;
		});
		$(document).on('click','.btnMenosRS',function(){
			$elemento = this.id;
			$elementoSeparado = $elemento.split("_");
			$noFila = $elementoSeparado[1];
			$("#tblRS tbody tr#filaRS_"+$noFila).remove();
		});
		$(document).on('click','.btnMenosCont',function(){
			$elemento = this.id;
			$elementoSeparado = $elemento.split("_");
			$noFila = $elementoSeparado[1];
			$("#tblContacto tbody tr#filaContacto_"+$noFila).remove();
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
<div class="datagrid">
	<table id="tblRS" border="1">
		<thead>
			<tr>
				<th colspan="6" width="650px">Datos Fiscales</th>
			</tr>
			<tr>
				<th></th><th width="275px">Razon Social</th><th width="125px">RFC</th><th>Primario</th><th></th><th><div id="btnMasRS" class="btnMas"></div></th>
			</tr>

		</thead>
		<tbody>
			
		</tbody>
			
	</table>
</div>
	<br><br>
<div class="datagrid">
	<table id="tblContacto" border="1">
		<thead>
			<tr>
				<th colspan="6" width="912px">Datos de Contacto</th>
			</tr>
			<tr>
				<th></th><th width="255px">Nombre</th><th width="175px">Area/Puesto</th><th width="105px">Telefono</th><th width="206px">Observaciones</th><th><div id="btnMasContacto" class="btnMas"></div></th>
			</tr>

		</thead>
		<tbody>
			
		</tbody>
			
	</table>
</div>

	<br><br>
	<input type="button" value="Guardar" id="guardaCliente">
</div>

<div>
	Razon Social: <input type="text" id="cpyRS"><br>
	RFC: <input type="text" id="cpyRFC"><br>
	Calle: <input type="text" id="cpyCalle"><br>
	Ext: <input type="text" id="cpyNumExt"><br>
	Int: <input type="text" id="cpyNumInt"><br>
	C.P.: <input type="text" id="cpyCP"><br>
	Ciudad / Municipio: <input type="text" id="cpyCiudad"><br>
	Estado: <input type="text" id="cpyEstado"><br>
	Telefono: <input type="text" id="cpyTel"><br>
	Email: <input type="text" id="cpyEmail"><br>


</div>

</body>
</html>