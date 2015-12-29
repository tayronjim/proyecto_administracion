<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
	$facturacion = [];
	$(document).ready(function(){
		$.ajax({
 			type: "POST",
 			url: "control.php",
 			data: { "funcion" :  "buscaClientes" },
 			success: function(data){
 				 // alert(data);
 				var obj = JSON.parse(data);
 				console.log(obj);
 				$cont = 0;
 				
 				while(obj[$cont]){
 					//$arregloTabla[$cont] = obj.Cliente[$cont];
 					$facturacion[obj[$cont].id] = obj[$cont].facturacion;
 					
 					var cliente = JSON.parse(obj[$cont].datos_cliente);
 					$("#listaClientes").append("<option value='"+obj[$cont].id+"'>"+cliente.publico+"</option>");
					$cont++;
 				}
 				
 			}
 		});

 		$("#listaClientes").change(function(){
 			alert($("#listaClientes").val());
 			$("#listaRS").html("");
 			if ($("#listaClientes").val() > 0) {
 				var fac = JSON.parse($facturacion[$("#listaClientes").val()]);
 				$cont = 0;
 				while(fac[$cont]){
					if (fac[$cont].primario == 1) {$selected = "selected";} else {$selected = "";};
	 				$("#listaRS").append("<option value='"+fac[$cont].idfac+"' "+$selected+">"+fac[$cont].rs+"</option>");
	 				$cont++;
 				}

 			};
				
		});
		$("#guardaProyecto").click(function(){
		    general = {};
		    cliente = {};
		    contrato = {};
		    facturacion = {};

		    

		    $(".formProyectCliente").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        cliente[name] = valor;
		    }); 
		    console.log(cliente);

		    $(".formProyect").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        general[name] = valor;
		    }); 

		    $(".formProyectContrato").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        contrato[name] = valor;
		    }); 

		    $(".formProyectFacturacion").each(function() {
		        var name = $(this).attr("name");
		        var valor = $(this).val();
		        facturacion[name] = valor;
		    }); 

		    jsonStringGeneral = JSON.stringify(general);
		    jsonStringCliente = JSON.stringify(cliente);
		    jsonStringContrato = JSON.stringify(contrato);
		    jsonStringFacturacion = JSON.stringify(facturacion);
		   

		    $.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "guardaProyecto", "general" : jsonStringGeneral, "cliente" : jsonStringCliente, "contrato" : jsonStringContrato, "facturacion" : jsonStringFacturacion },
	 			success: function(data){
	 				 console.log(data);
	 				 window.location="proyectos.php?p="+data;
	 			}
	 		});
		});
		
	}); // fin document ready

	</script>
</head>
<body>
<?php include_once("../header.htm"); ?>

WBS: <input type="text" class="formProyect" id="txtwbs" name="wbs">
<br>
CTA: <input type="text" class="formProyect" id="txtcta" name="cta">
<br>
SEM:  <input type="text" class="formProyect" id="txtsem" name="sem">
<br>

<table>
	<tr>
		<td>Cliente: <select id="listaClientes" class="formProyectCliente" name="cliente">
			<option value="-1">-Selecciona un cliente-</option>
		</select></td>
		<td>Razon Social<select id="listaRS" class="formProyectCliente" name="razonS"></select></td>
	</tr>
</table>
<table>
	<tr>
		<td>Fecha de Inicio</td><td>

		<select class="formProyect" name="fIniY">
			<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
			<?php 
				$anio = date('Y');
				for ($anio=date('Y')-1; $anio > 1986 ; $anio--) { 
			?>
					<option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
			<?php
				}
			 ?>
			<option value="1986">1986</option>
		</select>
		<?php 
			$mesActual = date('m');
		 ?>
		<select class="formProyect" name="fIniM">
			<option <?php if($mesActual=="01"){echo "selected";} ?> value="01">Enero</option>
			<option <?php if($mesActual=="02"){echo "selected";} ?> value="02">Febrero</option>
			<option <?php if($mesActual=="03"){echo "selected";} ?> value="03">marzo</option>
			<option <?php if($mesActual=="04"){echo "selected";} ?> value="04">abril</option>
			<option <?php if($mesActual=="05"){echo "selected";} ?> value="05">Mayo</option>
			<option <?php if($mesActual=="06"){echo "selected";} ?> value="06">Junio</option>
			<option <?php if($mesActual=="07"){echo "selected";} ?> value="07">Julio</option>
			<option <?php if($mesActual=="08"){echo "selected";} ?> value="08">Agosto</option>
			<option <?php if($mesActual=="09"){echo "selected";} ?> value="09">Septiembre</option>
			<option <?php if($mesActual=="10"){echo "selected";} ?> value="10">Octubre</option>
			<option <?php if($mesActual=="11"){echo "selected";} ?> value="11">Noviembre</option>
			<option <?php if($mesActual=="12"){echo "selected";} ?> value="12">Diciembre</option>
		</select>

		<select class="formProyect" name="fIniD">
		<?php 
			$diaActual = date("j");
			
			$numero = cal_days_in_month(CAL_GREGORIAN, 11, 2015); // 31
			for ($dia=1; $dia <= $numero ; $dia++) { ?>
				<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>" <?php if ($diaActual == $dia) {echo "selected";} ?>><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
		<?php	
			}
		 ?>
		</select>
		</td>
	</tr>
</table>
<table>
	<tr>
		<td>Fecha de Cierre Ideal</td><td>

		<select class="formProyect" name="fCIdealY">
			<option value="<?php echo date('Y')+2; ?>"><?php echo date('Y')+2; ?></option>
			<?php 
				$anio = date('Y')+2;
				for ($anio=date('Y')+1; $anio > 1986 ; $anio--) { 
			?>
					<option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
			<?php
				}
			 ?>
			
			<option value="1986">1986</option>
		</select>
		<select class="formProyect" name="fCIdealM">
			<option value="01">Enero</option>
			<option value="02">Febrero</option>
			<option value="03">marzo</option>
			<option value="04">abril</option>
			<option value="05">Mayo</option>
			<option value="06">Junio</option>
			<option value="07">Julio</option>
			<option value="08">Agosto</option>
			<option value="09">Septiembre</option>
			<option value="10">Octubre</option>
			<option value="11">Noviembre</option>
			<option value="12">Diciembre</option>
		</select>
		<select class="formProyect" name="fCIdealD">
		<?php 
			$numero = cal_days_in_month(CAL_GREGORIAN, 11, 2015); // 31
			for ($dia=1; $dia <= $numero ; $dia++) { ?>
				<option value="<?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($dia, 2, "0", STR_PAD_LEFT); ?></option>
		<?php	
			}
		 ?>
		</select>
		</td>
	</tr>
</table>


<br>
Posicion: <input type="text" class="formProyect" id="txtTituloProyecto" name="posicion">
<br>
KAM: <input type="text" class="formProyect" id="txtkam" name="kam">
<br>
Prioridad:  <input type="text" class="formProyect" id="txtprioridad" name="prioridad">
<br>
Salario del Puesto:  <input type="text" class="formProyect" id="txtsalario" name="salario">
<br>


<h2>Datos del Contrato</h2>
Convenio:  <input type="text" class="formProyectContrato" id="txtConvenio" name="convenio">
<br>
Garantia:  <input type="text" class="formProyectContrato" id="txtGarantia" name="garantia">
<br>
Honorarios:  <input type="text" class="formProyectContrato" id="txtHonorarios" name="honorarios">
<br>
Acuerdo de Facturacion:  <input type="text" class="formProyectContrato" id="txtAcuerdoFacturacion" name="acuerdofacturacion">
<br>
<input type="hidden" class="formProyectContrato" name="fGarantiaY" value="0000">
<input type="hidden" class="formProyectContrato" name="fGarantiaM" value="00">
<input type="hidden" class="formProyectContrato" name="fGarantiaD" value="00">


<h2>Facturacion</h2>
Valor del Proyecto:  <input type="text" class="formProyectFacturacion" id="txtValorProyecto" name="valorproyecto">

<br><br>
<input type="button" value="Guardar" id="guardaProyecto">
</body>
</html>