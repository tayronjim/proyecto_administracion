<!DOCTYPE html>
<html>
<head>
	<?php include_once("../librerias_base.htm"); ?>
	<script type="text/javascript">
	
	$(document).ready(function(){
		$.ajax({
 			type: "POST",
 			url: "control.php",
 			data: { "funcion" :  "buscaClientes" },
 			success: function(data){
 				 // alert(data);
 				var obj = JSON.parse(data);
 				$cont = 0;
 				
 				while(obj.Cliente[$cont]){
 					//$arregloTabla[$cont] = obj.Cliente[$cont];
 					$("#listaClientes").append("<option value='"+obj.Cliente[$cont].id+"'>"+obj.Cliente[$cont].nombre_comercial+"</option>");
					$cont++;
 				}
 				
 			}
 		});

 		$("#listaClientes").change(function(){
 			alert($("#listaClientes").val());
 			$("#listaRS").html("");
 			if ($("#listaClientes").val() > 0) {
 				$.ajax({
		 			type: "POST",
		 			url: "control.php",
		 			data: { "funcion" :  "buscaRS", id_cliente:$("#listaClientes").val() },
		 			success: function(data){
		 				$objRS = JSON.parse(data);
		 				$datos = JSON.parse($objRS[0].fac);
		 				$cont = 0;
		 				while($datos[$cont]){
		 					console.log($datos[$cont]);
		 				
		 					
		 					if ($datos[$cont].primario == 1) {$selected = "selected";} else {$selected = "";};
		 					$("#listaRS").append("<option value='"+$datos[$cont].idfac+"' "+$selected+">"+$datos[$cont].rs+"</option>");
							$cont++;
		 				}
		 				
		 			}
		 		});
 			};
				
		});
		$("#guardaProyecto").click(function(){
			jsonObj = [];
			// jsonActividades = [];
		    $(".formProyect").each(function() {

		        var name = $(this).attr("name");
		        var valor = $(this).val();

		        item = {}
		        item ["name"] = name;
		        item ["value"] = valor;

		        jsonObj.push(item);
		    });

		    // $(".registroActividades").each(function() {

		    // 	$fila = $(this).val();
		    // 	$fecha = $("#fecha_"+$fila).val();
		    // 	$actividad = $("#txtActividad_"+$fila).val();

		       
		    //     item = {};
		     
		    //     item ["fecha"] = $fecha;
		    //     item ["act"] = $actividad;

		    //     jsonActividades.push(item);
		    // });
		    
		    jsonString = JSON.stringify(jsonObj);
		    // jsonStringAct = JSON.stringify(jsonActividades);

		    //console.log(jsonStringAct);

		    $.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "guardaProyecto", "datos" : jsonString },
	 			success: function(data){
	 				 console.log(data);
	 				 window.location="../index.php";
	 			}
	 		});
		});
		
	}); // fin document ready

	</script>
</head>
<body>
<?php include_once("../header.htm"); ?>

WBS: <input type="text" class="formProyect" name="txtwbs">
<br>
CTA: <input type="text" class="formProyect" name="txtcta">
<br>
SEM:  <input type="text" class="formProyect" name="txtsem">
<br>

<table>
	<tr>
		<td>Cliente: <select id="listaClientes" class="formProyect" name="cliente">
			<option value="-1">-Selecciona un cliente-</option>
		</select></td>
		<td>Razon Social<select id="listaRS" class="formProyect" name="razonS"></select></td>
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

<input type="hidden" class="formProyect" name="fGarantiaY" value="0000">
<input type="hidden" class="formProyect" name="fGarantiaM" value="00">
<input type="hidden" class="formProyect" name="fGarantiaD" value="00">
<br>
Posicion: <input type="text" class="formProyect" name="txtTituloProyecto">
<br>
KAM: <input type="text" class="formProyecto" name="txtkam">
<br>
Prioridad:  <input type="text" class="formProyect" name="txtprioridad">
<br>
Salario del Puesto:  <input type="text" class="formProyect" name="txtsalario">
<br>


<h2>Datos del Contrato</h2>
Convenio:  <input type="text" class="formProyect" id="txtConvenio" name="convenio">
<br>
Garantia:  <input type="text" class="formProyect" id="txtGarantia" name="garantia">
<br>
Honorarios:  <input type="text" class="formProyect" id="txtHonorarios" name="honorarios">
<br>
Acuerdo de Facturacion:  <input type="text" class="formProyect" id="txtAcuerdoFacturacion" name="acuerdofacturacion">
<br>


<h2>Facturacion</h2>
Valor del Proyecto:  <input type="text" class="formProyect" name="txtValorProyecto">

<br><br>
<input type="button" value="Guardar" id="guardaProyecto">
</body>
</html>