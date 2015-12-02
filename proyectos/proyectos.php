<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Administración de proyectos</title>
	<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
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
		 				 // alert(data);
		 				obj = JSON.parse(data);
		 				$cont = 0;
		 				
		 				while(obj.RS[$cont]){
		 					//$arregloTabla[$cont] = obj.Cliente[$cont];
		 					if (obj.RS[$cont].reg_primario == 1) {$selected = "selected";} else {$selected = "";};
		 					$("#listaRS").append("<option value='"+obj.RS[$cont].id+"' "+$selected+">"+obj.RS[$cont].razon_social+"</option>");
							$cont++;
		 				}
		 				
		 			}
		 		});
 			};
				
		});
		$("#guardaProyecto").click(function(){
			jsonObj = [];
		    $(".formProyect").each(function() {

		        var name = $(this).attr("name");
		        var valor = $(this).val();

		        item = {}
		        item ["name"] = name;
		        item ["value"] = valor;

		        jsonObj.push(item);
		    });
		    jsonString = JSON.stringify(jsonObj);
		    console.log(jsonString);
		    $.ajax({
	 			type: "POST",
	 			url: "control.php",
	 			data: { "funcion" : "guardaProyecto", "datos" : jsonString },
	 			success: function(data){
	 				 console.log(data);
	 				
	 			}
	 		});
			//$("#formProyectoNuevo").submit();
		});
	}); // fin document ready

	</script>
</head>
<body>

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
<br><br>

Titulo de Proyecto: <input type="text" class="formProyect" name="txtTituloProyecto">
<br><br>
Estatus: <select class="formProyect" name="estatus">
<option value="1">Nuevo Proyecto</option>
<option value="2">En proceso</option>
<option value="3">Cerrado en Garantia</option>
<option value="4">Cerrrado Completo</option>
</select>
<br><br>
Proyecto Completado al: <span>0%</span>
<br><br>

<table border="1">
	<thead>
		<tr>
			<td></td><td>Actividades</td><td>[+]</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>[-]</td><td>Fecha</td><td colspan="2">Actividad</td>
		</tr>
	</tbody>
</table>
<br><br>
<table border="1">
	<thead>
		<tr>
			<td></td><td>Seguimiento</td><td>[+]</td><td colspan="2"></td>
		</tr>
		<tr>
			<td>[-]</td><td>Fecha</td><td colspan="2">Actividad</td><td>[/]</td><td>[X]</td>
		</tr>
	</thead>
</table>
<br><br>
<input type="button" value="Guardar" id="guardaProyecto">
</body>
</html>