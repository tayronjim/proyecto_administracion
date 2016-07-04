<!DOCTYPE html>

<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
	$(document).ready(function(){
		$("li").removeClass( "current" )
		$("#menuClientes").addClass('current');
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
	 				
	 				var datosCliente = JSON.parse(obj.Cliente[0].datos_cliente);
	 				var objFac = JSON.parse(obj.Cliente[0].facturacion);
	 				var datosContacto = JSON.parse(obj.Cliente[0].datos_contacto);
	 				
	 				
 					//$arregloTabla[$cont] = obj.Cliente[$cont];
 					//$("#listaClientes").append("<option value='"+obj.Cliente[$cont].id+"'>"+obj.Cliente[$cont].nombre_comercial+"</option>");
 					//$("#txtCodigoCliente").val(datosCliente.codigo);
 					$("#txtNombrePublico").val(datosCliente.publico);
 					$("#txtFechaAlta").val(datosCliente.fecha);
 					$("#slcIndustria").val(datosCliente.industria);
 					$("#idCliente").val(obj.Cliente[0].id);
 					//$facturacion = obj.Cliente[0].facturacion;
 					$("#txtFechaAlta").attr('disabled','true');
	 			
					//var objFac = JSON.parse($facturacion);
					
					$cont = 0;
					while(objFac[$cont]){
						
						$filasRS = objFac[$cont].idfac;
						
						$("#tblRS tbody").append('<tr id="filaRS_'+$filasRS+'"><td><div id="btnMenosRS_'+$filasRS+'" class="btnMenosRS"></div><input type="hidden" value="'+$filasRS+'" class="registroFacturacion"><input type="hidden" class="datoFac_'+$filasRS+'" id="idFac_'+$filasRS+'" name="idfac" value="'+$filasRS+'"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRS_'+$filasRS+'" name="rs" value="'+objFac[$cont].rs+'" style="width:270px;"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRFC_'+$filasRS+'" name="rfc" value="'+objFac[$cont].rfc+'" style="width:120px;"><input type="hidden" id="hdnCalle_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="calle" value="'+objFac[$cont].calle+'"><input type="hidden" id="hdnExt_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="ext" value="'+objFac[$cont].ext+'"><input type="hidden" id="hdnInt_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="nint" value="'+objFac[$cont].nint+'"><input type="hidden" id="hdnCP_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="cp" value="'+objFac[$cont].cp+'"><input type="hidden" id="hdnCiudad_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="ciudad" value="'+objFac[$cont].ciudad+'"><input type="hidden" id="hdnEstado_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="estado" value="'+objFac[$cont].estado+'"><input type="hidden" id="hdnTel_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="telefono" value="'+objFac[$cont].telefono+'"><input type="hidden" id="hdnEmail_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="email" value="'+objFac[$cont].email+'"></td><td><input type="radio" class="datoFac_'+$filasRS+'" id="txtprimario_'+$filasRS+'" name="primario" value="'+objFac[$cont].primario+'" onclick="valorRadioTrue('+$filasRS+')"></td><td><div class="btnEditarRS" id="btnEditar_'+$filasRS+'"></div></td><td></td></tr>');
						if ($("#txtprimario_"+$filasRS).val() == 1) {
							$("#txtprimario_"+$filasRS).attr('checked',true);
						};
						$cont++;
						$filasRS++;
					}

					$cont = 0;
					while(datosContacto[$cont]){
						$filasContacto = datosContacto[$cont].idcontacto;

						$("#tblContacto > tbody").append('<tr id="filaContacto_'+$filasContacto+'" style="border-bottom:1px solid #E1EEF4"><td><div id="btnMenosContacto_'+$filasContacto+'" class="btnMenosCont"></div><input type="hidden" value="'+$filasContacto+'" class="registroContactos"><input type="hidden" class="datoContacto_'+$filasContacto+'" id="idContacto_'+$filasContacto+'" name="idcontacto" value="'+$filasContacto+'"></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtNombre_'+$filasContacto+'" value="'+datosContacto[$cont].nombre+'" name="nombre" style="width:250px;" placeholder="Nombre Completo"><br><input type="text" class="datoContacto_'+$filasContacto+'" id="txtArea_'+$filasContacto+'" value="'+datosContacto[$cont].area+'" name="area" style="width:170px;" placeholder="Area / Puesto"></td><td><table id="tblMedioContacto_'+$filasContacto+'" contacto="'+$filasContacto+'" ><tbody></tbody></table></td><td><input type="date" class="datoContacto_'+$filasContacto+'" id="txtCumpleaños_'+$filasContacto+'" value="'+datosContacto[$cont].cumpleaños+'" name="cumpleaños" style="width:130px;"></td><td><textarea class="datoContacto_'+$filasContacto+'" id="txtObservaciones_'+$filasContacto+'" name="observaciones" style="width:200px; height:40px;">'+datosContacto[$cont].observaciones+'</textarea></td><td></td></tr>');

						$cont2=0;
						console.log(datosContacto[$cont].medioDeContacto[$cont2]);
						while(datosContacto[$cont].medioDeContacto[$cont2]){
							$idTipoContacto = datosContacto[$cont].medioDeContacto[$cont2].tipoContacto;
							$idValorContacto = datosContacto[$cont].medioDeContacto[$cont2].valorContacto;
							console.log($idTipoContacto + "," + $idValorContacto);
							$('#tblMedioContacto_'+$filasContacto+' > tbody').append('<tr class="tblFilaContacto'+$filasContacto+'" fila="'+$cont2+'"><td></td><td><select id="tipoContactoFila'+$filasContacto+'_'+$cont2+'"><option value="1">Telefono Movil</option><option value="2">Telefono Trabajo</option><option value="3">e-Mail</option><option value="4">linkedin</option><option value="5">ubicacion</option></select></td><td><input id="valorTipoContactoFila'+$filasContacto+'_'+$cont2+'" type="text" class="datoContacto" name="valor" style="width:150px;"></td></tr>');
							$('#tipoContactoFila'+$filasContacto+'_'+$cont2).val($idTipoContacto);
							$('#valorTipoContactoFila'+$filasContacto+'_'+$cont2).val($idValorContacto);
							$cont2++;
						}

						$('#tblMedioContacto_'+$filasContacto+' > tbody').append('<tr class="tblFilaContacto'+$filasContacto+'" fila="-1"><td><div id="btnMasMedioContacto" class="btnMas" onclick="agregaMedioContacto('+$filasContacto+','+$cont2+')"></div></td><td></td><td></td></tr>');

						$cont++;
					}

					$filasContacto++;
	 			}
	 		});

	 		
		} else{
			$cliente = 0;
		}
		$("#guardaCliente").click(function(){
			guardaCliente();
		});

		$("#btnMasContacto").click(function(){
				$("#tblContacto > tbody").append('<tr id="filaContacto_'+$filasContacto+'" style="border-bottom:1px solid #E1EEF4"><td><div id="btnMenosContacto_'+$filasContacto+'" class="btnMenosCont"></div><input type="hidden" value="'+$filasContacto+'" class="registroContactos"><input type="hidden" class="datoContacto_'+$filasContacto+'" id="idContacto_'+$filasContacto+'" name="idcontacto" value="'+$filasContacto+'"></td><td><input type="text" class="datoContacto_'+$filasContacto+'" id="txtNombre_'+$filasContacto+'" name="nombre" style="width:250px;" placeholder="Nombre Completo"><br><input type="text" class="datoContacto_'+$filasContacto+'" id="txtArea_'+$filasContacto+'" name="area" style="width:170px;" placeholder="Area / Puesto"></td><td><table id="tblMedioContacto_'+$filasContacto+'" contacto="'+$filasContacto+'" ><tr class="tblFilaContacto'+$filasContacto+'" fila="0"><td></td><td><select id="tipoContactoFila'+$filasContacto+'_0"><option value="1">Telefono Movil</option><option value="2">Telefono Trabajo</option><option value="3">e-Mail</option><option value="4">linkedin</option><option value="5">ubicacion</option></select></td><td><input id="valorTipoContactoFila'+$filasContacto+'_0" type="text" class="datoContacto" name="valor" style="width:150px;"></td></tr><tr class="tblFilaContacto'+$filasContacto+'" fila="-1"><td><div id="btnMasMedioContacto" class="btnMas" onclick="agregaMedioContacto('+$filasContacto+',1)"></div></td><td></td><td></td></tr></table></td><td><input type="date" class="datoContacto_'+$filasContacto+'" id="txtCumpleaños_'+$filasContacto+'" name="cumpleaños" style="width:130px;"></td><td><textarea class="datoContacto_'+$filasContacto+'" id="txtObservaciones_'+$filasContacto+'" name="observaciones" style="width:200px; height:40px;"></textarea></td><td></td></tr>');
				$filasContacto++;
		});

		$("#btnMasRS").click(function(){
				$("#tblRS tbody").append('<tr id="filaRS_'+$filasRS+'"><td><div id="btnMenosRS_'+$filasRS+'" class="btnMenosRS"></div><input type="hidden" value="'+$filasRS+'" class="registroFacturacion"><input type="hidden" class="datoFac_'+$filasRS+'" id="idFac_'+$filasRS+'" name="idfac" value="'+$filasRS+'"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRS_'+$filasRS+'" name="rs" style="width:270px;"></td><td><input type="text" class="datoFac_'+$filasRS+'" id="txtRFC_'+$filasRS+'" name="rfc" style="width:120px;"><input type="hidden" id="hdnCalle_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="calle" value=""><input type="hidden" id="hdnExt_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="ext" value=""><input type="hidden" id="hdnInt_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="nint" value=""><input type="hidden" id="hdnCP_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="cp" value=""><input type="hidden" id="hdnCiudad_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="ciudad" value=""><input type="hidden" id="hdnEstado_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="estado" value=""><input type="hidden" id="hdnTel_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="telefono" value=""><input type="hidden" id="hdnEmail_'+$filasRS+'" class="datoFac_'+$filasRS+'" name="email" value=""></td><td><input type="radio" class="datoFac_'+$filasRS+'" id="txtprimario_'+$filasRS+'" name="primario" value="0" onclick="valorRadioTrue('+$filasRS+')"></td><td><div id="btnEditar_'+$filasRS+'" class="btnEditarRS"></div></td><td></td></tr>');
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
		$(document).on('click','.btnEditarRS',function(){
			$elemento = this.id;
			$elementoSeparado = $elemento.split("_");
			$noFila = $elementoSeparado[1];
			$("#cpyRS").val($("#txtRS_"+$noFila).val());
			$("#cpyRFC").val($("#txtRFC_"+$noFila).val());
			$("#cpyCalle").val($("#hdnCalle_"+$noFila).val());
			$("#cpyNumExt").val($("#hdnExt_"+$noFila).val());
			$("#cpyNumInt").val($("#hdnInt_"+$noFila).val());
			$("#cpyCP").val($("#hdnCP_"+$noFila).val());
			$("#cpyCiudad").val($("#hdnCiudad_"+$noFila).val());
			$("#cpyEstado").val($("#hdnEstado_"+$noFila).val());
			$("#cpyTel").val($("#hdnTel_"+$noFila).val());
			$("#cpyEmail").val($("#hdnEmail_"+$noFila).val());
			$("#cpyID").val($noFila);
			
			$("#hdnFormRS").css("visibility","visible");
			$(".fondoEmergente").css("visibility","visible");
			
		});
		$(document).on('click','#btnMasMedioContacto',function(){
			
		});

	}); //document ready
		function agregaMedioContacto($filasContacto,$fila){

			$filaSiguiente = parseInt($fila)+1;

			$(".tblFilaContacto"+$filasContacto+"[fila='-1']").html('<td></td><td><select id="tipoContactoFila'+$filasContacto+'_'+$fila+'"><option value="1">Telefono Movil</option><option value="2">Telefono Trabajo</option><option value="3">e-Mail</option><option value="4">linkedin</option><option value="5">ubicacion</option></select></td><td><input id="valorTipoContactoFila'+$filasContacto+'_'+$fila+'" type="text" class="datoContacto" name="valor" style="width:150px;"></td>');
			$(".tblFilaContacto"+$filasContacto+"[fila='-1']").attr('fila',$fila);
			$('#tblMedioContacto_'+$filasContacto+' > tbody').append('<tr class="tblFilaContacto'+$filasContacto+'" fila="-1"><td><div id="btnMasMedioContacto" class="btnMas" onclick="agregaMedioContacto('+$filasContacto+','+$filaSiguiente+')"></div></td><td></td><td></td></tr>');


		}

		function guardaCliente(){
			jsonFacturacion = [];
			jsonContacto = [];
			jsonObj = [];
			$subArreglo = "";
			

			$(".registroContactos").each(function() {

		    	$arreglo = {};
		    	$fila = $(this).val();
		    	
		    	$(".datoContacto_"+$fila).each(function() {
		    		$campo = $(this).attr('name').split("_");
		    		$arreglo[$campo[0]] = $(this).val();
		    	});
		    	$arreglo.medioDeContacto = [];
		    	$('.tblFilaContacto'+$fila).each(function(){
		    	
		    		$subFila = $(this).attr('fila');
	
		    		if ($subFila >= 0) {
						$subArreglo = {tipoContacto : $('#tipoContactoFila'+$fila+'_'+$subFila).val(), valorContacto : $('#valorTipoContactoFila'+$fila+'_'+$subFila).val()};
						$arreglo.medioDeContacto.push($subArreglo);
			    		
		    		}
		    			
		    	});
		    	
		        jsonContacto.push($arreglo);
		        
		       
		    });

		    $(".registroFacturacion").each(function() {

		    	$arreglo = {};
		    	$fila = $(this).val();
		    	$(".datoFac_"+$fila).each(function() {
		    		// $campo = $(this).attr('name').split("_");
		    		// $arreglo[$campo[0]] = $(this).val();
		    		$campo = $(this).attr('name');
		    		$arreglo[$campo] = $(this).val();
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
	 			data: { "funcion" : "guardaCliente", "datos_cliente" : jsonStringCliente, "datos_contacto" : jsonStringContacto, "datos_facturacion" : jsonStringFac, "idCliente":$cliente },
	 			success: function(data){
	 				 window.location="listado_clientes.php";
	 			}
	 		});

		}

		function valorRadioTrue(radio){
			$("input[name='primario']").val('0');
			$("#txtprimario_"+radio).val('1');
		}

		function guardaCambiosRS(){


			$noFila = $("#cpyID").val();



			$("#txtRS_"+$noFila).val($("#cpyRS").val());
			$("#txtRFC_"+$noFila).val($("#cpyRFC").val());
			$("#hdnCalle_"+$noFila).val($("#cpyCalle").val());
			$("#hdnExt_"+$noFila).val($("#cpyNumExt").val());
			$("#hdnInt_"+$noFila).val($("#cpyNumInt").val());
			$("#hdnCP_"+$noFila).val($("#cpyCP").val());
			$("#hdnCiudad_"+$noFila).val($("#cpyCiudad").val());
			$("#hdnEstado_"+$noFila).val($("#cpyEstado").val());
			$("#hdnTel_"+$noFila).val($("#cpyTel").val());
			$("#hdnEmail_"+$noFila).val($("#cpyEmail").val());

			$("#hdnFormRS").css("visibility","hidden");
			$(".fondoEmergente").css("visibility","hidden");

			$("#cpyRS").val("");
			$("#cpyRFC").val("");
			$("#cpyCalle").val("");
			$("#cpyNumExt").val("");
			$("#cpyNumInt").val("");
			$("#cpyCP").val("");
			$("#cpyCiudad").val("");
			$("#cpyEstado").val("");
			$("#cpyTel").val("");
			$("#cpyEmail").val("");
			$("#cpyID").val("");
			
		}

		function cancelaCambiosRS(){
			$("#hdnFormRS").css("visibility","hidden");
			$(".fondoEmergente").css("visibility","hidden");

			$("#cpyRS").val("");
			$("#cpyRFC").val("");
			$("#cpyCalle").val("");
			$("#cpyNumExt").val("");
			$("#cpyNumInt").val("");
			$("#cpyCP").val("");
			$("#cpyCiudad").val("");
			$("#cpyEstado").val("");
			$("#cpyTel").val("");
			$("#cpyEmail").val("");
			$("#cpyID").val("");
		}
		

	</script>
	<style type="text/css">
		#hdnFormRS, #hdnFormContacto{
			position: fixed;
			left: 50%;
			top: 50%;
			z-index: 999;
			background-color: white;
			color:#000;
			font-family: arial;
			padding: 10px;
			border:1px solid #fff;
			border-radius: 8px;
			visibility: hidden;
		}
		#hdnFormRS{
			margin-left: -306px;
			margin-top: -124px
		}
		#hdnFormContacto{
			margin-left: -378px;
			margin-top: -123px
		}
		#hdnFormRS h2, #hdnFormContacto h2{
			text-align: center;

		}
		#cpyRS, #cpyCalle{
			width: 220px;
		}
		
		#cpyNumExt, #cpyNumInt, #cpyCP{
			width: 50px;
		}
		#cpyCiudad, #cpyEstado, #cpyEmail,#cpyRFC, #cpyTel{
			width: 150px;
		}
		
		#btnGuardaRS{
			background-color: green;
			border:1px solid green;
		}
		#btnCancelaRS{
			background-color: red;
			border:1px solid red;
		}
		.filaBotones{
			height: 50px;
			vertical-align: bottom;
		}
		.filaBotones input{
			border-radius: 3px;
			width: 90px;
			height: 30px;
			color: white;
			font-weight: bold;
		}
		#colBtnAceptar{
			text-align: right;
		}
		#colBtnCancelar{
			text-align: left;
		}

	</style>
</head>
<body>
<?php include_once("../header.htm"); ?>
<div class="cuerpo">
	<h1>Registro de Cliente</h1>
	<!-- <form action="registra_cliente.php" method="post" id="formCliente"> -->
		<input	type="hidden" value="0" name="idCliente" id="idCliente">
		<table class="tblFormularios">
			<tr>
				<!-- <td>Codigo</td>	<td><input type="text" id="txtCodigoCliente" class="formClientes" name="codigo"></td> -->
				<td>Nombre Comercial</td><td><input type="text" id="txtNombrePublico" class="formClientes" name="publico"></td>
				<td rowspan="4" style="vertical-align:top; padding-left:100px;"><textarea id="txtObservaciones" class="formClientes" name="observaciongenerales" placeholder="Observaciones Generales" rows="8" cols="70"></textarea></td>
			</tr>
			<tr>
				<td>Pagina web: </td><td><input type="text" name="web" id="paginaWeb" class="formClientes"></td>
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
				<td hidden>Nivel de Riesgo</td><td hidden><select class="formClientes" id="slcRiesgo" name="riesgo"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td>
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
				<th colspan="9" width="1030px">Datos de Contacto</th>
			</tr>
			<tr>
				<th></th><th width="255px">Nombre</th><th width="175px">Información de Contacto</th><th>Cumpleaños</th><th width="206px">Observaciones</th><th><div id="btnMasContacto" class="btnMas"></div></th>
			</tr>

		</thead>
		<tbody>
			
		</tbody>
			
	</table>
</div>

	<br><br>
	
	<br><br>
	<input type="button" value="Guardar" id="guardaCliente">

</div>
<div class="fondoEmergente"></div>
<div id="hdnFormRS">
	<h2>Datos Fiscales</h2>
	<table>
		<tbody>
			<tr>
				<td>Razon Social:</td><td><input type="text" id="cpyRS"></td><td width="20px"></td><td>RFC:</td><td colspan="3"><input type="text" id="cpyRFC"></td>
			</tr>
			<tr>
				<td>Calle:</td><td><input type="text" id="cpyCalle"></td><td></td><td>Ext:</td><td><input type="text" id="cpyNumExt"></td><td>Int: </td><td><input type="text" id="cpyNumInt"></td>
			</tr>
			<tr>
				<td>C.P.:</td><td><input type="text" id="cpyCP"></td>
			</tr>
			<tr>
				<td>Ciudad / Municipio: </td><td><input type="text" id="cpyCiudad"></td><td></td><td>Estado:</td><td  colspan="3"><input type="text" id="cpyEstado"></td>
			</tr>
			<tr>
				<td>Telefono: </td><td><input type="text" id="cpyTel"></td><td></td><td>Email: </td><td colspan="3"><input type="text" id="cpyEmail"></td>
			</tr>
			<tr>
				<td colspan="2" class="filaBotones" id="colBtnCancelar"><input type="button" value="Cancelar" id="btnCancelaRS" onclick="cancelaCambiosRS();"></td><td class="filaBotones" colspan="5" id="colBtnAceptar"><input type="button" value="Guardar" id="btnGuardaRS" onclick="guardaCambiosRS();"></td>
			</tr>
				
		</tbody>
	</table>



	<input type="hidden" value="" id="cpyID">
	

</div>
<div id="hdnFormContacto"></div>


</body>
</html>